<?php

$ik_shop_id = $_POST['ik_shop_id'];
$ik_payment_id = $_POST['ik_payment_id'];
$ik_paysystem_alias = $_POST['ik_paysystem_alias'];
$ik_baggage_fields = $_POST['ik_baggage_fields'];
$ik_payment_timestamp = $_POST['ik_payment_timestamp'];
$ik_payment_state = $_POST['ik_payment_state'];
$ik_trans_id = $_POST['ik_trans_id'];

$ik_success_url = $_POST['ik_success_url'];
$ik_success_method = $_POST['ik_success_method'];

include 'success.view';

?>
