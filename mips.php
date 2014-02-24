<?php

if (!defined('_PS_VERSION_'))
    exit;

class Mips extends PaymentModule {

    const MIPS_NAME = 'MIPS_NAME';

    public function __construct() {
        $this->name = 'mips';
        $this->tab = 'payments_gateways';
        $this->version = 0.1;
        $this->author = 'Dusan Krajcovic';
        $this->need_instance = 0;

        parent::__construct();

        $this->page = basename(__FILE__, '.php');
        $this->displayName = $this->l('MIPS (Addons)');
        $this->description = $this->l('Module for pay on MIPS.');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');

        if (!Configuration::get(MIPS_NAME)) {
            $this->warning = $this->l('No name provided');
        }
    }

    public function install() {

        if (Shop::isFeatureActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
        }

        if (parent::install() == false OR !$this->registerHook('invoice') OR !$this->registerHook('payment') OR !$this->registerHook('paymentReturn') OR !Configuration::updateValue(MIPS_NAME, 'MIPS module addons')) {
            return false;
        }

        return true;
    }

    public function uninstall() {
        if (!parent::uninstall() || !Configuration::deleteByName(MIPS_NAME)) {
            Db::getInstance()->Execute('DELETE FROM `' . _DB_PREFIX_ . 'mips`');
        }
        parent::uninstall();
    }

    public function hookInvoice($params) {
//        global $smarty;
//        return $this->display(__FILE__, 'payment.tpl');
        return $this->hookPayment($params);
    }

    public function hookPayment($params) {
        global $smarty;
        $smarty->assign(array(
            'this_path' => $this->_path,
            'this_path_ssl' => Configuration::get('PS_FO_PROTOCOL') . $_SERVER['HTTP_HOST'] . __PS_BASE_URI__ . "modules/{$this->name}/"));

        return $this->display(__FILE__, 'payment.tpl');
    }

    public function hookPaymentReturn($params) {
        return $this->hookPayment($params);
    }

    public function hookLeftColumn($params) {
        global $smarty;
        return $this->display(__FILE__, 'mips.tpl');
    }

    public function hookRightColumn($params) {
        return $this->hookLeftColumn($params);
    }

//    public function hookHeader($params) {
//        return $this->display(__F)
//    }
}

?>
