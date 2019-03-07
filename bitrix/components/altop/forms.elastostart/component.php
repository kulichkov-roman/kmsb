<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if(!CModule::IncludeModule("iblock"))
	return;

$arResult = array();

/***SETTINGS***/
global $arSettings;
$arResult["SETTINGS"] = $arSettings;

/***IBLOCK***/
$arIBlock = CIBlock::GetList(array("SORT" => "ASC"), array("ID" => $arParams["IBLOCK_ID"]))->Fetch();
$arResult["IBLOCK_CODE"] = $arIBlock["CODE"];
$arResult["IBLOCK_NAME"] = $arIBlock["NAME"];
$arResult["IBLOCK_DESCRIPTION"] = $arIBlock["DESCRIPTION"];

/***IBLOCK_PROPS***/
$rsProp = CIBlock::GetProperties($arParams["IBLOCK_ID"], array("SORT" => "ASC"));
while($arProp = $rsProp->Fetch()) {
	if($arProp["PROPERTY_TYPE"] == "S") {
		$arResult["FIELDS"][] = $arProp;
	}
}

if(is_array($arResult["FIELDS"])) {
	$arResult["FIELDS_STRING"] = strtr(base64_encode(addslashes(gzcompress(serialize($arResult["FIELDS"]),9))), '+/=', '-_,');
}

/***CAPTCHA***/
if($arParams["USE_CAPTCHA"] == "Y" )
	$arResult["CAPTCHA_CODE"] = $APPLICATION->CaptchaGetCode();

$this->IncludeComponentTemplate();?>