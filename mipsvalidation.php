<?php

include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__).'/../../header.php');
include(dirname(__FILE__).'/mips.php');

//$soapClient = new SoapClient("http://www.restfulwebservices.net/wcf/StockQuoteService.svc?wsdl"); 

$requestType = $_POST['requestType'];
$operation = $_POST['operation'];
$merchantNumber = $_POST['merchantNumber'];
$orderNumber = $_POST['orderNumber'];
$amount = $_POST['amount'];
$currIso = $_POST['currIso'];
$depositFlag = $_POST['depositFlag'];
$merorderNum = $_POST['merorderNum'];
$backUrl = $_POST['$backUrl'];
$description = $_POST['description'];
$md = $_POST['md'];

$mipsUrl = $_POST['mipsUrl'];

// TODO spocitat sign;

//$url = 'http://server.com/path';
//$data = array('key1' => 'value1', 'key2' => 'value2');
$data = array ('OPERATION' => operation);

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
    ),
);
$context  = stream_context_create($options);
$result = file_get_contents($mipsUrl, false, $context);

// TODO: tady bych mel poslat order do mipsu.




/* Gather submitted payment card details */
//$cardType     = $_POST['cardType'];
//$cardholderName     = $_POST['cardholderName'];
//$cardNumber         = $_POST['cardNumber'];
//$cardCVC            = $_POST['cardCVC'];
//$cardexpDate_mo     = $_POST['expDate_Month'];
//$cardexpDate_yr     = $_POST['expDate_Year'];
//$cardExp             = $cardexpDate_mo.$cardexpDate_yr;
//
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