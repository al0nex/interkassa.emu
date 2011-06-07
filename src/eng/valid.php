<?php

// ---------
// Templates
// ---------

function regexp_validator($re, $string)
{
	if (!preg_match($re, $string)) {
		set_last_error('invalid format');
		return false;
	}

	return true;
}

// ---------
// Factories
// ---------

// $regexp_validator = array(
//	'login' => '/^[[:alnum:]]{3,8}$/'
//	'password' => '/^[[alnum]]{6,12}$/'
// );
//
// create_regexp_validators($regexp_validator);
//
// if (!validate_login($login)) {
//	die("validate_login(): {$last_error}");
// }
//
// if (!validate_password($password)) {
//	die("validate_password(): {$last_error}");
// }

function create_regexp_validators($validators)
{
	foreach ($validators as $name => $re) {
		eval("function validate_$name(\$value) { return regexp_validator('$re', \$value); }");
	}
}

// function validate_xxx_url($url) {
//	...
// }
//
// create_alias_validators('validate_xxx_url', array(
//	'success_url', 'fail_url', 'status_url'
// ));
//
// if (!validate_success_url($success_url)) {
//	die("validate_success_url(): {$last_error}");
// }
//
// if (!validate_fail_url($fail_url)) {
//	die("validate_fail_url(): {$last_error}");
// }
//
// if (!validate_status_url($status_url)) {
//	die("validate_status_url(): {$last_error}");
// }

function create_alias_validators($validator, $aliases)
{
	foreach ($aliases as $alias) {
		eval("function validate_$alias(\$value) { return $validator(\$value); }");
	}
}

// ----------
// Validators
// ----------

// if (!validate_global('ik_shop_id')) {
//	die("ik_shop_id: {$last_error}");
// }
function validate_global($name)
{
	return eval("
		\$fn = 'validate_{$name}';
		if (!is_callable(\$fn)) {
			set_last_error('validate_{$name}(): not implemented');
			return false;
		}
		if (!validate_{$name}('{$GLOBALS[$name]}')) {
			global \$last_error;
			set_last_error(\"validate_{$name}: {\$last_error}\");
			return false;
		}
		return true;
	");
}

function validate_ik_url($url)
{
	// Любой из сл. параметров -- необязательный:
	//
	//	status_url, success_url или fail_url
	//
	// Если параметр задан -- он должен иметь правильный формат.
	// Если параметр не задан -- значение для него берется из БД.

	$url = @parse_url($url);
	if (!$url) {
		set_last_error('invalid format');
		return false;
	}

	if ($url['scheme'] != 'http' && $url['scheme'] != 'https') {
		set_last_error("invalid scheme [{$url['scheme']}]");
		return false;
	}

	if (empty($url['host'])) {
		set_last_error("invalid host [{$url['host']}]");
		return false;
	}

	return true;
}

create_regexp_validators(array(
	'ik_shop_id' => '/^[0-9A-F]{8}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{12}$/',
	'ik_payment_amount' => '/^\d+(\.\d+)?$/',
	'ik_payment_id' => '/^[0-9a-z_]{1,32}$/i',
	'ik_payment_desc' => '/^[^[:cntrl:]]{1,255}$/i',
	'ik_paysystem_alias' => '/^[[:alpha:]]{0,32}$/i',
	'ik_baggage_fields' => '/^[^[:cntrl:]]{0,255}$/i',
	'ik_sign_hash' => '/^[[:xdigit:]]{32}$/i',
	'ik_success_method' => '/^(get|post|link)$/i',
	'ik_fail_method' => '/^(get|post|link)$/i',
	'ik_status_method' => '/^(get|post|off)$/i',
	'ik_payment_timestamp' => '/^[0-9]{1,12}$/',
	'ik_payment_state' => '/^(success|fail)$/i',
	'ik_trans_id' => '/^[[:alnum:]_]{1,32}$/i',
	'ik_currency_exch' => '/^\d+(\.\d+)?$/',
	'ik_fees_payer' => '/^(0|1|2)$/'
));

create_alias_validators('validate_ik_url',
	array('ik_success_url', 'ik_fail_url', 'ik_status_url'));

?>
