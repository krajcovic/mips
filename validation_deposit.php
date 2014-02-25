<?php

include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__).'/../../header.php');
include(dirname(__FILE__).'/mips.php');
			

/* Gather submitted payment card details */
$merchantNumber = Configuration::get('MIPS_MERCHANT_NUMBER');
$orderNumber = $_POST['order_number'];
$total = $cart->get

//$cardType     = $_POST['cardType'];
//$cardholderName     = $_POST['cardholderName'];
//$cardNumber         = $_POST['cardNumber'];
//$cardCVC            = $_POST['cardCVC'];
//$cardexpDate_mo     = $_POST['expDate_Month'];
//$cardexpDate_yr     = $_POST['expDate_Year'];
//$cardExp             = $cardexpDate_mo.$cardexpDate_yr;

//$cardstartDate_mo     = $_POST['startDate_Month'];
//$cardstartDate_yr     = $_POST['startDate_Year'];
//$cardStart            = $cardstartDate_mo.$cardstartDate_yr;

//$cardIssue         = $_POST['cardIssue'];

//$currency = new Currency(intval(isset($_POST['currency_payement']) ? $_POST['currency_payement'] : $cookie->id_currency));
//$total = floatval(number_format($cart->getOrderTotal(true, 3), 2, '.', ''));

//$offlinecardpayment = new offlinecardpayment();
//$offlinecardpayment->validateOrder($cart->id,  _PS_OS_PREPARATION_, $total, $offlinecardpayment->displayName, NULL, NULL, $currency->id);
//$order = new Order($offlinecardpayment->currentOrder);
//$offlinecardpayment->writePaymentcarddetails($order->id, $cardType, $cardholderName, $cardNumber, $cardCVC, $cardExp, $cardStart, $cardIssue);

//Tools::redirectLink(__PS_BASE_URI__.'order-confirmation.php?id_cart='.$cart->id.'&id_module='.$offlinecardpayment->id.'&id_order='.$offlinecardpayment->currentOrder.'&key='.$order->secure_key);

?>