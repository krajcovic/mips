<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

class Mips extends Module {
    
    const moduleName = 'mips';

    public function __construct() {
        $this->name = 'mips';
        $this->tab = 'Test';
        $this->version = 1.0;
        $this->author = 'Dusan Krajcovic';
        $this->need_instance = 0;

        parent::__construct();

        $this->displayName = $this->l('MIPS WebPay');
        $this->description = $this->l('Description of my module.');
    }

    public function install() {
        if (parent::install() == false) {
            return false;
        }

        return true;
    }

    public function uninstall() {
        if (!parent::uninstall()) {
            Db::getInstance()->Execute('DELETE FROM `' . _DB_PREFIX_ . 'mips`');
        }
        parent::uninstall();
    }

}
?>