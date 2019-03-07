<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

/***IBLOCK_TYPE***/
$arIBlockType = CIBlockParameters::GetIBlockTypes();


/***IBLOCK_ID***/
$arIBlock = array();
$rsIBlock = CIBlock::GetList(array("sort" => "asc"), array("TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE"=>"Y"));
while($arr = $rsIBlock->Fetch()) {
	$arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
}

$arComponentParameters = array(	
	"PARAMETERS" => array(		
		"IBLOCK_TYPE" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("MENU_LINKS_IBLOCK_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlockType,
			"ADDITIONAL_VALUES" => "N",
			"REFRESH" => "Y",
			"MULTIPLE" => "N",
		),
		"IBLOCK_ID" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("MENU_LINKS_IBLOCK_ID"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlock,
			"ADDITIONAL_VALUES" => "Y",
			"REFRESH" => "Y",
			"MULTIPLE" => "N",			
		),		
		"DEPTH_LEVEL" => Array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("MENU_LINKS_DEPTH_LEVEL"),
			"TYPE" => "STRING",
			"DEFAULT" => "2",
		),
		"SHOW_ELEMENTS" => Array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("MENU_LINKS_SHOW_ELEMENTS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"CACHE_TIME"  =>  Array("DEFAULT" => 36000000),
	)
);?>