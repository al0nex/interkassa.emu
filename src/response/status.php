<?php

include dirname(__FILE__).'/../eng/eng.php';

$ik_shop_id = $_POST['ik_shop_id'];
$ik_payment_amount = $_POST['ik_payment_amount'];
$ik_payment_id = $_POST['ik_payment_id'];
$ik_payment_desc = $_POST['ik_payment_desc'];
$ik_paysystem_alias = $_POST['ik_paysystem_alias'];
$ik_baggage_fields = $_POST['ik_baggage_fields'];
$ik_payment_timestamp = $_POST['ik_payment_timestamp'];
$ik_payment_state = $_POST['ik_payment_state'];
$ik_trans_id = $_POST['ik_trans_id'];
$ik_currency_exch = $_POST['ik_currency_exch'];
$ik_fees_payer = $_POST['ik_fees_payer'];

$fake_sign = ($_POST['ik_sign_hash'] == 'fake');
if ($fake_sign) {
	$ik_sign_hash = strtoupper(md5(time()));
}
else {
	$ik_sign_hash = ik_response_sign();
}

$ik_status_url = $_POST['ik_status_url'];
$ik_status_method = $_POST['ik_status_method'];

include 'status.view';

?>
