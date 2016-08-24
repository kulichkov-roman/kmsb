<?	
//-->

// Подключение переризатора
CModule::IncludeModule('itconstruct.resizer');

// Подключение переризатора
CModule::IncludeModule('tpic');

// Некешируемые области
CModule::IncludeModule('itconstruct.uncachedarea');

// Функция pre() для отладки
if (file_exists($_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/pre.php"))
	require_once $_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/pre.php";

// Пользовательские функции
if (file_exists($_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/functions.php"))
    require_once $_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/functions.php";
	
// Пользовательские классы
if (file_exists($_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/classes.php"))
    require_once $_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/classes.php";
	
// Пользовательские константы
if (file_exists($_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/settings/settings.php"))
    require_once $_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/settings/settings.php";
	
// В папке module_events лежат обработчики события
if (file_exists($_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/module_events/main.php"))
    require_once $_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/module_events/main.php";

if (file_exists($_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/module_events/sale.php"))
    require_once $_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/module_events/sale.php";
    
if (file_exists($_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/module_events/catalog.php"))
    require_once $_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/module_events/catalog.php";

if (file_exists($_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/module_events/search.php"))
    require_once $_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/module_events/search.php";

if (file_exists($_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/module_events/iblock.php"))
    require_once $_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/module_events/iblock.php";
//<--

if(file_exists($_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/itconstruct/eladdev.php"))
	require_once $_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/itconstruct/eladdev.php";
?>