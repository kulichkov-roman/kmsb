<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$canEditSections = CIBlock::GetPermission($arParams["IBLOCK_ID"]) >= "U";

if ($canEditSections):

$arButtons = CIBlock::GetPanelButtons($arParams["IBLOCK_ID"], 0, $arResult["ID"]);

$arAddSectionButton = CIBlock::GetPanelButtons($arParams["IBLOCK_ID"], 0, $arResult["ID"], Array("RETURN_URL" => CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_PAGE_URL")));

if($arResult["IBLOCK_SECTION_ID"] > 0)
{
	$rsSection = CIBlockSection::GetList(array(), array("=ID" => $arResult["IBLOCK_SECTION_ID"]), false, array("SECTION_PAGE_URL"));
	$arSection = $rsSection->GetNext();
	$arDeleteSectionButton = CIBlock::GetPanelButtons($arSection["IBLOCK_ID"], 0, $arResult["ID"], Array("RETURN_URL" => $arSection["SECTION_PAGE_URL"]));
}
else
{
	$url_template = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "LIST_PAGE_URL");
	$arIBlock = CIBlock::GetArrayByID($arParams["IBLOCK_ID"]);
	$arIBlock["IBLOCK_CODE"] = $arIBlock["CODE"];
	$arDeleteSectionButton = CIBlock::GetPanelButtons($arParams["IBLOCK_ID"], 0, $arResult["ID"], Array("RETURN_URL" => CIBlock::ReplaceDetailURL($url_template, $arIBlock, true, false)));
}


?>

<div class="catalog-admin-buttons">
	<a href="" onclick="<?=$arButtons["edit"]["add_element"]["ONCLICK"]?>; return false;" title="<?=$arButtons["edit"]["add_element"]["TITLE"]?>"><span><?=$arButtons["edit"]["add_element"]["TEXT"]?></span></a>
	<a href="" onclick="<?=$arAddSectionButton["edit"]["add_section"]["ONCLICK"]?>; return false;" title="<?=$arAddSectionButton["edit"]["add_section"]["TITLE"]?>"><span><?=$arAddSectionButton["edit"]["add_section"]["TEXT"]?></span></a>
	<a href="" onclick="<?=$arButtons["edit"]["edit_section"]["ONCLICK"]?>; return false;" title="<?=$arButtons["edit"]["edit_section"]["TITLE"]?>"><span><?=$arButtons["edit"]["edit_section"]["TEXT"]?></span></a>
	<a href="" onclick="if(confirm('<?=CUtil::JSEscape(GetMessage("CATALOG_SECTION_DELETE_CONFIRM"))?>')) <?=$arDeleteSectionButton["edit"]["delete_section"]["ONCLICK"]?>; return false;" title="<?=$arDeleteSectionButton["edit"]["delete_section"]["TITLE"]?>"><span><?=$arDeleteSectionButton["edit"]["delete_section"]["TEXT"]?></span></a>
</div>

<?endif?>

<?
if (count($arResult['ITEMS']) < 1)
	return;
?>

<div class="catalog-item-list">
<?
foreach ($arResult['ITEMS'] as $key => $arElement):

	//print_r($arElement);

	$bHasPicture = is_array($arElement['PREVIEW_IMG']);

	$sticker = "";
	if (array_key_exists("PROPERTIES", $arElement) && is_array($arElement["PROPERTIES"]))
	{
		foreach (Array("SPECIALOFFER", "NEWPRODUCT", "SALELEADER") as $propertyCode)
			if (array_key_exists($propertyCode, $arElement["PROPERTIES"]) && intval($arElement["PROPERTIES"][$propertyCode]["PROPERTY_VALUE_ID"]) > 0)
				$sticker .= "&nbsp;<span class=\"sticker\">".$arElement["PROPERTIES"][$propertyCode]["NAME"]."</span>";
	}

?>
	<div class="catalog-item<?if (!$bHasPicture):?> no-picture-mode<?endif;?>">
		<div class="catalog-item-info">

		<?if($bHasPicture):?>
			<div class="catalog-item-image">
				<a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><img src="<?=$arElement["PREVIEW_IMG"]["SRC"]?>" width="<?=$arElement["PREVIEW_IMG"]["WIDTH"]?>" height="<?=$arElement["PREVIEW_IMG"]["HEIGHT"]?>" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" id="catalog_list_image_<?=$arElement['ID']?>" /></a>
			</div>
		<?endif;?>

			<div class="catalog-item-desc">
				<div class="catalog-item-title"><a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a><?=$sticker?></div>
				<div class="catalog-item-preview-text"><?=$arElement['PREVIEW_TEXT']?></div>

			<?foreach($arElement["PRICES"] as $code=>$arPrice):
				if($arPrice["CAN_ACCESS"]):
?>
				<div class="catalog-item-price" id="price-<?=$arElement["ID"]?>"><b>Цена:</b> 
				<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
					<span class="catalog-item-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span> <s><?=$arPrice["PRINT_VALUE"]?></s>
				<?else:?>
					<span class="catalog-item-price"><?=$arPrice["PRINT_VALUE"]?></span>
				<?endif;?>
				</div>
			<?
				endif;
			endforeach;
			?>
			</div>
		</div>
		<div class="catalog-item-links">
			<!--noindex-->
		<?if ($arElement['CAN_BUY'] && $arElement['CATALOG_QUANTITY']):?>
			<a href="<?/*=$arElement["ADD_URL"]*/?>/catalog/in_basket.php?id=<?=$arElement["ID"]?>" class="catalog-item-buy<?/*catalog-item-in-the-cart*/?>" rel="nofollow"  onclick="return addToCart(this, 'catalog_list_image_<?=$arElement['ID']?>', 'list', '<?=GetMessage("CATALOG_IN_CART")?>');" id="catalog_add2cart_link_<?=$arElement['ID']?>"><?echo GetMessage("CATALOG_ADD")?></a>
		<?elseif (count($arResult["PRICES"]) > 0):?>
			<span class="catalog-item-not-available"><?=GetMessage('CATALOG_NOT_AVAILABLE')?></span>
		<?endif;?>

		<?if($arParams["DISPLAY_COMPARE"]):?>
			<a href="<?echo $arElement["COMPARE_URL"]?>" class="catalog-item-compare" onclick="return addToCompare(this, '<?=GetMessage("CATALOG_IN_COMPARE")?>');" rel="nofollow" id="catalog_add2compare_link_<?=$arElement['ID']?>"><?echo GetMessage("CATALOG_COMPARE")?></a>
		<?endif;?>
			<!--noindex-->
		</div>
		<?if ($canEditSections):
			$arButtons = CIBlock::GetPanelButtons($arParams["IBLOCK_ID"], $arElement["ID"], $arResult["ID"]);
		?>
		<div class="catalog-admin-links">
			<a href="" onclick="<?=$arButtons["edit"]["edit_element"]["ONCLICK"]?>; return false;" title="<?=$arButtons["edit"]["edit_element"]["TITLE"]?>"><?=$arButtons["edit"]["edit_element"]["TEXT"]?></a>
			<a href="" onclick="if(confirm('<?=CUtil::JSEscape(GetMessage("CATALOG_PRODUCT_DELETE_CONFIRM"))?>')) <?=$arButtons["edit"]["delete_element"]["ONCLICK"]?>; return false;" title="<?=$arButtons["edit"]["delete_element"]["TITLE"]?>"><?=$arButtons["edit"]["delete_element"]["TEXT"]?></a>
		</div>
		<?endif?>
	</div>
	<div class="catalog-item-separator"></div>
<?endforeach;?>
</div>

<?if ($canEditSections):?>
<script type="text/javascript">
	$(function() {
		$("#workarea div.catalog-item-list > div.catalog-item").data("adminMode", true).bind({
			mouseover: function() { $(this).removeClass("catalog-item-hover").addClass("catalog-item-hover"); },
			mouseout: function() { $(this).removeClass("catalog-item-hover"); }
		});
	});

</script>
<?endif?>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"];?>
<?endif;?>