<?php 
require('PaypalIPN.php');
error_log(print_r($_POST, TRUE));
// use PaypalIPN;
// $ipn = new PaypalIPN();
// Use the sandbox endpoint during testing.
// $ipn->useSandbox();

		$txn_id = $_POST['txn_id'];
		$payer_email = $_POST['payer_email'];
		$receiver_email = $_POST['receiver_email'];
		$item_name = $_POST['item_name'];
		$user = $_POST['custom'];
		$payement_amount = $_POST['mc_fee'];
		$payment_currency = $_POST['mc_currency']; 
	
	//CONNECT DB
	$db = new PDO("mysql:host=HOST;dbname=DBNAME","USER","PASS");
				$stmt = $db->prepare("INSERT INTO pay (user,id,email,pack) VALUES(:user, :txn_id, :payer_email, :item_name)");
				$stmt->bindParam(':user', $user);
				$stmt->bindParam(':txn_id', $txn_id);
				$stmt->bindParam(':payer_email', $payer_email);
				$stmt->bindParam(':item_name', $item_name);
				$stmt->execute();


// Reply with an empty 200 response to indicate to paypal the IPN was received correctly.
 header("HTTP/1.1 200 OK");
?>