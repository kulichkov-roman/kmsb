<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

CModule::IncludeModule("sale");

// Комплектующие
if(is_array($arResult["PROPERTIES"]["KOMPLEKTUYUSHCHIE"]["VALUE"]))
{
    foreach($arResult["PROPERTIES"]["KOMPLEKTUYUSHCHIE"]["VALUE"] as $xmlID)
    {
        $arXmlIDs[] = $xmlID;
    }
	
	$arSort = array("property_NAIMENOVANIE_DLYA_SAYTA_POLNOE"=>"ASC");
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

		unset($arItem, $arFile, $arElement);
	}
}

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

// получить список свойств из HL и добавить в список характеристик
$arPropCode = array();
foreach($arResult["DISPLAY_PROPERTIES"] as &$arItem)
{
    if($arItem["USER_TYPE"] == "directory")
    {

        $strСode = $arItem["CODE"];
        $strСode = str_replace("_","",$arItem["CODE"]);

        $arPropCode[$arItem["VALUE"]] = array(
            "XML_ID" => $arItem["VALUE"],
            "NAME" => $strСode,
        );
    }
}
unset($arItem);

CModule::IncludeModule("highloadblock");

foreach($arPropCode as &$arProp)
{
    $rsData = \Bitrix\Highloadblock\HighloadBlockTable::getList(array('filter'=>array('NAME' => $arProp["NAME"])));

    if($arData = $rsData->fetch())
    {
        $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arData);

        $mainQuery = new \Bitrix\Main\Entity\Query($entity);

        $mainQuery->setOrder(array());
        $mainQuery->setFilter(array('UF_XML_ID'=> $arProp["XML_ID"]));
        $mainQuery->setSelect(array('*'));

        $rsResult = $mainQuery->exec();

        $rsResult = new CDBResult($rsResult);
        while ($arRow = $rsResult->Fetch())
        {
            $arProp["VALUE"] = $arRow["UF_NAME"];
        }
    }
}
unset($arProp);

foreach($arResult["DISPLAY_PROPERTIES"] as &$arItem)
{
    if($arItem["USER_TYPE"] == "directory")
    {
        $arItem["VALUE"] = $arPropCode[$arItem["VALUE"]]["VALUE"];
    }
}
unset($arItem);

// иконка новинки
if($arResult['PROPERTIES']['NEW']['VALUE'])
{
	$dateSet = $arResult['PROPERTIES']['NEW']['VALUE'];
	//echo "Исходная дата: ".$dateSet."<br>";

	// получим Unix timestamp из заданной даты
	$stmpSet = MakeTimeStamp($dateSet, "DD.MM.YYYY HH:MI:SS");

	// добавим к полученному Unix timestamp
	// добавим 2 месяц
	$arrAdd = array(
		"DD"	=> 0,
		"MM"	=> PROPERTY_NEW_ADD_MONTHS,
		"YYYY"	=> 0,
		"HH"	=> 0,
		"MI"	=> 0,
		"SS"	=> 0,
	);
	$stmpComp = AddToTimeStamp($arrAdd, $stmpSet);

	// выведем полученную дату
	// echo "Результат: ".date("d.m.Y", $stmpComp);
	// текущая дата
	$dateCur = date($DB->DateFormatToPHP(CSite::GetDateFormat("SHORT")), time());

	$dateComp = date("d.m.Y", $stmpComp);
	$dateSet = date("d.m.Y", $stmpSet);

	$result = $DB->CompareDates($dateCur, $dateComp);

	if ($result == 1)
	{
		$arResult["PROPERTIES"]["NEW"]["VALUE_FLAG"] = 'N';
	}
	elseif($result == -1)
	{
		$arResult["PROPERTIES"]["NEW"]["VALUE_FLAG"] = 'Y';
	}
	elseif ($result == 0)
	{
		$arResult["PROPERTIES"]["NEW"]["VALUE_FLAG"] = 'Y';
	}
}
?>