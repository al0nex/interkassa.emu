<?php

include dirname(__FILE__).'/../eng/eng.php';

# 4.1.  Форма запроса платежа

# Обязательные параметры
$ik_shop_id = $_POST['ik_shop_id'];
$ik_payment_amount = $_POST['ik_payment_amount'];
$ik_payment_id = $_POST['ik_payment_id'];
$ik_payment_desc = $_POST['ik_payment_desc'];
$ik_paysystem_alias = $_POST['ik_paysystem_alias'];

# НЕобязательные параметры
@$ik_baggage_fields = $_POST['ik_baggage_fields'];
@$ik_sign_hash = $_POST['ik_sign_hash'];
@$ik_success_url = $_POST['ik_success_url'];
@$ik_success_method = $_POST['ik_success_method'];
@$ik_fail_url = $_POST['ik_fail_url'];
@$ik_fail_method = $_POST['ik_fail_method'];
@$ik_status_url = $_POST['ik_status_url'];
@$ik_status_method = $_POST['ik_status_method'];

if (is_null($ik_baggage_fields))
	$ik_baggage_fields = '';

if (is_null($ik_sign_hash))
	$ik_sign_hash = '';

if (is_null($ik_success_url))
	$ik_success_url = $shop_success_url;
if (is_null($ik_success_method))
	$ik_success_method = $shop_success_method;

if (is_null($ik_fail_url))
	$ik_fail_url = $shop_fail_url;
if (is_null($ik_fail_method))
	$ik_fail_method = $shop_fail_method;

if (is_null($ik_status_url))
	$ik_status_url = $shop_status_url;
if (is_null($ik_status_method))
	$ik_status_method = $shop_status_method;

# Здесь запрос обрабатывается...

$ik_payment_timestamp = time();
$ik_payment_state = 'success';
$ik_trans_id = 'IK_'.substr($ik_payment_timestamp, 0);
$ik_currency_exch = '?';
$ik_fees_payer = $shop_fees_payer;

include 'payment.view';

?>
