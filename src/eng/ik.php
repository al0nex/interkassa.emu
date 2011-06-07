<?php

// 5.  Проверка информации о платеже
//
// При выполнении платежа Web Merchant Interface высылает оповещение о
// платеже через "Форму оповещения о платеже" на Status URL, указанный
// продавцом.
//
// Уведомление отправляется до тех пор, пока не получит от сервера HTTP
// ответ с кодом "200".
//
// Мы рекомендуем вам проверить данные, полученные через "Форму
// оповещения о платеже": 
//
//	1.  Проверить, действительно ли данные переданы от сервиса
//	    Interkassa Payment Interface (Проверка источника данных) 
//
//	2.  Проверить, не исказились ли данные в процессе передачи
//	    (Проверка целостности данных и электронной подписи) 
//
//	3.  Проверить сумму платежа 
//
//	4.  Проверить идентификатор получателя (Shop ID) 
//
//	5.  Проверить статус проведения платежа (success или fail)
//
//	6.  Запустить бизнес-логику вашего приложения  (Только ОДИН раз)
//
// 5.1. Проверка источника данных
//
// Как указывалось выше, значение параметра "Secret Key" должно быть
// известно только сервису Interkassa Payment Interface и продавцу.
//
// Исходя из этого, Secret Key может использоваться для аутентификации
// источника, приславшего данные о платеже.
//
// Для аутентификации источника оповещения о платеже продавец должен
// проверять контрольную подпись.  Контрольная подпись формируется
// сервисом Interkassa Payment Interface с учетом значения параметра
// "Secret Key" и передается в поле "ik_sign_hash".

// 5.3.1.  Формирование контрольной подписи данных о платеже от
//         продавца.
//
// [...]
//
//	1.  Сформируйте строку путем "склеивания" значений параметров, в
//          одну строку с разделителем -- ":", используемых в  "Форме
//          запроса платежа", в порядке:
//
//		ik_shop_id		Идентификатор магазина
//		ik_payment_amount	Сумма платежа
//		ik_payment_id		Идентификатор платежа
//		ik_paysystem_alias	Способ оплаты
//		ik_baggage_fields	Пользовательское поле
//		secret_key		Секретный ключ
//
//	    Помните, что при формировании подписи используется Secret
//	    Key. 
//
//	    Пример:
//
//		392894CA-62C4-E3B3-14DC-1CD6058AC6A7:0.1:123::baggage12345:WFQlL8H2vbXv5T6n
//
//	2.  Вычислите MD5 полученной строки.
//
//	    Пример:
//		18978a7587877dd075be798b6d6fe0b3
//
//	3.  Подставьте полученное значение в "Форму запроса платежа" как
//	    параметр ik_sign_hash.

function ik_request_sign()
{
	global $ik_shop_id;
	global $ik_payment_amount;
	global $ik_payment_id;
	global $ik_paysystem_alias;
	global $ik_baggage_fields;
	global $ik_secret_key;

	$pieces = array(
		$ik_shop_id,
		$ik_payment_amount,
		$ik_payment_id,
		$ik_paysystem_alias,
		$ik_baggage_fields,
		$ik_secret_key
	);

	return md5(implode(':', $pieces));
}

/*
function test_ik_secret_key()
{
	global $ik_shop_id;
	global $ik_payment_amount;
	global $ik_payment_id;
	global $ik_paysystem_alias;
	global $ik_baggage_fields;
	global $ik_secret_key;

	$ik_shop_id = '392894CA-62C4-E3B3-14DC-1CD6058AC6A7';
	$ik_payment_amount = '0.1';
	$ik_payment_id = '123';
	$ik_paysystem_alias = '';
	$ik_baggage_fields = 'baggage12345';
	$ik_secret_key = 'WFQlL8H2vbXv5T6n';

	assert(ik_request_sign() == '18978a7587877dd075be798b6d6fe0b3');
}
*/

// 5.3.2.  Проверка контрольной подписи данных о платеже от
//	   "INTERKASSA".

// При формировании контрольной подписи сервис Interkassa Payment
// Interface "склеивает" значения полей, передаваемых "Формой оповещения
// о платеже", в одну строку с разделителем - ":", в следующем порядке: 
//
//	ik_shop_id		Идентификатор магазина
//	ik_payment_amount	Сумма платежа
//	ik_payment_id		Идентификатор платежа
//	ik_paysystem_alias	Способ оплаты
//	ik_baggage_fields	Пользовательское поле
//	ik_payment_state	Состояние платежа
//	ik_trans_id		Внутренний номер платежа в системе "INTERKASSA"
//	ik_currency_exch	Курс валюты
//	ik_fees_payer		Плательщик комиссии
//	secret_key		Секретный ключ
//
// После формирования этой строки, к ней приминают алгоритм MD5, после
// чего все буквы латинского алфавита переводятся в верхний регистр.

function ik_response_sign()
{
	global $ik_shop_id;
	global $ik_payment_amount;
	global $ik_payment_id;
	global $ik_paysystem_alias;
	global $ik_baggage_fields;
	global $ik_payment_state;
	global $ik_trans_id;
	global $ik_currency_exch;
	global $ik_fees_payer;
	global $ik_secret_key;

	$pieces = array(
		$ik_shop_id,
		$ik_payment_amount,
		$ik_payment_id,
		$ik_paysystem_alias,
		$ik_baggage_fields,
		$ik_payment_state,
		$ik_trans_id,
		$ik_currency_exch,
		$ik_fees_payer,
		$ik_secret_key
	);

	return strtoupper(md5(implode(':', $pieces)));
}

/*
function test_ik_response_sign()
{
	global $ik_shop_id;
	global $ik_payment_amount;
	global $ik_payment_id;
	global $ik_paysystem_alias;
	global $ik_baggage_fields;
	global $ik_payment_state;
	global $ik_trans_id;
	global $ik_currency_exch;
	global $ik_fees_payer;
	global $ik_secret_key;

	$ik_shop_id = '392894CA-62C4-E3B3-14DC-1CD6058AC6A7';
	$ik_payment_amount = '0.1';
	$ik_payment_id = '123';
	$ik_paysystem_alias = 'webmoneyr';
	$ik_baggage_fields = 'baggage12345';
	$ik_payment_state = 'success';
	$ik_trans_id = 'IK_68';
	$ik_currency_exch = '1.17';
	$ik_fees_payer = '0';
	$ik_secret_key = 'WFQlL8H2vbXv5T6n';

	assert(ik_response_sign() == '584BB09767363BD9929B3148D4D0151C');
}
*/

// 5.7.  Запустить бизнес-логику вашего приложения
//
// ВНИМАНИЕ!
//	Очень важно, понимать то, что уведомление об успешном
//	зачислении платежа может прийти к вам на сервер несколько раз!
//
//	Это связанно из-за возможной потере пакета информации, обрыва
//	связи, выключении вашего сервера и т.п..
//
//	Поэтому запускать бизнес-логику проведения платежа необходимо
//	только лишь 1 раз.  Для этого вы можете использовать флаг
//	состояния вашего заказа в базе данных для удостоверения, что
//	платеж еще ни разу не был зачислен или др. аналогичными
//	способами.  Так же мы советуем использовать транзакционную
//	модель базы данных и работы с ней при зачислении платежа.

?>
