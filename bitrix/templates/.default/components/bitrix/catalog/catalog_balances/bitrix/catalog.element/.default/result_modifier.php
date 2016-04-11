<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

CModule::IncludeModule("sale");

//-->
// Комплектующие

//echo "<pre>"; var_dump($arResult["PROPERTIES"]["KOMPLEKTUYUSHCHIE"]); echo "</pre>";

//$arXmlIDs[] = $arResult["PROPERTIES"]["KOMPLEKTUYUSHCHIE"]["VALUE"];

if(is_array($arResult["PROPERTIES"]["KOMPLEKTUYUSHCHIE"]["VALUE"]))
{
    foreach($arResult["PROPERTIES"]["KOMPLEKTUYUSHCHIE"]["VALUE"] as $xmlID)
    {
        $arXmlIDs[] = $xmlID;
    }
	
	$arSort = array("SORT"=>"ASC");
	$arSelect = array(
		"ID",
		"NAME",
		"DETAIL_PICTURE",
		"DETAIL_PAGE_URL",
		"PROPERTY_NAIMENOVANIE_DLYA_SAYTA_KRATKOE",
		"PROPERTY_NAIMENOVANIE_DLYA_SAYTA_POLNOE",
	);
	$arFilter = array(
		"IBLOCK_ID" => CATALOG_IBLOCK_ID_KS,
		"EXTERNAL_ID" => $arXmlIDs
	);
	
	$rsElements = CIBlockElement::GetList(
		$arSort, 
		$arFilter, 
		false, 
		false, 
		$arSelect
	);
	
	while ($arItem = $rsElements->GetNext())
	{
		$arElement[] = $arItem;
	}
	
	if(sizeof($arElement > 0))
	{
		foreach($arElement as &$arItem)
		{
			$rsFile = CFile::GetByID($arItem["DETAIL_PICTURE"]);
			$arFile = $rsFile->Fetch();
			
			if(is_array($arFile))
			{
				$arItem["DETAIL_PICTURE"] = $arFile;
				$arItem["DETAIL_PICTURE"]["SRC"] = '/upload/'.$arFile["SUBDIR"].'/'.$arFile["FILE_NAME"];
			}
			else 
			{
				$arItem["DETAIL_PICTURE"] = false;
			}
		}
	
		$arResult["PROPERTIES"]["KOMPLEKTUYUSHCHIE"]["OPTIONS"] = $arElement;
		
		//echo "<pre>"; var_dump($arResult["PROPERTIES"]["KOMPLEKTUYUSHCHIE"]["OPTIONS"]); echo "</pre>";
		
		unset($arItem, $arFile, $arElement);
	}
}

//echo sizeof($arElement);
//echo "<pre>"; var_dump($arElement); echo "</pre>";//die();
//<--

//-->
// Есть товар в корзине/нет товара в корзине

$arSort = array("ID"=>"ASC");
$arSelect = array("ID", "PRODUCT_ID", "CAN_BUY");
$arFilter = array(
    "FUSER_ID" => CSaleBasket::GetBasketUserID(),
    "LID" => SITE_ID,
    "ORDER_ID" => "NULL",
    "PRODUCT_ID" => $arResult["ID"]
);

$dbBasketItems = CSaleBasket::GetList(
    $arSort,
    $arFilter,
    false,
    false,
    $arSelect
);
	
$arItems = $dbBasketItems->GetNext();

if($arItems)
{
	$arResult['inBacket'] = 1;
}
else
{
	$arResult['inBacket'] = 0;
}

//echo "<pre>"; var_dump($arResult['inBacket']); echo "</pre>";

$this->__component->arResult['inBacket'] = $arResult['inBacket'];
$this->__component->SetResultCacheKeys(array('inBacket'));
//<--


// Выведем все курсы USD, отсортированные по дате
$arFilter = array(
    "CURRENCY" => "USD"
    );
$by = "date";
$order = "desc";

$dbRate = CCurrencyRates::GetList(
	$by,
	$order,
	$arFilter
);

while($arRate = $dbRate->Fetch())
{
    $arResult["CURRENCYRATES"] = array(
		"CURRENCY" => "USD",
		"RATES" => $arRate["RATE"],
	);
}

$this->__component->arResult['DISPLAY_PROPERTIES'] = $arResult['DISPLAY_PROPERTIES'];
$this->__component->SetResultCacheKeys(array('DISPLAY_PROPERTIES'));
?>