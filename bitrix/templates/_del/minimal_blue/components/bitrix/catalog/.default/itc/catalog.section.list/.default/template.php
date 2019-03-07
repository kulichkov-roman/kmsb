<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$canEditSections = CIBlock::GetPermission($arParams["IBLOCK_ID"]) >= "U";
if ($canEditSections):

$arButtons = CIBlock::GetPanelButtons($arParams["IBLOCK_ID"], 0, $arResult["SECTION"]["ID"]);

?>

<div class="catalog-admin-buttons">
	<a href="" onclick="<?=$arButtons["edit"]["add_section"]["ONCLICK"]?>; return false;" title="<?=$arButtons["edit"]["add_section"]["TITLE"]?>"><span><?=$arButtons["edit"]["add_section"]["TEXT"]?></span></a>
</div>

<?if (count($arResult["SECTIONS"]) < 1):?>
	<p><span class="notetext"><?=GetMessage("CATALOG_EMPTY_CATALOG")?></span></p>
<?	return;
endif?>

<?endif?>



<div class="catalog-section-list">
<?
$NUM_COLS = 3;
$CURRENT_DEPTH=$arResult["SECTION"]["DEPTH_LEVEL"]+1;
foreach($arResult["SECTIONS"] as $arSection):

	$bHasPicture = is_array($arSection['PICTURE_PREVIEW']);
	$bHasChildren = is_array($arSection['CHILDREN']) && count($arSection['CHILDREN']) > 0;
?>
	<div class="catalog-section<?=$bHasPicture ? '' : ' no-picture-mode'?>">
	
		<?if ($bHasPicture):?>
		<div class="catalog-section-image"><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><img src="<?=$arSection['PICTURE_PREVIEW']['SRC']?>" width="<?=$arSection['PICTURE_PREVIEW']['WIDTH']?>" height="<?=$arSection['PICTURE_PREVIEW']['HEIGHT']?>" /></a></div>
		<?endif;?>

		<div class="catalog-section-info">
		<?if ($arSection['NAME'] && $arResult['SECTION']['ID'] != $arSection['ID']):?>
			<div class="catalog-section-title"><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a></div>
		<?endif;?>
		<?if ($arSection['DESCRIPTION']):?>
			<div class="catalog-section-desc"><?=$arSection['DESCRIPTION_TYPE'] == 'text' ? $arSection['DESCRIPTION'] : $arSection['~DESCRIPTION']?></div>
		<?endif;?>

		<?if ($bHasChildren):?>
			<div class="catalog-section-childs">
				<table cellspacing="0" class="catalog-section-childs">
				<?
				$cell = 0;
				foreach ($arSection['CHILDREN'] as $key => $arChild):
					if ($cell == 0):?>
					<tr>
				<?
			endif;
			$cell++;?>
						<td><a href="<?=$arChild["SECTION_PAGE_URL"]?>"><?=$arChild['NAME']?></a></td>
			<?if ($cell == $NUM_COLS):
				$cell = 0;?>
					</tr>
			<?endif;endforeach;
			
			if ($cell > 0):
				while ($cell++ < $NUM_COLS):?>
						<td>&nbsp;</td>
			<?endwhile;?>
					</tr>
		<?endif;?>
				</table>
			</div>
		<?endif;?>
		</div>
		<?if ($canEditSections):
			$arButtons = CIBlock::GetPanelButtons($arParams["IBLOCK_ID"], 0, $arSection["ID"]);
		?>
		<div class="catalog-admin-links">
			<a href="" onclick="<?=$arButtons["edit"]["edit_section"]["ONCLICK"]?>; return false;" title="<?=$arButtons["edit"]["edit_section"]["TITLE"]?>"><?=$arButtons["edit"]["edit_section"]["TEXT"]?></a>
			<a href="" onclick="if(confirm('<?=CUtil::JSEscape(GetMessage("CATALOG_SECTION_DELETE_CONFIRM"))?>')) <?=$arButtons["edit"]["delete_section"]["ONCLICK"]?>; return false;" title="<?=$arButtons["edit"]["delete_section"]["TITLE"]?>"><?=$arButtons["edit"]["delete_section"]["TEXT"]?></a>
		</div>	
		<?endif?>

	</div>
	<div class="catalog-section-separator"></div>
<?endforeach;?>
</div>

<?if ($canEditSections):?>
<script type="text/javascript">
	$(function() {
		$("#workarea div.catalog-section-list > div.catalog-section").data("adminMode", true).bind({
			mouseover: function() { $(this).removeClass("catalog-section-hover").addClass("catalog-section-hover"); },
			mouseout: function() { $(this).removeClass("catalog-section-hover"); }
		});
	});
					
</script>
<?endif?>