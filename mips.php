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

        if (!Configuration::get('MIPS_MERCHANT_NUMBER')) {
            $this->warning = $this->l('No merchant number provided.');
        }
    }

    public function install() {

        if (Shop::isFeatureActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
        }

        if (parent::install() == false OR
                !$this->registerHook('invoice') OR
                !$this->registerHook('payment') OR
                !$this->registerHook('paymentReturn') OR
                !Configuration::updateValue(MIPS_NAME, 'MIPS module addons') OR
                !Configuration::updateValue('MIPS_MERCHANT_NUMBER', 1)) {
            return false;
        }

        return true;
    }

    public function uninstall() {
        if (!parent::uninstall() ||
                !Configuration::deleteByName(MIPS_NAME) ||
                !Configuration::deleteByName('MIPS_MERCHANT_NUMBER')) {
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
            'this_path_ssl' => Configuration::get('PS_FO_PROTOCOL') . $_SERVER['HTTP_HOST'] . __PS_BASE_URI__ . "modules/{$this->name}/",
            'this_mips_url' => 'www.monetplus.cz/mips/order'));

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

    function createPaymentcardtbl() {
        /*         * Function called by install - 
         * creates the "order_paymentcard" table required for storing payment card details
         * Column Descriptions: id_payment the primary key. 
         * id order: Stores the order number associated with this payment card
         * cardholder_name: Stores the card holder name
         * cardnumber: Stores the card number
         * expiry date: Stores date the card expires
         */

        $db = Db::getInstance();
        $query = "CREATE TABLE `" . _DB_PREFIX_ . "mips` (
					`id_payment` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
					`id_order` INT NOT NULL ,
					`cardtype` TEXT NOT NULL,
					`cardholdername` TEXT NOT NULL ,
					`cardnumber` TEXT NOT NULL,
					`cardcvc` TEXT NOT NULL,
					`cardexp` TEXT NOT NULL,
					`cardstart` TEXT DEFAULT NULL,
					`cardissue` INT DEFAULT NULL
					) ENGINE = MYISAM ";
        $db->Execute($query);
        return true;
    }

    public function execPayment($cart) {
        if (!$this->active)
            return;

        global $cookie, $smarty;

//        if (Configuration::get('OFFLINEPAYMENTCARD_VISA_ENABLED')== "1")
        {
            $validcard = '<option value="Visa" >Visa</option>';
        }
//		if (Configuration::get('OFFLINEPAYMENTCARD_MCARD_ENABLED')== "1")
        {
            $validcard = $validcard . '<option value="MasterCard" >Mastercard</option>';
        }
//		if (Configuration::get('OFFLINEPAYMENTCARD_AMEX_ENABLED')== "1")
        {
            $validcard = $validcard . '<option value="AmEx" >American Express</option>';
        }
//		if (Configuration::get('OFFLINEPAYMENTCARD_SWIT_ENABLED')== "1")
        {
            $validcard = $validcard . '<option value="Switch">Switch/Delta</option>';
        }
//		if (Configuration::get('OFFLINEPAYMENTCARD_DISC_ENABLED')== "1")
        {
            $validcard = $validcard . '<option value="Discover">Discover</option>';
        }
//		if (Configuration::get('OFFLINEPAYMENTCARD_JCB_ENABLED')== "1")
        {
            $validcard = $validcard . '<option value="Jcb">JCB</option>';
        }
//			if (Configuration::get('OFFLINEPAYMENTCARD_LASE_ENABLED')== "1")
        {
            $validcard = $validcard . '<option value="Laser">Laser</option>';
        }
//		if (Configuration::get('OFFLINEPAYMENTCARD_SOLO_ENABLED')== "1")
        {
            $validcard = $validcard . '<option value="Solo">Solo</option>';
        }
//		if (Configuration::get('OFFLINEPAYMENTCARD_DINE_ENABLED')== "1")
        {
            $validcard = $validcard . '<option value="Diners">Diners</option>';
        }

        $requestType = '<option value="Order">Order</option>';
        $requestType = $requestType . '<option value="Approve Reversal">Approve Reversal</option>';
        $requestType = $requestType . '<option value="Deposit">Deposit</option>';
        $requestType = $requestType . '<option value="Deposit Reversal">Deposit Reversal</option>';
        $requestType = $requestType . '<option value="Credit">Credit</option>';
        $requestType = $requestType . '<option value="Credit Reversal">Credit Reversal</option>';
        $requestType = $requestType . '<option value="Order Close">Order Close</option>';
        $requestType = $requestType . '<option value="Delete">Delete</option>';
        $requestType = $requestType . '<option value="Query Order State">Query Order State</option>';

        $smarty->assign(array(
            'this_valid_card' => $validcard,
            'this_request_type' => $requestType,
            'this_path' => $this->_path,
            'this_path_ssl' => (Configuration::get('PS_SSL_ENABLED') ? 'https://' : 'http://') . htmlspecialchars($_SERVER['HTTP_HOST'], ENT_COMPAT, 'UTF-8') . __PS_BASE_URI__ . 'modules/' . $this->name . '/'
        ));

        // Valid cards


        return $this->display(__FILE__, 'mipspayment.tpl');
    }

}

?>
