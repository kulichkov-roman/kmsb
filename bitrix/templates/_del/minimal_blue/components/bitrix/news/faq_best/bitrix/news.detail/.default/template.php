<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
$canEditSections = CIBlock::GetPermission($arResult["IBLOCK_ID"]) >= "U";
?>

<div class="news-item news-detail">
	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
		<div class="news-date"><?=$arResult["DISPLAY_ACTIVE_FROM"]?> <span><?=$arResult["NAME"]?></span></div>
	<?endif;?>
	<?echo $arResult["PREVIEW_TEXT"];?>
 <?if(strlen($arResult["DETAIL_TEXT"])>0):?>
  <div class="faq-answer">Ответ</div>
  <?echo $arResult["DETAIL_TEXT"];?>
 <?endif?>

	<?if ($canEditSections):
		$arEditButton = CIBlock::GetPanelButtons($arResult["IBLOCK_ID"], $arResult["ID"], $arResult["IBLOCK_SECTION_ID"]);
		$arDeleteButton = CIBlock::GetPanelButtons($arResult["IBLOCK_ID"], $arResult["ID"], $arResult["IBLOCK_SECTION_ID"], Array("RETURN_URL" => $arResult["LIST_PAGE_URL"]));
	?>
	<div class="catalog-admin-links">
		<a href="<?=$arEditButton["edit"]["edit_element"]["ACTION"]?>" title="<?=$arEditButton["edit"]["edit_element"]["TITLE"]?>"><?=$arEditButton["edit"]["edit_element"]["TEXT"]?></a>
		<a href="" onclick="if(confirm('<?=CUtil::JSEscape(GetMessage("NEWS_DELETE_CONFIRM"))?>')) <?=$arDeleteButton["edit"]["delete_element"]["ONCLICK"]?>; return false;" title="<?=$arDeleteButton["edit"]["delete_element"]["TITLE"]?>"><?=$arDeleteButton["edit"]["delete_element"]["TEXT"]?></a>
	</div>
	<?endif?>

</div>


<?if ($canEditSections):?>
<script type="text/javascript">
	$(function(){
		$("#workarea div.news-item").bind({
			mouseover: function() { $(this).removeClass("news-item-hover").addClass("news-item-hover"); },
			mouseout: function() { $(this).removeClass("news-item-hover"); }
		});
	});
</script>
<?endif?>