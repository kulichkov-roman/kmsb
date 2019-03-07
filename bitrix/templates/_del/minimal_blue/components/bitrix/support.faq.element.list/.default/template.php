<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$canEditSections = CIBlock::GetPermission($arParams["IBLOCK_ID"]) >= "U";
if ($canEditSections):

$arButtons = CIBlock::GetPanelButtons($arParams["IBLOCK_ID"], 0, $arParams["SECTION_ID"]);
?>

<div class="catalog-admin-buttons">
	<a href="" onclick="<?=$arButtons["edit"]["add_element"]["ONCLICK"]?>; return false;" title="<?=$arButtons["edit"]["add_element"]["TITLE"]?>"><span><?=$arButtons["edit"]["add_element"]["TEXT"]?></span></a>
</div>

<?endif?>


<?
if (count($arResult["ITEMS"]) < 1)
	return;
?>


<div class="faq-list">

	<ul>
		<?foreach ($arResult["ITEMS"] as $val):?>
		<li><a href="#<?=$val["ID"]?>"><?=$val["NAME"]?></a></li>
		<?endforeach;?>
	</ul>

	<?foreach ($arResult["ITEMS"] as $val):?>

	<div class="faq-item" id="<?=$val["ID"]?>">

		<h2><?=$val["NAME"]?></h2>
		<div class="faq-item-answer">
			<?=$val["DETAIL_TEXT"]?>
		</div>
		<?if ($canEditSections):
			$arButtons = CIBlock::GetPanelButtons($val["IBLOCK_ID"], $val["ID"], $val["IBLOCK_SECTION_ID"]);
		?>
		<div class="catalog-admin-links">
			<a href="<?=$arButtons["edit"]["edit_element"]["ACTION"]?>" title="<?=$arButtons["edit"]["edit_element"]["TITLE"]?>"><?=$arButtons["edit"]["edit_element"]["TEXT"]?></a>
			<a href="" onclick="if(confirm('<?=CUtil::JSEscape(GetMessage("FAQ_DELETE_CONFIRM"))?>')) <?=$arButtons["edit"]["delete_element"]["ONCLICK"]?>; return false;" title="<?=$arButtons["edit"]["delete_element"]["TITLE"]?>"><?=$arButtons["edit"]["delete_element"]["TEXT"]?></a>
		</div>
		<?endif?>
	</div>

	<?endforeach;?>


</div>

<?if ($canEditSections):?>
<script type="text/javascript">

	$(function() {
		$("#workarea div.faq-item").bind({
			mouseover: function() { $(this).removeClass("faq-item-hover").addClass("faq-item-hover"); },
			mouseout: function() { $(this).removeClass("faq-item-hover"); }
		});
	});
</script>
<?endif?>
