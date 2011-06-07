<?php

# Идентификатор магазина (ik_shop_id)
$shop_id = '00000000-0000-0000-0000-000000000000';

# Название магазина
$shop_name = 'EShop Name';

# URL магазина
$shop_url = 'http://eshop.emu';

# Описание магазина
$shop_description = 'EShop Description';

# Success URL
$shop_success_url = 'http://eshop.emu/interkassa/success.php';

# Метод передачи Success URL
$shop_success_method = 'POST';

# Fail URL
$shop_fail_url = 'http://eshop.emu/interkassa/fail.php';

# Метод передачи Fail URL
$shop_fail_method = 'POST';

# Status URL
$shop_status_url = 'http://eshop.emu/interkassa/status.php';

# Метод передачи Status URL
$shop_status_method = 'POST';

# Текст уведомления для покупателей при переходе на платежный шлюз
# 'Интеркасса'
$shop_user_message = 'Спасибо, что доверяете нам.';

# Плательщик комиссии
# 0|1|2  за счет продавца | за счет покупателя | 50/50
$shop_fees_payer = '0';

# Валюта, в которой магазин передает сумму плетежа на платежный
# шлюз 'Интеркасса'
$shop_currency = '3'; // 3 -- Российский рубль

# Курс валюты магазина относительно доллара США
$shop_exchange_rate = '0.03';

# Секретный ключ (secret_key)
$shop_secret_key = '0000000000000000';

?>
