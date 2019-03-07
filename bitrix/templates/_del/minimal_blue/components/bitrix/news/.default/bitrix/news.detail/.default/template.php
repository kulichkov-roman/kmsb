<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
$canEditSections = CIBlock::GetPermission($arResult["IBLOCK_ID"]) >= "U";
?>

<div class="news-item news-detail">
	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
		<a href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" class="lightbox" title="<?=$arResult["NAME"]?>"><img class="detail_picture" border="0" src="/upload/300/500/<?=$arResult["DETAIL_PICTURE"]["ID"]?>.jpg" alt="<?=$arResult["NAME"]?>"  title="<?=$arResult["NAME"]?>" /></a>
	<?endif?>
	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
		<div class="news-date"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></div>
	<?endif;?>
	<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
		<h3><?=$arResult["NAME"]?></h3>
	<?endif;?>
	<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
		<div class="news-detail"><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></div>
	<?endif;?>
	<?if($arResult["NAV_RESULT"]):?>
		<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
		<?echo $arResult["NAV_TEXT"];?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
 	<?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
		<div class="news-detail"><?echo $arResult["DETAIL_TEXT"];?></div>
 	<?else:?>
		<div class="news-detail"><?echo $arResult["PREVIEW_TEXT"];?></div>
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