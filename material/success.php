<!--
	4.3.  Форма выполненного платежа

	Передает реквизиты выполненного платежа на веб-сайт продавца
	после успешного выполнения операции.

	Данные передаются через веб-браузер покупателя только в том
	случае, если выбран метод вызова Success URL "GET" или "POST".

	Внимание:  Форма не содержит поля ik_sign_hash
-->

<form action="<?=$ik_success_url?>" method="<?=$ik_success_method?>">

<!--
	Идентификатор магазина

	Идентификатор магазина зарегистрированного в системе
	«INTERKASSA» на который был совершен платеж.

	Формат:
		/^[0-9A-F]{8}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{12}$/
-->
<input type="hidden" name="ik_shop_id" value="64C18529-4B94-0B5D-7405-F2752F2B716C">

<!--
	Идентификатор платежа

	В этом поле передается идентификатор покупки в соответствии с
	системой учета продавца, полученный сервисом с веб-сайта
	продавца.

	Формат:
		/^[0-9a-z_]{1,32}$/i
-->
<input type="hidden" name="ik_payment_id" value="1234">

<!--
	Способ оплаты

	Способ оплаты с помощью которого была произведена оплата
	покупателем. 

	Возможные значения:
		rupay, egold, webmoneyz, webmoneyu, webmoneyr,
		webmoneye, ukrmoneyu, ukrmoneyz, ukrmoneyr, ukrmoneye,
		liberty, pecunix

	Формат:
		/^[[:alpha:]]{0,32}$/i

	Список доступных значение:
		http://www.interkassa.com/lib/paysystems.currencies.export.php?format=xml
		http://www.interkassa.com/lib/paysystems.currencies.export.php?format=csv
-->
<input type="hidden" name="ik_paysystem_alias" value="webmoneyr">

<!--
	Пользовательское поле

	Это поле, переданное с веб-сайта продавца в «Форме запроса
	платежа».

	Формат:
		/^[^[:cntrl:]]{0,255}$/i
-->
<input type="hidden" name="ik_baggage_fields" value="email: mail@mail.com, tel: +380441234567">

<!--
	Дата и время выполнения платежа

	Дата и время выполнения платежа в UNIX TIMESTAMP формате.

	UNIX-время или POSIX-время (англ. Unix time) - способ
	кодирования времени, принятый в UNIX и других POSIX-совместимых
	операционных системах. 

	Моментом начала отсчёта считается полночь (по UTC) с 31 декабря
	1969 года на 1 января 1970.

	Формат:
		/^[0-9]{1,12}$/
-->
<input type="hidden" name="ik_payment_timestamp" value="1196087212">

<!--
	Состояние платежа

	Состояние (статус) платежа проведенного в системе «INTERKASSA».

	Формат:
		/^(success|fail)$/i

		success: платеж принят
		fail: платеж не принят
-->
<input type="hidden" name="ik_payment_state" value="success">

<!--
	Внутренний номер платежа в системе «INTERKASSA»

	Номер платежа в системе «INTERKASSA», выполненный в процессе
	обработки запроса на выполнение платежа сервисом Interkassa
	Payment Interface. Является уникальным в системе «INTERKASSA».

	Формат:
		/^[[:alnum:]_]{1,32}$/i
-->
<input type="hidden" name="ik_trans_id" value="IK_68">
 
</form>
