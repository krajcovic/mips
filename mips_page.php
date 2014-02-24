
<?php
global $smarty;
include('../../config/config.inc.php');
include('../../header.php');
include('./mipspayment.php');

if (!$cookie->isLogged()){
    Tools::redirect('authentication.php?back=order.php');
}
 
//$smarty->display(dirname(__FILE__).'/mips_page.tpl');

$mips = new Mips();
echo $mips->execPayment($cart);
 
include_once('../../footer.php');
?>

