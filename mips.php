
<?php
if (!defined('_PS_VERSION_'))
  exit;
 
class Mips extends Module
  {
  public function __construct()
    {
    $this->name = 'mips';
    $this->tab = 'Test';
    $this->version = 1.0;
    $this->author = 'Dusan Krajcovic';
    $this->need_instance = 0;
 
    parent::__construct();
 
    $this->displayName = $this->l('Mips module');
    $this->description = $this->l('Module for pay on MIPS.');
    }
 
  public function install()
    {
    if (parent::install() == false)
      return false;
    return true;
    }
  }
?>
