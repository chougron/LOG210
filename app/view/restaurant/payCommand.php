<form id = "paypal_checkout" action = "https://www.sandbox.paypal.com/cgi-bin/webscr" method = "post">
<input name = "cmd" value = "_cart" type = "hidden">
<input name = "upload" value = "1" type = "hidden">
<input name = "no_note" value = "0" type = "hidden">
<input name = "tax" value = "0" type = "hidden">
<input name = "rm" value = "2" type = "hidden">
     <div id="paypal_item">

     </div>
<input name = "business" value = "ppotvin@lanets.ca" type = "hidden">
<input name = "handling_cart" value = "0" type = "hidden">
<input name = "currency_code" value = "USD" type = "hidden">
<input name = "return" value = "http://localhost/log210/restaurant/payCommand/<?php echo $commande->getId(); ?>" type = "hidden">
<input name = "cbt" value = "Retour au site" type = "hidden">
<input name = "cancel_return" value = "http://localhost/log210/restaurant/cancel/<?php echo $commande->getId(); ?>" type = "hidden">
<input name = "custom" value = "" type = "hidden">
    <span class="pull-right" id="paypal-link"><a href="#" onclick="$(this).closest('form').submit()" class="a-link">paypal</a></span> 
</form>