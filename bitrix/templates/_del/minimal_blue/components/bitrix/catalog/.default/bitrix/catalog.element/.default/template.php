<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$canEditSections = CIBlock::GetPermission($arParams["IBLOCK_ID"]) >= "U";
?>
<?if (is_array($arResult['DETAIL_PICTURE_350']) || count($arResult["MORE_PHOTO"])>0):?>
<script type="text/javascript">
$(function() {
	$('div.catalog-detail-image a').fancybox({
		'transitionIn': 'elastic',
		'transitionOut': 'elastic',
		'speedIn': 600,
		'speedOut': 200,
		'overlayShow': false,
		'cyclic' : true 
	});
});
</script>
<?endif;?>

<div class="catalog-detail">
	<table class="catalog-detail" cellspacing="0">
		<tr>

		<?if (is_array($arResult['DETAIL_PICTURE_350']) || count($arResult["MORE_PHOTO"])>0):?>
			<td class="catalog-detail-image">
			<?if (is_array($arResult['DETAIL_PICTURE_350'])):?>
				<div class="catalog-detail-image" id="catalog-detail-main-image">
					<a rel="catalog-detail-images" href="<?=$arResult['DETAIL_PICTURE']['SRC']?>" title="<?=(strlen($arResult["DETAIL_PICTURE"]["DESCRIPTION"]) > 0 ? $arResult["DETAIL_PICTURE"]["DESCRIPTION"] : $arResult["NAME"])?>"><img src="<?=$arResult['DETAIL_PICTURE_350']['SRC']?>" alt="<?=$arResult["NAME"]?>" id="catalog_detail_image" width="<?=$arResult['DETAIL_PICTURE_350']["WIDTH"]?>" height="<?=$arResult['DETAIL_PICTURE_350']["HEIGHT"]?>" /></a>
				</div>
			<?endif;?>
				<div class="catalog-detail-images">
			<?if(count($arResult["MORE_PHOTO"])>0):
				foreach($arResult["MORE_PHOTO"] as $PHOTO):
			?>
				<div class="catalog-detail-image"><a rel="catalog-detail-images" href="<?=$PHOTO["SRC"]?>" title="<?=(strlen($PHOTO["DESCRIPTION"]) > 0 ? $PHOTO["DESCRIPTION"] : $arResult["NAME"])?>"><img border="0" src="<?=$PHOTO["SRC_PREVIEW"]?>" width="<?=$PHOTO["PREVIEW_WIDTH"]?>" height="<?=$PHOTO["PREVIEW_HEIGHT"]?>" alt="<?=$arResult["NAME"]?>" /></a></div>
			<?
				endforeach;
			endif?>

				</div>
			</td>
		<?endif;?>

			<td class="catalog-detail-desc">
			<?if($arResult["PREVIEW_TEXT"]):?>
				<?=str_replace("\n", "<BR>",$arResult["PREVIEW_TEXT"]);?>
				<div class="catalog-detail-line"></div>
			<?endif;?>
				
				<div class="catalog-detail-price">
				<?foreach($arResult["PRICES"] as $code=>$arPrice):
					if($arPrice["CAN_ACCESS"]):
				?>
					<label><?=GetMessage("CATALOG_PRICE")?></label>
					<p id="detail-price">
					<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
						<span class="catalog-detail-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span> <s><?=$arPrice["PRINT_VALUE"]?></s>
					<?else:?>
						<span class="catalog-detail-price"><?=$arPrice["PRINT_VALUE"]?></span>
					<?endif;?>
					</p>
				<?
						break;
					endif;
				endforeach;
				?>
				</div>
    <div class="catalog-detail-price catalog-quantity">
     <?if(!$arResult["CATALOG_QUANTITY"]):?>
        <label><noindex><?=GetMessage("CATALOG_NOT_AVAILABLE2");?></noindex></label>
     <?elseif($arResult["CATALOG_QUANTITY"]):?>
        <?if($USER->IsAuthorized()):?>
          <label>на складе:</label>
          <p><span class="catalog-detail-price">
	  <?if($arResult["CATALOG_QUANTITY"]==100):?>
		Заказ 7-14 дней</span></p>
	  <?else:?>
		<?=$arResult["CATALOG_QUANTITY"]-100?> шт</span></p>
	  <?endif?>
        <?else:?>
           <label>есть на складе</label>
        <?endif?>
     <?endif;?>
    </div>
				<?if($arResult["CAN_BUY"] && $arResult["CATALOG_QUANTITY"]):?>
				<div class="catalog-detail-buttons">
					<!--noindex-->
      <a href="<?/*=$arResult["ADD_URL"]*/?>/catalog/in_basket.php?id=<?=$arResult["ID"]?>" rel="nofollow" onclick="return addToCart(this, 'catalog_detail_image', 'detail', '<?=GetMessage("CATALOG_IN_BASKET")?>');" id="catalog_add2cart_link"><span><?echo GetMessage("CATALOG_ADD_TO_BASKET")?></span></a>
      <?if(intVal($arResult["PROPERTIES"]["PROP16"]["VALUE"])):?>
       <a href="<?/*=$arResult["ADD_URL"]*/?>/catalog/in_basket.php?id=<?=intVal($arResult["PROPERTIES"]["PROP16"]["VALUE"])?>" rel="nofollow" onclick="return addToCart(this, '', 'detail', 'Поверка в корзине');" id="catalog_add2cart_link2"><span>Добавить поверку</span></a>
      <?endif?>
     <!--/noindex-->
				</div>
				<?endif;?>

				<div class="catalog-item-links">
					<?if($arParams["USE_COMPARE"]):?>
					<a href="<?=$arResult["COMPARE_URL"]?>" class="catalog-item-compare" onclick="return addToCompare(this, '<?=GetMessage("CATALOG_IN_COMPARE")?>');" rel="nofollow" id="catalog_add2compare_link" rel="nofollow"><?echo GetMessage("CATALOG_COMPARE")?></a>
					<?endif;?>
				</div>
			</td>
		</tr>
   <tr>
   <script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script> <div class="yashare-auto-init" data-yashareType="button" data-yashareQuickServices="yaru,vkontakte,facebook,twitter,odnoklassniki,moimir"></div> 
    </tr>
	</table>
	
<?
if (is_array($arResult['DISPLAY_PROPERTIES']) && count($arResult['DISPLAY_PROPERTIES']) > 0):
?>
	<div class="catalog-detail-properties">
		<h4><?=GetMessage('CATALOG_PROPERTIES')?></h4>
		<div class="catalog-detail-line"></div>
		<?foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
			<div class="catalog-detail-property">
				<span><?=$arProperty["NAME"]?></span>
				<b>
<?
		if(is_array($arProperty["DISPLAY_VALUE"])):
			echo implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);
		elseif($pid=="MANUAL"):
?>
					<a href="<?=$arProperty["VALUE"]?>"><?=GetMessage("CATALOG_DOWNLOAD")?></a>
<?
		else:
			echo $arProperty["DISPLAY_VALUE"];
		endif;
?>
				</b>
			</div>
	<?endforeach;?>
	</div>
<?endif;?>

	<?if($arResult["DETAIL_TEXT"]):?>
	<div class="catalog-detail-full-desc">
		<h4><?=GetMessage('CATALOG_FULL_DESC')?></h4>
		<div class="catalog-detail-line"></div>
		<?=$arResult["DETAIL_TEXT"];?>
	</div>
	<?endif;?>
 
 <?
  $arOptions = Array();
  foreach($arResult["PROPERTIES"] as $propID=>$arProp)
  {
   if(strpos($propID, "OPT") === 0 && $arProp["VALUE"] && strtolower($arProp["VALUE"]) != "нет")
    $arOptions[$arProp["NAME"]] = "";
  }
  
  if(count($arOptions))
  {
   $rsOpt = CIBlockElement::GetList(Array(), Array("IBLOCK_ID"=>22, "NAME"=>array_keys($arOptions)), false, false, Array("NAME", "PREVIEW_PICTURE"));
   while($arOpt = $rsOpt->Fetch())
   {
    $arOpt["PREVIEW_PICTURE"] = CFile::GetFileArray($arOpt["PREVIEW_PICTURE"]);
    $arOptions[$arOpt["NAME"]] = $arOpt;
   }
  }
 ?>
 <?if(count($arOptions)):?>
	<div class="catalog-detail-full-desc">
		<h4>Опции</h4>
		<div class="catalog-detail-line"></div>
		<div class="catalog-options">
   <?foreach($arOptions as $arOpt):?>
    <a href="/upload/features.pdf" target="_blank"><img src="<?=$arOpt["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arOpt["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arOpt["PREVIEW_PICTURE"]["HEIGHT"]?>" title="<?=$arOpt["NAME"]?>" alt="<?=$arOpt["NAME"]?>"></a>
   <?endforeach?>
   <div style="clear: both"></div>
  </div>
	</div>
	<?endif;?>

	<? if ($canEditSections):
		$arEditButton = CIBlock::GetPanelButtons($arParams["IBLOCK_ID"], $arParams["ELEMENT_ID"], $arResult["ID"]);
		$arDeleteButton = CIBlock::GetPanelButtons($arParams["IBLOCK_ID"], $arParams["ELEMENT_ID"], $arResult["ID"], Array("RETURN_URL" => $arResult["SECTION"]["SECTION_PAGE_URL"]));
	?>
	<div class="catalog-admin-links">
		<a href="" onclick="<?=$arEditButton["edit"]["edit_element"]["ONCLICK"]?>; return false;" title="<?=$arEditButton["edit"]["edit_element"]["TITLE"]?>"><?=$arEditButton["edit"]["edit_element"]["TEXT"]?></a>
		<a href="" onclick="if(confirm('<?=CUtil::JSEscape(GetMessage("CATALOG_PRODUCT_DELETE_CONFIRM"))?>')) <?=$arDeleteButton["edit"]["delete_element"]["ONCLICK"]?>; return false;" title="<?=$arDeleteButton["edit"]["delete_element"]["TITLE"]?>"><?=$arDeleteButton["edit"]["delete_element"]["TEXT"]?></a>
	</div>
	<?endif?>
</div>

<?if ($canEditSections):?>
<script type="text/javascript">
	$(function() {
		$("#workarea div.catalog-detail").data("adminMode", true).bind({
			mouseover: function() { $(this).removeClass("catalog-detail-hover").addClass("catalog-detail-hover"); },
			mouseout: function() { $(this).removeClass("catalog-detail-hover"); }
		});
	});
					
</script>
<?endif?>