<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

__IncludeLang($_SERVER["DOCUMENT_ROOT"].$templateFolder."/lang/".LANGUAGE_ID."/template.php");

if (count($arResult['IDS']) > 0 && CModule::IncludeModule('sale'))
{
	$arItemsInCompare = array();
	foreach ($arResult['IDS'] as $ID)
	{
		if (isset(
			$_SESSION[$arParams["COMPARE_NAME"]][$arParams["IBLOCK_ID"]]["ITEMS"][$ID]
		))
			$arItemsInCompare[] = $ID;
	}

	$dbBasketItems = CSaleBasket::GetList(
		array(
			"ID" => "ASC"
		),
		array(
			"FUSER_ID" => CSaleBasket::GetBasketUserID(),
			"LID" => SITE_ID,
			"ORDER_ID" => "NULL",
			),
		false,
		false,
		array()
	);

	$arPageItems = array();
	$arPageItemsDelay = array();
	while ($arItem = $dbBasketItems->Fetch())
	{
		if (in_array($arItem['PRODUCT_ID'], $arResult['IDS']))
		{
			if($arItem["DELAY"] == "Y")
				$arPageItemsDelay[] = $arItem['PRODUCT_ID'];
			else
				$arPageItems[] = $arItem['PRODUCT_ID'];
		}
	}
	
	if (count($arPageItems) > 0)
	{
		echo '<script type="text/javascript">$(function(){'."\r\n";
		foreach ($arPageItems as $id) 
		{
			echo "disableAddToCart('catalog_add2cart_link_".$id."', 'list', '".GetMessage("CATALOG_IN_CART")."');\r\n";
		}
		foreach ($arPageItemsDelay as $id) 
		{
			echo "disableAddToCart('catalog_add2cart_link_".$id."', 'list', '".GetMessage("CATALOG_IN_CART_DELAY")."');\r\n";
		}
		echo '})</script>';
	}
	
	if (count($arItemsInCompare) > 0)
	{
		echo '<script type="text/javascript">$(function(){'."\r\n";
		foreach ($arItemsInCompare as $id) 
		{
			echo "disableAddToCompare('catalog_add2compare_link_".$id."', '".GetMessage("CATALOG_IN_COMPARE")."');\r\n";
		}
		echo '})</script>';
	}
 
 if($USER->IsAuthorized())
 {
  $discount = Array();
  $userID = $USER->GetID();
  $arSelect = Array("ID", "NAME", "PROPERTY_DISCOUNT", "PROPERTY_SECTION");
  $arFilter = Array("IBLOCK_ID"=>DISCOUNT_IBLOCK_ID, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_USER"=>$userID);
  $rsDiscounts = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
  while($arDiscount = $rsDiscounts->Fetch())
  {
   if(intVal($arDiscount["PROPERTY_DISCOUNT_VALUE"]) > 0 && (!isset($discount[$arDiscount["PROPERTY_SECTION_VALUE"]]) || intVal($arDiscount["PROPERTY_DISCOUNT_VALUE"]) > $discount[$arDiscount["PROPERTY_SECTION_VALUE"]]))
    $discount[$arDiscount["PROPERTY_SECTION_VALUE"]] = intVal($arDiscount["PROPERTY_DISCOUNT_VALUE"]);
  }
  
  if(count($discount))
  {
   $arResult["PRICES"] = CIBlockPriceTools::GetCatalogPrices($arParams["IBLOCK_ID"], $arParams["PRICE_CODE"]);
   $arSelect = array("ID","IBLOCK_ID","IBLOCK_SECTION_ID");
   $arFilter = array(
			 "ID" => $arResult["IDS"],
			 "IBLOCK_ID" => $arParams["IBLOCK_ID"],
			 "IBLOCK_LID" => SITE_ID,
			 "IBLOCK_ACTIVE" => "Y",
			 "ACTIVE_DATE" => "Y",
			 "ACTIVE" => "Y",
			 "CHECK_PERMISSIONS" => "Y",
    "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
		 );
   foreach($arResult["PRICES"] as $key => $value)
		 {
			 $arSelect[] = $value["SELECT"];
			 $arFilter["CATALOG_SHOP_QUANTITY_".$value["ID"]] = $arParams["SHOW_PRICE_COUNT"];
		 }
   $rsElements = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
   echo '<script type="text/javascript">$(function(){'."\r\n";
   while($obElement = $rsElements->GetNextElement())
	  {
		  $arItem = $obElement->GetFields();
    if(isset($discount[$arItem["IBLOCK_SECTION_ID"]]))
    {
		   $arItem["PRICES"] = CIBlockPriceTools::GetItemPrices($arParams["IBLOCK_ID"], $arResult["PRICES"], $arItem, $arParams['PRICE_VAT_INCLUDE']);
     
     foreach($arItem["PRICES"] as $code=>$arPrice)
     {
      if($arPrice["CAN_ACCESS"])
      {
       if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"])
        $price = $arPrice["DISCOUNT_VALUE"];
       else
        $price = $arPrice["VALUE"];
       
       if(floatVal($arPrice["VALUE"] - $arPrice["VALUE"]/100*$discount[$arItem["IBLOCK_SECTION_ID"]]) < $price)
        echo "showPrice('price-".$arItem["ID"]."', '<span class=\"catalog-item-price\">".number_format(floatVal($arPrice["VALUE"] - $arPrice["VALUE"]/100*$discount[$arItem["IBLOCK_SECTION_ID"]]), 0, ".", " ")." руб</span> <s>".$arPrice["PRINT_VALUE"]."</s>');\r\n";
      }
     }
    }
   }
   echo '})</script>';
  }
 }
}
?>