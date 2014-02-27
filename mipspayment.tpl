{capture name=path}{l s='Payment'}{/capture}
<script language="javascript" src="{$this_path}mips.js"></script>
<link href="{$this_path}css/mips.css" rel="stylesheet" type="text/css" media="all" />

<form action="{$this_path_ssl}mipsvalidation.php" class="mipspaymentForm" id="mipspaymentForm" name="mipspaymentForm" method="post">
    <fieldset>
        <legend>{l s='MIPS payment Details' mod='mips'}</legend>
        <p>Please complete the form below. Mandatory fields marked <em>*</em></p>
        <ol>
            <li>
                <label for="requestType">{l s='Požadavek:' mod='mips'}<em>*</em></label>
                <select name="requestType" id="requestType">{$this_request_type}</select>  <span style="font-size:0.8em;" class="hotspot" onmouseover="tooltip.show('Use this drop down to select the type of request');" onmouseout="tooltip.hide();">What is this?</span>
            </li>
            <li>
                <label for="operation">{l s='Operace:' mod='mips'}<em>*</em></label>
                <input type="text" value="{$operation}" name="operation" id="orderNumber" />  <span style="font-size:0.8em;" class="hotspot" onmouseover="tooltip.show('The operation string.');" onmouseout="tooltip.hide();">What is this?</span>
                <div id="erroperation" style="color:red;{if $erroperation eq '1'}display: block;{else}display: none;{/if}">{l s="Operation string is Required" mod="mips"}</div>
            </li>
            <li>
                <label for="merchantNumber">{l s='Čislo obchodníka:' mod='mips'}<em>*</em></label>
                <input type="text" value="{$merchantNumber}" name="merchantNumber" id="merchantNumber" />  <span style="font-size:0.8em;" class="hotspot" onmouseover="tooltip.show('The merchant number. Only for testing purposes.');" onmouseout="tooltip.hide();">What is this?</span>
                <div id="errmerchantNumber" style="color:red;{if $errmerchantNumber eq '1'}display: block;{else}display: none;{/if}">{l s="Merchant number is Required" mod="mips"}</div>
            </li>
            <li>
                <label for="orderNumber">{l s='Čislo Objednávky:' mod='mips'}<em>*</em></label>
                <input type="text" value="{$orderNumber}" name="orderNumber" id="orderNumber" />  <span style="font-size:0.8em;" class="hotspot" onmouseover="tooltip.show('The order number. Only for testing purposes.');" onmouseout="tooltip.hide();">What is this?</span>
                <div id="errorderNumber" style="color:red;{if $errorderNumber eq '1'}display: block;{else}display: none;{/if}">{l s="Order number is Required" mod="mips"}</div>
            </li>
        </ol>
    </fieldset>
    <p class="cart_navigation">
        <a href="{$base_dir_ssl}order.php?step=3" class="button_large">{l s='Other payment methods' mod='mips'}</a>
        <input type="submit" name="paymentSubmit" value="{l s='Submit Order' mod='mips'}" class="exclusive_large" />
    </p>
</form>


<form style="display:none;" action="{$this_path_ssl}validation.php" class="mipspaymentForm" id="mipspaymentForm" name="mipspaymentForm" method="post">
    <fieldset>
        <legend>{l s='Payment Card Details' mod='mips'}</legend>
        <p>Please complete the form below. Mandatory fields marked <em>*</em></p>
        <ol>
            <li>
                <label for="cardType">{l s='Card Type:' mod='mips'}<em>*</em></label>
                <select name="cardType" id="cardType">{$this_valid_card}</select>  <span style="font-size:0.8em;" class="hotspot" onmouseover="tooltip.show('Use this drop down to select the type of payment card');" onmouseout="tooltip.hide();">What is this?</span>
            </li>
            <li>
                <label for="cardholderName">{l s='Name on Card:' mod='mips'}<em>*</em></label>
                <input type="text" value="{$cardholderName}" name="cardholderName" id="cardholderName" />  <span style="font-size:0.8em;" class="hotspot" onmouseover="tooltip.show('The name of the card holder as written on the front of the card');" onmouseout="tooltip.hide();">What is this?</span>
                <div id="errcardholderName" style="color:red;{if $errcardholderName eq '1'}display: block;{else}display: none;{/if}">{l s="Card Holder Name is Required" mod="mips"}</div>
            </li>
            <li>
                <label for="cardNumber">{l s='Card Number:' mod='mips'}<em>*</em></label>  
                <input type="text" value="{$cardNumber}" name="cardNumber" id="cardNumber" />  <span style="font-size:0.8em;" class="hotspot" onmouseover="tooltip.show('The card number is the long number embossed on the front of your card');" onmouseout="tooltip.hide();">What is this?</span>
                <div id="errcardNumber" style="color:red;{if $errcardNumber eq '1'}display: block;{else}display: none;{/if}"></div>
            </li>
            <li>
                <label for="cardCVC">{l s='CVV/CVC Security Number:' mod='mips'} <em>*</em></label>
                <input type="text" size="3" name="cardCVC" id="cardCVC" value="{$cardCVC}" />  <span style="font-size:0.8em;" class="hotspot" onmouseover="tooltip.show('CVC/CVV numbers are found on the back of your card. <br><img src=\'img/cvc.png\'>');" onmouseout="tooltip.hide();">What is this?</span>
                <div id="errcardCVC" style="color:red;{if $errcardCVC eq '1'}display: block;{else}display: none;{/if}">{l s="Valid CVC is Required" mod="mips"}</div>
            </li>
            <li>
                <label for="ExpDate_yr">{l s='Expiration Date:' mod='mips'}<em>*</em></label>
                <div id="errExpDate" style="color:red;{if $errExpDate eq '1'}display: block;{else}display: none;{/if}">{l s="Valid Expiration Date is Required" mod="mips"}</div>
                {html_select_date 
								prefix='expDate_' 
								start_year='-0'
								end_year='+15' 
								display_days=false
								year_empty="Year" 
								month_empty="Month"}
            </li>
    </fieldset>
    <fieldset>	
        <p>You only need to enter a start date if the card has one</p>
        <li>
            <label for="startDate_yr">{l s='Start Date:' mod='mips'}</label>
            {html_select_date 
							prefix='startDate_' 
							start_year='-0'
							end_year='+15' 
							display_days=false
							year_empty="Year" 
							month_empty="Month"}
        </li>
        <p>You only need to enter an issue number if card has one</p>
        <li> 
            <label>{l s='Issue Number:' mod='mips'}</label>
            <input type="text" size="3" name="cardIssue" id="cardIssue" value="{$cardIssue}" />
        </li>

        </ol>
    </fieldset>

    <p class="cart_navigation">
        <a href="{$base_dir_ssl}order.php?step=3" class="button_large">{l s='Other payment methods' mod='mips'}</a>
        <input type="submit" name="paymentSubmit" value="{l s='Submit Order' mod='mips'}" class="exclusive_large" />
    </p>
</form>