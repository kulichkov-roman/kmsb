<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$ElementID=$APPLICATION->IncludeComponent(
	"bitrix:catalog.element",
	"",
	Array(
 		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
 		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
 		"PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
		"META_KEYWORDS" => $arParams["DETAIL_META_KEYWORDS"],
		"META_DESCRIPTION" => $arParams["DETAIL_META_DESCRIPTION"],
		"BASKET_URL" => $arParams["BASKET_URL"],
		"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
		"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
		"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
 		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
 		"CACHE_TIME" => $arParams["CACHE_TIME"],
 		"SET_TITLE" => $arParams["SET_TITLE"],
		"PRICE_CODE" => $arParams["PRICE_CODE"],
		"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
		"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
		"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
		"PRICE_VAT_SHOW_VALUE" => $arParams["PRICE_VAT_SHOW_VALUE"],
		"LINK_IBLOCK_TYPE" => $arParams["LINK_IBLOCK_TYPE"],
		"LINK_IBLOCK_ID" => $arParams["LINK_IBLOCK_ID"],
		"LINK_PROPERTY_SID" => $arParams["LINK_PROPERTY_SID"],
		"LINK_ELEMENTS_URL" => $arParams["LINK_ELEMENTS_URL"],

 		"ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
 		"ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
 		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
 		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
	),
	$component
);?>
<?if($arParams["USE_REVIEW"]=="Y" && IsModuleInstalled("forum") && $ElementID):?>
<br />
<?$APPLICATION->IncludeComponent(
	"bitrix:forum.topic.reviews",
	"",
	Array(
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"MESSAGES_PER_PAGE" => $arParams["MESSAGES_PER_PAGE"],
		"USE_CAPTCHA" => $arParams["USE_CAPTCHA"],
		"PATH_TO_SMILE" => $arParams["PATH_TO_SMILE"],
		"FORUM_ID" => $arParams["FORUM_ID"],
		"URL_TEMPLATES_READ" => $arParams["URL_TEMPLATES_READ"],
		"SHOW_LINK_TO_FORUM" => $arParams["SHOW_LINK_TO_FORUM"],
		"ELEMENT_ID" => $ElementID,
 		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"POST_FIRST_MESSAGE" => $arParams["POST_FIRST_MESSAGE"],
		"URL_TEMPLATES_DETAIL" => $arParams["POST_FIRST_MESSAGE"]==="Y"? $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"] :"",
	),
	$component
);?>
<?endif?>
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
  <table cellpadding=0 cellspacing=0 width=100% >
	  <tr><td valign="top" class="RecordsTableHeader"><span class="RecordsTableHeader">Полезная информация</span></td></tr>
   <tr>
		  <td valign=top style="padding:10 30 10 30;" width=100% align=justify>
     <?while($arItem = $res->Fetch()):?>
      <?
       $arItem["DETAIL_PAGE_URL"] = str_replace("#SITE_DIR#", "", $arItem["DETAIL_PAGE_URL"]);
       $arItem["DETAIL_PAGE_URL"] = str_replace("#SECTION_ID#", $arItem["IBLOCK_SECTION_ID"], $arItem["DETAIL_PAGE_URL"]);
       $arItem["DETAIL_PAGE_URL"] = str_replace("#ID#", $arItem["ID"], $arItem["DETAIL_PAGE_URL"]);
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
 <?endif?>
<?endif?>