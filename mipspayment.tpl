{capture name=path}{l s='Payment'}{/capture}
{include file=$tpl_dir./breadcrumb.tpl}
<script language="javascript" src="{$this_path}offlinepayment.js"></script>
<link href="{$this_path}offlinepayment.css" rel="stylesheet" type="text/css" media="all" />


<form action="{$this_path_ssl}validation.php" class="offlinepaymentForm" id="offlinepaymentForm" name="offlinepaymentForm" method="post">
				

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
						  <input type="text" size="3" name="cardCVC" id="cardCVC" value="{$cardCVC}" />  <span style="font-size:0.8em;" class="hotspot" onmouseover="tooltip.show('CVC/CVV numbers are found on the back of your card. <br><img src=\'cvc.png\'>');" onmouseout="tooltip.hide();">What is this?</span>
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