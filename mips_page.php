
<?php
global $smarty;
include('../../config/config.inc.php');
include('../../header.php');
include('./mips.php');

if (!$cookie->isLogged()){
    Tools::redirect('authentication.php?back=order.php');
}

$mips = new Mips();
echo $mips->execPayment($cart);
 
include_once('../../footer.php');
?>

