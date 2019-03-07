<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 36000000;

$arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);

$arParams["DEPTH_LEVEL"] = intval($arParams["DEPTH_LEVEL"]);
if($arParams["DEPTH_LEVEL"] <= 0)
	$arParams["DEPTH_LEVEL"] = 2;

$arResult["SECTIONS"] = array();

if($this->StartResultCache()) {
	if(!CModule::IncludeModule("iblock")) {
		$this->AbortResultCache();
	} else {
		/***SECTIONS***/		
		$arOrder = array(
			"left_margin" => "asc"
		);
		$arFilter = array(	
			"GLOBAL_ACTIVE" => "Y",	
			"<="."DEPTH_LEVEL" => $arParams["DEPTH_LEVEL"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"IBLOCK_ACTIVE" => "Y"
		);
		$arSelect = array("ID", "IBLOCK_ID", "NAME", "DEPTH_LEVEL", "SECTION_PAGE_URL");
		$rsSections = CIBlockSection::GetList($arOrder, $arFilter, false, $arSelect);
		while($arSection = $rsSections->GetNext()) {	
			$arResult["SECTIONS"][] = array(		
				"DEPTH_LEVEL" => $arSection["DEPTH_LEVEL"],
				"~NAME" => $arSection["~NAME"],
				"~SECTION_PAGE_URL" => $arSection["~SECTION_PAGE_URL"]
			);	
			/***SECTION_ELEMENTS***/		
			if($arParams["SHOW_ELEMENTS"] == "Y") {
				$arOrder = array(
					"SORT" => "ASC",
					"ACTIVE_FROM" => "DESC"
				);
				$arFilter = array(
					"ACTIVE" => "Y",
					"IBLOCK_ID" => $arParams["IBLOCK_ID"],		
					"SECTION_ID" => $arSection["ID"],
					"INCLUDE_SUBSECTIONS" => "N"
				);
				$arSelect = array("ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL");
				$rsItems = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);
				while($arItem = $rsItems->GetNext()) {		
					$arResult["SECTIONS"][] = array(		
						"DEPTH_LEVEL" => $arSection["DEPTH_LEVEL"] + 1,
						"~NAME" => $arItem["~NAME"],
						"~SECTION_PAGE_URL" => $arItem["~DETAIL_PAGE_URL"]
					);		
				}
			}
		}

		/***ELEMENTS***/
		if($arParams["SHOW_ELEMENTS"] == "Y") {
			$arOrder = array(
				"SORT" => "ASC",
				"ACTIVE_FROM" => "DESC"
			);
			$arFilter = array(
				"ACTIVE" => "Y",
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"IBLOCK_ACTIVE" => "Y",
				"SECTION_ID" => false	
			);
			$arSelect = array("ID", "IBLOCK_ID", "NAME", "DETAIL_PAGE_URL");
			$rsItems = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);
			while($arItem = $rsItems->GetNext()) {		
				$arResult["SECTIONS"][] = array(		
					"DEPTH_LEVEL" => 1,
					"~NAME" => $arItem["~NAME"],
					"~SECTION_PAGE_URL" => $arItem["~DETAIL_PAGE_URL"]
				);		
			}
		}		
		$this->EndResultCache();
	}
}

/***MENU_LINKS***/
$aMenuLinksNew = array();
$menuIndex = 0;
$previousDepthLevel = 1;
foreach($arResult["SECTIONS"] as $arSection) {
	if($menuIndex > 0)
		$aMenuLinksNew[$menuIndex - 1][3]["IS_PARENT"] = $arSection["DEPTH_LEVEL"] > $previousDepthLevel;
	$previousDepthLevel = $arSection["DEPTH_LEVEL"];
	
	$aMenuLinksNew[$menuIndex++] = array(
		htmlspecialcharsbx($arSection["~NAME"]),
		$arSection["~SECTION_PAGE_URL"],
		array(),
		array(
			"FROM_IBLOCK" => true,
			"IS_PARENT" => false,
			"DEPTH_LEVEL" => $arSection["DEPTH_LEVEL"]
		)
	);
}
return $aMenuLinksNew;?>