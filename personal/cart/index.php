<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Корзина");
$APPLICATION->SetTitle("Корзина");
//$USER->Authorize(1);
?><?/*$APPLICATION->IncludeComponent("bitrix:sale.basket.basket", "", Array(
	"COLUMNS_LIST" => array(	// Выводимые колонки
			0 => "NAME",
			1 => "DELETE",
			2 => "TYPE",
			3 => "PRICE",
			4 => "QUANTITY",
		),
		"PATH_TO_ORDER" => ORDER_PAGE_URL,	// Страница оформления заказа
		"HIDE_COUPON" => "Y",	// Спрятать поле ввода купона
		"PRICE_VAT_SHOW_VALUE" => "N",	// Отображать значение НДС
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",	// Рассчитывать скидку для каждой позиции (на все количество товара)
		"USE_PREPAYMENT" => "N",	// Использовать предавторизацию для оформления заказа (PayPal Express Checkout)
		"QUANTITY_FLOAT" => "N",	// Использовать дробное значение количества
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"ACTION_VARIABLE" => "action",	// Название переменной действия
		"OFFERS_PROPS" => array(	// Свойства, влияющие на пересчет корзины
			0 => "SIZE",
			1 => "COLOR",
		)
	),
	false
);*/?>





<?$APPLICATION->IncludeComponent(
	"ft:ajax.basket",
	"",
	Array(
	)
);?>





<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>