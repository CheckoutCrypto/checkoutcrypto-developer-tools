<?php
/*
*Copyright 2014 CheckoutCrypto and CheckoutCrypto Canada
*/
include('layout.php');
require('func.php');
$apikey = '';
$coincode = 'POT';

if(!empty($apikey)){
    if(empty($_GET)) {
        my_header();  
		echo "Welcome to the Checkoutcrypto API Developer Client, make sure you don't share your API key. ";
		echo "Test the calls in the menu above, or review the documentation and experiment.";
     	my_footer();
	}else{
		if(isset($_GET['action'])){
			my_header();
			if($_GET['action'] == "getnewaddress"){
				$address = getnewaddress($apikey, $coincode);
				echo '<div class="address_desc">your newly generated deposit address: </br>'.$address.'</div>';
				displayQrAddress($address);
			}
			if($_GET['action'] == "getreceivedbyaddress"){
				if(isset($_GET['address'])){
					$address = $_GET['address'];
					$amount = getreceivedbyaddress($apikey, $address, $coincode);
					echo '<div class="address_desc"> address : '.$_GET['address'].' balance = ' . $amount['balance'] . ' pending = '. $amount['pending'] . ' fee = '. $amount['fee'].'</div>';
				}else{
					getreceivedform();
				}
			}
			if($_GET['action'] == "getbalance"){
				$balance = getbalance($apikey, $coincode);
				echo 'your balance for '.$coincode.'  = '.$balance;
			}
			if($_GET['action'] == "refreshcoins"){
				$coins = refreshcoins($apikey);
				?>
				<div class="coin_layout">
				<?php foreach($coins as $cn){ ?>
					<div class="coin_single">
					<img class="coin_image" src="<?php echo 'https://www.checkoutcrypto.com/'.$cn['coin_image']; ?>" /><br/>1
					 <div class="coin_desc"><?php echo  $cn['coin_name'] . "[".$cn['coin_code']."] is enabled with rate ". $cn['rate'];
					?></div></div><br /> <?php
				}
				?></div> <?php
			}
			if($_GET['action'] == "getrate"){
				$rate = getrate($apikey, $coincode);
				echo 'The rate for '.$coincode.' = $'.$rate;
			}
			my_footer();

		}

	} 
}else{
	my_header();
	?>
	<table>
	<tr><td>1. Register at <a href="https://www.checkoutcrypto.com">CheckoutCrypto.com</td></tr>
	<tr><td>2. Generate an API key </td></tr>
	<tr><td>3. Enable preferred coins </td></tr>
	<tr><td>4. Edit cc_sample.php change $apikey='YOURKEY';</td></tr>
	<tr><td>5. Develop.</td></tr>
	</table>
<?php
	my_footer();
}
?> 
