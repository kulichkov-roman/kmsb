<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$moduleClass = "CElastoStart";
$moduleID = "altop.elastostart";

if(!CModule::IncludeModule($moduleID))
	return;

if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"] == "change_theme") {
	unset($_POST["action"]);
	$moduleClass::UpdateParametrsValues();	
}

global $USER;
$arResult = array();

$arFrontParametrs = $moduleClass::GetParametrsValues(SITE_ID);
foreach($moduleClass::$arParametrsList as $blockCode => $arBlock) {
	foreach($arBlock["OPTIONS"] as $optionCode => $arOption) {
		$arResult[$optionCode] = $arOption;
		$arResult[$optionCode]["VALUE"] = $arFrontParametrs[$optionCode];
		if($arResult[$optionCode]["LIST"]) {
			foreach($arResult[$optionCode]["LIST"] as $variantCode => $variantTitle) {
				if(!is_array($variantTitle)) {
					$arResult[$optionCode]["LIST"][$variantCode] = array("TITLE" => $variantTitle);
				}				
				if($arResult[$optionCode]["TYPE"] == "multiselectbox") {
					if(in_array($variantCode, $arResult[$optionCode]["VALUE"])) {
						$arResult[$optionCode]["LIST"][$variantCode]["CURRENT"] = "Y";
					}
				} else {
					if($arResult[$optionCode]["VALUE"] == $variantCode) {
						$arResult[$optionCode]["LIST"][$variantCode]["CURRENT"] = "Y";
					}
				}
			}
		}
	}
}

$appleTouchIcon114 = CFile::GetFileArray($arResult["APPLE_TOUCH_ICON_114_114"]["VALUE"]);
$appleTouchIcon114Def = CFile::GetFileArray($arResult["APPLE_TOUCH_ICON_114_114"]["DEFAULT"]);
if(!empty($appleTouchIcon114)) {
	$APPLICATION->AddHeadString("<link rel='apple-touch-icon' sizes='57x57' href='".$appleTouchIcon114["SRC"]."' />", true);
	$APPLICATION->AddHeadString("<link rel='apple-touch-icon' sizes='114x114' href='".$appleTouchIcon114["SRC"]."' />", true);
} elseif(!empty($appleTouchIcon114Def)) {
	$APPLICATION->AddHeadString("<link rel='apple-touch-icon' sizes='57x57' href='".$appleTouchIcon114Def["SRC"]."' />", true);
	$APPLICATION->AddHeadString("<link rel='apple-touch-icon' sizes='114x114' href='".$appleTouchIcon114Def["SRC"]."' />", true);
} else {
	$APPLICATION->AddHeadString("<link rel='apple-touch-icon' sizes='57x57' href='".SITE_TEMPLATE_PATH."/images/apple-touch-icon-114.png' />", true);
	$APPLICATION->AddHeadString("<link rel='apple-touch-icon' sizes='114x114' href='".SITE_TEMPLATE_PATH."/images/apple-touch-icon-114.png' />", true);
}

$appleTouchIcon144 = CFile::GetFileArray($arResult["APPLE_TOUCH_ICON_144_144"]["VALUE"]);
$appleTouchIcon144Def = CFile::GetFileArray($arResult["APPLE_TOUCH_ICON_144_144"]["DEFAULT"]);
if(!empty($appleTouchIcon144)) {
	$APPLICATION->AddHeadString("<link rel='apple-touch-icon' sizes='72x72' href='".$appleTouchIcon144["SRC"]."' />", true);
	$APPLICATION->AddHeadString("<link rel='apple-touch-icon' sizes='144x144' href='".$appleTouchIcon144["SRC"]."' />", true);
} elseif(!empty($appleTouchIcon144Def)) {
	$APPLICATION->AddHeadString("<link rel='apple-touch-icon' sizes='72x72' href='".$appleTouchIcon144Def["SRC"]."' />", true);
	$APPLICATION->AddHeadString("<link rel='apple-touch-icon' sizes='144x144' href='".$appleTouchIcon144Def["SRC"]."' />", true);
} else {
	$APPLICATION->AddHeadString("<link rel='apple-touch-icon' sizes='72x72' href='".SITE_TEMPLATE_PATH."/images/apple-touch-icon-144.png' />", true);
	$APPLICATION->AddHeadString("<link rel='apple-touch-icon' sizes='144x144' href='".SITE_TEMPLATE_PATH."/images/apple-touch-icon-144.png' />", true);
}

$colorScheme = $arResult["COLOR_SCHEME"]["VALUE"];
if($colorScheme != "BLUE") {
	$moduleClass::GenerateColorScheme();
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/schemes/".$colorScheme.($colorScheme == "CUSTOM" ? "_".SITE_ID : "")."/colors.css", true);
}

$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/custom.css", true);

if($USER->IsAdmin() && $arResult["SHOW_SETTINGS_PANEL"]["VALUE"] == "Y") {
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/js/spectrum/spectrum.css");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.cookie.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/spectrum/spectrum.js");
	$this->IncludeComponentTemplate();
}

return $arResult;?>