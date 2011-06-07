<?php

$ik_shop_id = $_POST['ik_shop_id'];
$ik_payment_id = $_POST['ik_payment_id'];
$ik_paysystem_alias = $_POST['ik_paysystem_alias'];
$ik_baggage_fields = $_POST['ik_baggage_fields'];
$ik_payment_timestamp = $_POST['ik_payment_timestamp'];
$ik_payment_state = $_POST['ik_payment_state'];
$ik_trans_id = $_POST['ik_trans_id'];

$ik_fail_url = $_POST['ik_fail_url'];
$ik_fail_method = $_POST['ik_fail_method'];

include 'fail.view';

?>
