<?
//-------------------------------------------Картинка заглушка---------------------------------------------------
define("NO_PHOTO_ID", 54416);
define("NO_PHOTO_MAIN_SLIDER_ID", 72080);
// placeholder_94x94.png
define("NO_PHOTO_PL_94_94_ID_OLD", 276755); // с логотипом
define("NO_PHOTO_PL_94_94_ID", 248525);     // с фотоаппаратом
// placeholder_352x152.png
define("NO_PHOTO_PL_352_152_ID_OLD", 276753);   // с логотипом
define("NO_PHOTO_PL_352_152_ID", 248526);       // с фотоаппаратом
// placeholder_195x144.png
define("NO_PHOTO_PL_195_144_ID", 276754);   	// с логотипом
define("NO_PHOTO_PL_195_144_1_ID", 299587);   	// с логотипом

define("NO_PHOTO_EXTENSION", 'jpg');
define("NO_PHOTO_DEFAULT_EXTENSION", 'jpg');
//-------------------------------------------Идентификаторы сайтов-----------------------------------------------
define("SITE_ID", "s1");
//-------------------------------------------Режим работы--------------------------------------------------------
define("SHOW_PRICE", "N");
//-------------------------------------------Идентификаторы инфоблоков-------------------------------------------
define("CATALOG_IBLOCK_ID_KS", 48);
define("BRANDS_IBLOCK_ID", 5);
define("BANNERS_IBLOCK_ID", 50);
define("NEWS_IBLOCK_ID", 1);
define("SLIDER_ON_MAIN_IBLOCK_ID", 46);
define("SPECIAL_OFFERS_IBLOCK_ID", 43);
define("LABS_LIST_IBLOCK_ID", 44);
define("BALANCES_PRODUCT_ID", 49);
//-------------------------------------------Идентификаторы свойств----------------------------------------------
define("CATALOG_PROP_MANUFACTURER", "CML2_MANUFACTURER");
//-------------------------------------------Названия HL таблиц--------------------------------------------------
define("CATALOG_TABLE_MANUFACTURER", "CML2MANUFACTURER");
//--------------------------------------------------Пути по сайту------------------------------------------------
define("SITE_URL_KS", "http://www.kom-sib.ru");	// Домен сайта

define("CATALOG_URL_KS", "/catalog/");
define("SERVICE_URL_KS", "/service/");
define("BASKET_URL_KS", "/personal/cart/");
define("COMPARE_URL_KS", "/catalog/compare/");
define("DEVELOPMENT_URL_KS", "/development/projects/");
define("CATALOG_MANUFACTURERS_URL_KS", "/catalog/manufacturers/");
define("CATALOG_BALANCES_URL_KS", "/catalog/balances/");
define("CATALOG_BALANCES_DIR_KS", "balances");
//-------------------------------------------------------Типы ИБ-------------------------------------------------
define("DYNAMIC_CONTENT_TYPE_KS", "dynamic");    // Внешние страницы Инструкции
//-------------------------------------------------------Свойство новинки----------------------------------------
define("PROPERTY_NEW_ADD_MONTHS", "2");
//-------------------------------------------------------ID почтовых шаблонов------------------------------------
//define("_TEMPLATE", 38);   // Шаблон отправки документов

//-------------------------------------------------------Типы валюты---------------------------------------------
//define("MY_IP", " 212.164.215.44");       // IP ул. Некрасова, д. 51

//-------------------------------------------------------Типы валюты---------------------------------------------
//define("_TYPE_1", 1);    // Тип базовой валюты

//-------------------------------------------------------Типы режима отладки-------------------------------------
//define("_MODE_1", 168);     // Показать только администратору

//-------------------------------------------------------Параметры для шаблона-----------------------------------
/*global $arBrandsSubSections;
$arBrandsSubSections = array("brands", "brand_technologies", "brand_history", "brand_reviews", "brand_video");

global $arShopSubSections;
$arShopSubSections = array("shops", "shop_info");

global $arPersonalSubSections;
$arPersonalSubSections = array("personal", "profile", "favorites");*/
//-------------------------------------------------------Параметры для каталога----------------------------------
define("LENGTH_PREVIEW_TEXT", 170); // длина строки в списке элементов

// используется в событи при транслитерации символьного кода элемента
define("POLNOE_NAIMENOVANIE_PROP", "1019");
define("POLNOE_NAIMENOVANIE_SUBPROP", "18689:1019");

/*global $arPerPageCount;
global $arCatalogSortBy;
global $arCatalogSortNames;
global $arCatalogSortOrder;
$arPerPageCount = array(100, 200);
$arCatalogSortBy = array("SHOW_COUNTER", "PROPERTY_PRICE", "PROPERTY_DISCOUNT", "TIMESTAMP_X");
$arCatalogSortNames = array("популярности", "цене", "скидке", "обновлению");*/
/*default sort order*/
/*$arCatalogSortOrder = array("DESC", "ASC", "DESC", "DESC");*/
?>