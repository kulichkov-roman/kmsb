<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


$canEditSections = CIBlock::GetPermission($arParams["IBLOCK_ID"]) >= "U";
if ($canEditSections):


$arButtons = CIBlock::GetPanelButtons($arParams["IBLOCK_ID"], 0, 0);
?>

<div class="catalog-admin-buttons">
	<a href="" onclick="<?=$arButtons["edit"]["add_element"]["ONCLICK"]?>; return false;" title="<?=$arButtons["edit"]["add_element"]["TITLE"]?>"><span><?=$arButtons["edit"]["add_element"]["TEXT"]?></span></a>
</div>

<?endif?>


<?
if (count($arResult["ITEMS"]) < 1)
	return;
?>

<div class="news-list">

<?foreach($arResult["ITEMS"] as $arItem):?>
	<div class="news-item">
  <?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
			<div class="news-date"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?> <span><?echo $arItem["NAME"]?></span></div>
		<?endif?>
		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
			<div class="news-detail"><?echo $arItem["PREVIEW_TEXT"];?></div>
		<?endif;?>
  <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["DETAIL_TEXT"]):?>
   <div class="faq-answer">Ответ</div>
			<div class="news-detail"><?echo $arItem["DETAIL_TEXT"];?></div>
		<?endif;?>

		<?if ($canEditSections):
			$arButtons = CIBlock::GetPanelButtons($arItem["IBLOCK_ID"], $arItem["ID"], $arItem["IBLOCK_SECTION_ID"]);
		?>
		<div class="catalog-admin-links">
			<a href="<?=$arButtons["edit"]["edit_element"]["ACTION"]?>" title="<?=$arButtons["edit"]["edit_element"]["TITLE"]?>"><?=$arButtons["edit"]["edit_element"]["TEXT"]?></a>
			<a href="" onclick="if(confirm('<?=CUtil::JSEscape(GetMessage("NEWS_DELETE_CONFIRM"))?>')) <?=$arButtons["edit"]["delete_element"]["ONCLICK"]?>; return false;" title="<?=$arButtons["edit"]["delete_element"]["TITLE"]?>"><?=$arButtons["edit"]["delete_element"]["TEXT"]?></a>
		</div>
		<?endif?>
  <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
   <div style="clear: both;"></div>
  <?endif?>
	</div>
<?endforeach;?>
</div>

<?if ($canEditSections):?>
<script type="text/javascript">

	$(function() {
		$("#workarea div.news-item").bind({
			mouseover: function() { $(this).removeClass("news-item-hover").addClass("news-item-hover"); },
			mouseout: function() { $(this).removeClass("news-item-hover"); }
		});
	});

</script>
<?endif?>


<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
