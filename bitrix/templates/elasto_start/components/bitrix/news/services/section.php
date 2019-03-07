<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

if($arResult["VARIABLES"]["SECTION_ID"] || $arResult["VARIABLES"]["SECTION_CODE"]):?>
	<!--CURRENT_SECTION_FIELDS-->
	<?$arFilter = array();

	$arFilter = array(
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ACTIVE" => "Y",
		"GLOBAL_ACTIVE" => "Y",
	);

	if(intval($arResult["VARIABLES"]["SECTION_ID"]) > 0) {
		$arFilter["ID"] = $arResult["VARIABLES"]["SECTION_ID"];
	} elseif($arResult["VARIABLES"]["SECTION_CODE"] != "") {
		$arFilter["=CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];
	}

	$arSelect = array("ID", "IBLOCK_ID", "NAME", "PICTURE", "DESCRIPTION", "UF_PREVIEW");
			
	$rsSections = CIBlockSection::GetList(array(), $arFilter, false, $arSelect);
	if($arSection = $rsSections->Fetch()) {
		$arCurSection["ID"] = $arSection["ID"];
		$arCurSection["IBLOCK_ID"] = $arSection["IBLOCK_ID"];
		$arCurSection["NAME"] = $arSection["NAME"];
		$arCurSection["PICTURE"] = $arSection["PICTURE"] > 0 ? CFile::GetFileArray($arSection["PICTURE"]) : "";
		$arCurSection["DESCRIPTION"] = $arSection["DESCRIPTION"];
		$arCurSection["PREVIEW"] = $arSection["UF_PREVIEW"];		
		$ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($arCurSection["IBLOCK_ID"], $arCurSection["ID"]);
		$arCurSection["IPROPERTY_VALUES"] = $ipropValues->getValues();		
	}?>

	<!--PREVIEW-->
	<?if(!empty($arCurSection["PREVIEW"])):
		if(!$_REQUEST["PAGEN_1"] || empty($_REQUEST["PAGEN_1"]) || $_REQUEST["PAGEN_1"] <= 1):?>
			<div class="preview">
				<?=$arCurSection["PREVIEW"];?>
			</div>
		<?endif;
	endif;?>

	<div class="services-sect-list">
		<!--SECTIONS-->
		<?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "",
			Array(
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
				"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
				"COUNT_ELEMENTS" => "N",
				"TOP_DEPTH" => "1",
				"SECTION_FIELDS" => array(),
				"SECTION_USER_FIELDS" => array(
					0 => "UF_SHORT_DESC",
					1 => "UF_ICON"
				),
				"VIEW_MODE" => "",
				"SHOW_PARENT_NAME" => "",
				"SECTION_URL" => "",
				"CACHE_TYPE" => $arParams["CACHE_TYPE"],
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
				"ADD_SECTIONS_CHAIN" => "N"
			),
			$component
		);?>

		<!--ELEMENTS-->	
		<?$APPLICATION->IncludeComponent("bitrix:news.list", "services",
			Array(
				"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
				"DISPLAY_NAME" => $arParams["DISPLAY_NAME"],
				"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
				"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
				"AJAX_MODE" => $arParams["AJAX_MODE"],
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"NEWS_COUNT" => $arParams["NEWS_COUNT"],
				"SORT_BY1" => $arParams["SORT_BY1"],
				"SORT_ORDER1" => $arParams["SORT_ORDER1"],
				"SORT_BY2" => $arParams["SORT_BY2"],
				"SORT_ORDER2" => $arParams["SORT_ORDER2"],
				"FILTER_NAME" => $arParams["FILTER_NAME"],
				"FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
				"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
				"CHECK_DATES" => $arParams["CHECK_DATES"],
				"DETAIL_URL" => $arParams["DETAIL_URL"],
				"PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
				"ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
				"SET_TITLE" => $arParams["SET_TITLE"],
				"SET_BROWSER_TITLE" => $arParams["SET_BROWSER_TITLE"],
				"SET_META_KEYWORDS" => $arParams["SET_META_KEYWORDS"],
				"SET_META_DESCRIPTION" => $arParams["SET_META_DESCRIPTION"],
				"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
				"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
				"ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
				"HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
				"PARENT_SECTION" => $arResult["VARIABLES"]["SECTION_ID"],
				"PARENT_SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
				"INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
				"CACHE_TYPE" => $arParams["CACHE_TYPE"],
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"CACHE_FILTER" => $arParams["CACHE_FILTER"],
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
				"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
				"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
				"PAGER_TITLE" => $arParams["PAGER_TITLE"],
				"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
				"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
				"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
				"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
				"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
				"PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
				"SET_STATUS_404" => $arParams["SET_STATUS_404"],
				"SHOW_404" => $arParams["SHOW_404"],
				"MESSAGE_404" => $arParams["MESSAGE_404"],
				"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
				"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
				"AJAX_OPTION_JUMP" => $arParams["AJAX_OPTION_JUMP"],
				"AJAX_OPTION_STYLE" => $arParams["AJAX_OPTION_STYLE"],
				"AJAX_OPTION_HISTORY" => $arParams["AJAX_OPTION_HISTORY"],
				"AJAX_OPTION_ADDITIONAL" => $arParams["AJAX_OPTION_ADDITIONAL"]
			),
			$component
		);?>
	</div>

	<!--DESCRIPTION-->
	<?if(!empty($arCurSection["DESCRIPTION"])):
		if(!$_REQUEST["PAGEN_1"] || empty($_REQUEST["PAGEN_1"]) || $_REQUEST["PAGEN_1"] <= 1):?>
			<div class="description">
				<?=$arCurSection["DESCRIPTION"];?>
			</div>
		<?endif;
	endif;?>

	<!--TITLE-->
	<?if(!empty($_REQUEST["PAGEN_1"]) && $_REQUEST["PAGEN_1"] > 1):
		if(!empty($arCurSection["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"])):
			$APPLICATION->SetTitle($arCurSection["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]);
			$APPLICATION->SetPageProperty("title", $arCurSection["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]." | ".GetMessage("SECT_TITLE")." ".$_REQUEST["PAGEN_1"]);
		elseif(!empty($arCurSection["NAME"])):
			$APPLICATION->SetTitle($arCurSection["NAME"]);
			$APPLICATION->SetPageProperty("title", $arCurSection["NAME"]." | ".GetMessage("SECT_TITLE")." ".$_REQUEST["PAGEN_1"]);
		endif;
		$APPLICATION->SetPageProperty("keywords", "");
		$APPLICATION->SetPageProperty("description", "");
	else:
		if(!empty($arCurSection["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"])):
			$APPLICATION->SetTitle($arCurSection["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]);
		elseif(!empty($arCurSection["NAME"])):
			$APPLICATION->SetTitle($arCurSection["NAME"]);
		endif;
	endif;?>

	<!--META_PROPERTY-->
	<?$APPLICATION->AddHeadString("<meta property='og:title' content='".(!empty($arCurSection["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]) ? $arCurSection["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"] : $arCurSection["NAME"])."' />", true);
	if(!empty($arCurSection["PREVIEW"])):
		$APPLICATION->AddHeadString("<meta property='og:description' content='".strip_tags($arCurSection["PREVIEW"])."' />", true);
	endif;
	$APPLICATION->AddHeadString("<meta property='og:url' content='http://".SITE_SERVER_NAME.$APPLICATION->GetCurPage()."' />", true);
	if(!empty($arCurSection["PICTURE"])):
		$APPLICATION->AddHeadString("<meta property='og:image' content='http://".SITE_SERVER_NAME.$arCurSection["PICTURE"]["SRC"]."' />", true);
		$APPLICATION->AddHeadString("<meta property='og:image:width' content='".$arCurSection["PICTURE"]["WIDTH"]."' />", true);
		$APPLICATION->AddHeadString("<meta property='og:image:height' content='".$arCurSection["PICTURE"]["HEIGHT"]."' />", true);
		$APPLICATION->AddHeadString("<link rel='image_src' href='http://".SITE_SERVER_NAME.$arCurSection["PICTURE"]["SRC"]."' />", true);
	endif;
else:?>
	<!--ELEMENT-->
	<?$APPLICATION->IncludeComponent("bitrix:news.detail", "",
		Array(
			"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
			"DISPLAY_NAME" => $arParams["DISPLAY_NAME"],
			"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
			"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
			"USE_SHARE" => $arParams["USE_SHARE"],
			"SHARE_HIDE" => $arParams["SHARE_HIDE"],
			"SHARE_TEMPLATE" => $arParams["SHARE_TEMPLATE"],
			"SHARE_HANDLERS" => $arParams["SHARE_HANDLERS"],
			"SHARE_SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
			"SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
			"AJAX_MODE" => $arParams["AJAX_MODE"],
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
			"ELEMENT_CODE" => $arResult["VARIABLES"]["SECTION_CODE_PATH"],
			"CHECK_DATES" => $arParams["CHECK_DATES"],
			"FIELD_CODE" => $arParams["DETAIL_FIELD_CODE"],
			"PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
			"IBLOCK_URL" => $arParams["IBLOCK_URL"],
			"DETAIL_URL" => $arParams["DETAIL_URL"],
			"SET_TITLE" => $arParams["SET_TITLE"],
			"SET_CANONICAL_URL" => $arParams["DETAIL_SET_CANONICAL_URL"],
			"SET_BROWSER_TITLE" => $arParams["SET_BROWSER_TITLE"],
			"BROWSER_TITLE" => $arParams["BROWSER_TITLE"],
			"SET_META_KEYWORDS" => $arParams["SET_META_KEYWORDS"],
			"META_KEYWORDS" => $arParams["META_KEYWORDS"],
			"SET_META_DESCRIPTION" => $arParams["SET_META_DESCRIPTION"],
			"META_DESCRIPTION" => $arParams["META_DESCRIPTION"],
			"SET_STATUS_404" => $arParams["SET_STATUS_404"],
			"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
			"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
			"ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
			"ADD_ELEMENT_CHAIN" => $arParams["ADD_ELEMENT_CHAIN"],
			"ACTIVE_DATE_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
			"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
			"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"DISPLAY_TOP_PAGER" => $arParams["DETAIL_DISPLAY_TOP_PAGER"],
			"DISPLAY_BOTTOM_PAGER" => $arParams["DETAIL_DISPLAY_BOTTOM_PAGER"],
			"PAGER_TITLE" => $arParams["DETAIL_PAGER_TITLE"],
			"PAGER_TEMPLATE" => $arParams["DETAIL_PAGER_TEMPLATE"],
			"PAGER_SHOW_ALL" => $arParams["DETAIL_PAGER_SHOW_ALL"],
			"PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
			"SET_STATUS_404" => $arParams["SET_STATUS_404"],
			"SHOW_404" => $arParams["SHOW_404"],
			"MESSAGE_404" => $arParams["MESSAGE_404"],
			"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
			"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
			"AJAX_OPTION_JUMP" => $arParams["AJAX_OPTION_JUMP"],
			"AJAX_OPTION_STYLE" => $arParams["AJAX_OPTION_STYLE"],
			"AJAX_OPTION_HISTORY" => $arParams["AJAX_OPTION_HISTORY"]
		),		
		$component
	);?>
<?endif;?>