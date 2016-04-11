<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                "SECTION_USER_FIELDS" => array("UF_*"),
		"DISPLAY_PANEL" => "N",
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],

		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
	),
	$component
);?>
<?if($arParams["USE_FILTER"]=="Y"):?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.filter",
	"",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"FILTER_NAME" => $arParams["FILTER_NAME"],
		"FIELD_CODE" => $arParams["FILTER_FIELD_CODE"],
 		"PROPERTY_CODE" => $arParams["FILTER_PROPERTY_CODE"],
		"PRICE_CODE" => $arParams["FILTER_PRICE_CODE"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
	),
	$component
);
?>
<br />
<?endif?>
<?if($arParams["USE_COMPARE"]=="Y"):?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.compare.list",
	"",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"NAME" => $arParams["COMPARE_NAME"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
		"COMPARE_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["compare"],
	),
	$component
);?>
<br />
<?endif?>
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	"",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
		"ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
 		"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
		"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
		"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
		"INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
		"BASKET_URL" => $arParams["BASKET_URL"],
		"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
		"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
		"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
		"FILTER_NAME" => $arParams["FILTER_NAME"],
		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_FILTER" => $arParams["CACHE_FILTER"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
		"PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
		"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
		"PRICE_CODE" => $arParams["PRICE_CODE"],
		"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
		"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

		"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],

		"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["PAGER_TITLE"],
		"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
		"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
		"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
		"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],

		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
	),
	$component
);
?>
<?
 CModule::IncludeModule("iblock");
 $arFilter = Array('IBLOCK_ID'=>$arParams["IBLOCK_ID"], 'GLOBAL_ACTIVE'=>'Y', "CODE"=>$arResult["VARIABLES"]["SECTION_CODE"]);
 $db_list = CIBlockSection::GetList(Array(), $arFilter, false);
?>
<?if($sec = $db_list->Fetch()):?>
 <?
  $arSelect = Array("ID", "IBLOCK_SECTION_ID", "NAME", "PREVIEW_PICTURE", "PREVIEW_TEXT", "DETAIL_PAGE_URL");
  $arFilter = Array("IBLOCK_ID"=>2, "ACTIVE"=>"Y", "PROPERTY_section"=>$sec["ID"]);
  $res = CIBlockElement::GetList(Array("sort"=>"asc", "name"=>"asc"), $arFilter, false, false, $arSelect);
 ?>
 <?if($res->SelectedRowsCount()):?>
  <br><br>
<noindex>  
<table cellpadding=0 cellspacing=0 width=100% >
	  <tr><td valign="top" class="RecordsTableHeader"><span class="RecordsTableHeader">Полезная информация</span></td></tr>
   <tr>
		  <td valign=top style="padding:10 30 10 30;" width=100% align=justify>
     <?while($arItem = $res->Fetch()):?>
      <?
       $arItem["DETAIL_PAGE_URL"] = str_replace("#SITE_DIR#", "", $arItem["DETAIL_PAGE_URL"]);
       $arItem["DETAIL_PAGE_URL"] = str_replace("#SECTION_ID#", $arItem["IBLOCK_SECTION_ID"], $arItem["DETAIL_PAGE_URL"]);
       $arItem["DETAIL_PAGE_URL"] = str_replace("#ELEMENT_CODE#", $arItem["CODE"], $arItem["DETAIL_PAGE_URL"]);
       if($arItem["PREVIEW_PICTURE"])
       {
         $rsFile = CFile::GetByID($arItem["PREVIEW_PICTURE"]);
		       $arItem["PREVIEW_PICTURE"] = $rsFile->Fetch();
       }
      ?>
      <p align="justify"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><b><?=$arItem["NAME"]?></b></a></p>
      <?if(is_array($arItem["PREVIEW_PICTURE"])):?>
       <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img border="0" src="/upload/<?=$arItem["PREVIEW_PICTURE"]["SUBDIR"]?>/<?=$arItem["PREVIEW_PICTURE"]["FILE_NAME"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" style="float: left; margin-right: 5px; margin-bottom: 5px;"></a>
					 <?endif?>
      <p align="justify"><?=$arItem["PREVIEW_TEXT"]?> <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><b>...подробнее...</b></a></p>
      <br>
     <?endwhile?>
    </td>
   </tr>
  </table>
</noindex>
 <?endif?>
<?endif?>