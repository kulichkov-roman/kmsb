<?
//include($_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/s2/underconstruction.html");
//die();
define("DISCOUNT_IBLOCK_ID", 23);
define("PRICE_ID", 2);
define("CATALOG_IBLOCK_ID", 16);

//if(file_exists($_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/s2/catalog_functions.php"))
//	require_once $_SERVER["DOCUMENT_ROOT"]. "/bitrix/php_interface/s2/catalog_functions.php";

//AddEventHandler("main", "OnBeforeUserAdd", Array("ITC2Class", "OnBeforeUserAddHandler"));
class ITC2Class
{
 function OnBeforeUserAddHandler(&$arFields)
 {
  if($arFields["PERSONAL_PROFESSION"] == 1)
  {
   $arFields["ACTIVE"] = "N";
   $arFields["PERSONAL_PROFESSION"] = "";
  }
 }
}
?>