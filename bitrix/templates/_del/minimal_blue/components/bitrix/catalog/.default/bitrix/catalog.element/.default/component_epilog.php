<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

__IncludeLang($_SERVER["DOCUMENT_ROOT"].$templateFolder."/lang/".LANGUAGE_ID."/template.php");

$APPLICATION->AddHeadScript('/bitrix/templates/'.SITE_TEMPLATE_ID.'/jquery/fancybox/jquery.fancybox-1.3.1.pack.js');
$APPLICATION->SetAdditionalCSS('/bitrix/templates/'.SITE_TEMPLATE_ID.'/jquery/fancybox/jquery.fancybox-1.3.1.css');

if (CModule::IncludeModule('sale'))
{
	$dbBasketItems = CSaleBasket::GetList(
		array(
			"ID" => "ASC"
		),
		array(
			"PRODUCT_ID" => $arResult['ID'],
			"FUSER_ID" => CSaleBasket::GetBasketUserID(),
			"LID" => SITE_ID,
			"ORDER_ID" => "NULL",
		),
		false,
		false,
		array()
	);

	if ($arBasket = $dbBasketItems->Fetch())
	{
		if($arBasket["DELAY"] == "Y")
			echo "<script type=\"text/javascript\">$(function() {disableAddToCart('catalog_add2cart_link', 'detail', '".GetMessage("CATALOG_IN_CART_DELAY")."')});</script>\r\n";
		else
			echo "<script type=\"text/javascript\">$(function() {disableAddToCart('catalog_add2cart_link', 'detail', '".GetMessage("CATALOG_IN_BASKET")."')});</script>\r\n";
	}
}

if ($arParams['USE_COMPARE'])
{
	if (isset(
		$_SESSION[$arParams["COMPARE_NAME"]][$arParams["IBLOCK_ID"]]["ITEMS"][$arResult['ID']]
	))
	{
		echo '<script type="text/javascript">$(function(){disableAddToCompare(\'catalog_add2compare_link\', \''.GetMessage("CATALOG_IN_COMPARE").'\');})</script>';
	}
}

if (array_key_exists("PROPERTIES", $arResult) && is_array($arResult["PROPERTIES"]))
{
	$sticker = "";

	foreach (Array("SPECIALOFFER", "NEWPRODUCT", "SALELEADER") as $propertyCode)
	{
		if (array_key_exists($propertyCode, $arResult["PROPERTIES"]) && intval($arResult["PROPERTIES"][$propertyCode]["PROPERTY_VALUE_ID"]) > 0)
			$sticker .= "&nbsp;<span class=\"sticker\">".$arResult["PROPERTIES"][$propertyCode]["NAME"]."</span>";
	}

	if ($sticker != "")
		$APPLICATION->SetPageProperty("ADDITIONAL_TITLE", $sticker);
}

if($USER->IsAuthorized())
{
 $discount = false;
 $userID = $USER->GetID();
 $arSelect = Array("ID", "NAME", "PROPERTY_DISCOUNT");
 $arFilter = Array("IBLOCK_ID"=>DISCOUNT_IBLOCK_ID, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_USER"=>$userID, "PROPERTY_SECTION"=>$arResult["IBLOCK_SECTION_ID"]);
 $rsDiscounts = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
 while($arDiscount = $rsDiscounts->Fetch())
 {
  if(intVal($arDiscount["PROPERTY_DISCOUNT_VALUE"]) > 0 && ($discount === false || intVal($arDiscount["PROPERTY_DISCOUNT_VALUE"]) > $discount))
   $discount = intVal($arDiscount["PROPERTY_DISCOUNT_VALUE"]);
 }
 
 if($discount !== false)
 {
  $arResultPrices = CIBlockPriceTools::GetCatalogPrices($arParams["IBLOCK_ID"], $arParams["PRICE_CODE"]);
  $arSelect = array("ID","IBLOCK_ID","IBLOCK_SECTION_ID");
  $arFilter = array(
			"ID" => $arResult["ID"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"IBLOCK_LID" => SITE_ID,
			"IBLOCK_ACTIVE" => "Y",
			"ACTIVE_DATE" => "Y",
			"ACTIVE" => "Y",
			"CHECK_PERMISSIONS" => "Y",
		);
  foreach($arResultPrices as $key => $value)
  {
   $arSelect[] = $value["SELECT"];
   $arFilter["CATALOG_SHOP_QUANTITY_".$value["ID"]] = $arParams["SHOW_PRICE_COUNT"];
  }
  $rsElement = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
  if($obElement = $rsElement->GetNextElement())
		{
			$arResult = $obElement->GetFields();
			$arResult["CAT_PRICES"] = $arResultPrices;
   $arResult["PRICES"] = CIBlockPriceTools::GetItemPrices($arParams["IBLOCK_ID"], $arResult["CAT_PRICES"], $arResult, $arParams['PRICE_VAT_INCLUDE']);
   
   foreach($arResult["PRICES"] as $code=>$arPrice)
   {
    if($arPrice["CAN_ACCESS"])
    {
     if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"])
      $price = $arPrice["DISCOUNT_VALUE"];
     else
      $price = $arPrice["VALUE"];
     
     if(floatVal($arPrice["VALUE"] - $arPrice["VALUE"]/100*$discount) < $price)
      echo "<script type=\"text/javascript\">$(function() {showPrice('detail-price', '<span class=\"catalog-detail-price\">".number_format(floatVal($arPrice["VALUE"] - $arPrice["VALUE"]/100*$discount), 0, ".", " ")." руб</span> <s>".$arPrice["PRINT_VALUE"]."</s>')});</script>\r\n";
    }
   }
  }
 }
}
?>