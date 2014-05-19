<?php
/*
*Copyright 2014 CheckoutCrypto and CheckoutCrypto Canada
*/
function my_header(){ 
    echo '<?xml version="1.0" encoding="UTF-8" ?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head><title>CheckoutCrypto Sample</title>
     <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>  
	<!-- Begin Page -->
    <div class="page">
	<div class="header">
        <div class="logo"><a href="https://www.checkoutcrypto.com"><img src="./images/checkoutcrypto_logo.jpg" alt="logo" width="300" height="g0"></img></a></div>
        <div class="head_menu">
			<table class="head_menu_layout">
                <tr>	
					<td class="head_menu_itm"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=getnewaddress">getnewaddress</a></td>
					<td class="head_menu_itm"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=getreceivedbyaddress">getreceivedbyaddress</a></td>
					<td class="head_menu_itm"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=getbalance">getbalance</a></td>
					<td class="head_menu_itm"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=refreshcoins">refreshcoins</a></td>
					<td class="head_menu_itm"><a href="https://www.checkoutcrypto.com/help/docs/api_doc">Documentation</a></td>
				</tr>
			</table>
		</div>
<!-- End Head_menu -->
</div>

	<!-- Begin Content -->
    <div class="content">

</br>
<?php

}

function getreceivedform(){ ?>
<div class="form">
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
<p> Get Received By Address: </p>
<input type="text" name="address" />
<input type="hidden" name="action" value="getreceivedbyaddress" />
<input type="submit" text="submit" />
</form>
</div>

<?php
}

function my_footer(){ ?>
<!-- End Content -->
</div>
<!--- Begin Footer -->
    <div class="footer">
        <table class="foot_layout">
            <tr>
                <td class="foot_layout_item">CheckoutCrypto (2014). </td>
				<td class="foot_layout_item">CheckoutCrypto API Developer Client. </td>
                <td class="foot_layout_item"><a href="http://www.apache.org/licenses/LICENSE-2.0" >Apache 2.0 License</a></td>
            </tr>
        </table>
    </div>
 <!-- End My Page Template -->
    </div>
</body>
</html>
<?php
}
?>


