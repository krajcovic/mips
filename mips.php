<?php

if (!defined('_PS_VERSION_'))
    exit;

class Mips extends Module {

    public function __construct() {
        $this->name = 'mips';
        $this->tab = 'Test';
        $this->version = 1.1;
        $this->author = 'Dusan Krajcovic';
        $this->need_instance = 0;

        parent::__construct();

        $this->displayName = $this->l('Mips module');
        $this->description = $this->l('Module for pay on MIPS.');
    }

    public function install() {
        if (parent::install() == false OR !$this->registerHook('leftColumn'))
            return false;
        return true;
    }

    public function uninstall() {
        if (!parent::uninstall())
            Db::getInstance()->Execute('DELETE FROM `' . _DB_PREFIX_ . 'mips`');
        parent::uninstall();
    }

    public function hookLeftColumn($params) {
        global $smarty;
        return $this->display(__FILE__, 'mips.tpl');
    }

    public function hookRightColumn($params) {
        return $this->hookLeftColumn($params);
    }

}
?>
