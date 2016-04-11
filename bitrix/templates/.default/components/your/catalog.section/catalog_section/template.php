<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
if($USER->isAdmin())
{
	//echo "<pre>"; var_dump($arResult); echo "</pre>";
}
?>

<?$this->SetViewTarget("showCatSectionDescriptionTop");?>
    <?if($arResult["DESCRIPTION"] <> ""){?>
        <p>
            <?=$arResult["DESCRIPTION"]?>
        </p>
    <?}?>
<?$this->EndViewTarget();?>
<?$this->SetViewTarget("showCatSectionName");?>
    <?if($arResult["NAME"] <> ""){?>
        <h1>
            <?=$arResult["NAME"]?>
        </h1>
    <?}?>
<?$this->EndViewTarget();?>
<?if($arResult["ITEMS"]){?>
	<table border="0" cellpadding="0" cellspacing="0" class="catalog-grid">
		<tbody>
			<tr class="catalog-grid__row_title">
				<td class="catalog-grid__cell_title">
					Наименование
				</td>
                <?
                if(SHOW_PRICE === "Y")
                {
                    ?>
                    <td class="catalog-grid__cell_price">
                        Цена
                    </td>
                    <?
                }
                ?>
				<td class="catalog-grid__cell_compare">
					<a class="compare-icon state_disabled js__goToCompareIcon" href="<?=COMPARE_URL_KS?>">
                        <img src="/files/kom-sib/Design/icon-compare.png" title="Сравнить">
                    </a>
				</td>
				<td class="catalog-grid__cell_cart">
                    <a class="compare-icon" href="<?=BASKET_URL_KS?>">
					    <img src="/files/kom-sib/Design/icon-cart.png" title="В корзину">
                    </a>
				</td>
			</tr>
			<?
			$strElementEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT");
			$strElementDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE");
			$arElementDeleteParams = array("CONFIRM" => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));
			?>
            <?foreach($arResult["ITEMS"] as $arItem) {
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
				$strMainID = $this->GetEditAreaId($arItem['ID']);
				
				$arItemIDs = array(
					'ID' => $strMainID,
					'PICT' => $strMainID.'_pict',
					'SECOND_PICT' => $strMainID.'_secondpict',
				
					'QUANTITY' => $strMainID.'_quantity',
					'QUANTITY_DOWN' => $strMainID.'_quant_down',
					'QUANTITY_UP' => $strMainID.'_quant_up',
					'QUANTITY_MEASURE' => $strMainID.'_quant_measure',
					'BUY_LINK' => $strMainID.'_buy_link',
					'SUBSCRIBE_LINK' => $strMainID.'_subscribe',
				
					'PRICE' => $strMainID.'_price',
					'DSC_PERC' => $strMainID.'_dsc_perc',
					'SECOND_DSC_PERC' => $strMainID.'_second_dsc_perc',
				
					'PROP_DIV' => $strMainID.'_sku_tree',
					'PROP' => $strMainID.'_prop_',
					'DISPLAY_PROP_DIV' => $strMainID.'_sku_prop',
					'BASKET_PROP_DIV' => $strMainID.'_basket_prop',
				);
				
				$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);
				
				$strTitle = (
					isset($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"]) && '' != isset($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"])
					? $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"]
					: $arItem['NAME']
				);
				?>
				<tr class="catalog-grid__row_item" id="<?=$strMainID;?>">
					<td class="catalog-grid__cell_title">
						<div class="catalog-item__info">
							<div class="catalog-item__img">
								<?
								if (!is_array($arItem["DETAIL_PICTURE"])) {
									$arPhoto = CFile::ResizeImageGet(
										NO_PHOTO_PL_94_94_ID,
										array(
											'width'=>94,
											'height'=>94
										),
										BX_RESIZE_IMAGE_PROPORTIONAL,
										true
									);
									$photo = $arPhoto['src'];

									//$photo = itc\Resizer::get(NO_PHOTO_PL_94_94_ID, 'auto', 94, 94, NO_PHOTO_EXTENSION);
								} 
                                else
                                {
	                                $arPhoto = CFile::ResizeImageGet(
		                                $arItem["DETAIL_PICTURE"]["ID"],
		                                array(
			                                'width'=>94,
			                                'height'=>94
		                                ),
		                                BX_RESIZE_IMAGE_PROPORTIONAL,
		                                true
	                                );
	                                $photo = $arPhoto['src'];

	                                if($USER->isAdmin())
	                                {
		                                //echo "<pre>"; var_dump($photo); echo "</pre>";
	                                }
	                                //$extension = end(explode('.', $arItem["DETAIL_PICTURE"]["SRC"]));
									//$photo = itc\Resizer::get($arItem["DETAIL_PICTURE"]["ID"], 'auto', 94, 94, $extension);
								}
                                if(!$arResult["SHOW_SIMPLE_TABLE"])
                                {
                                    ?>
                                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                                        <img alt="<?=$arItem["DETAIL_PICTURE"]["DESCRIPTION"]?>" border="0" src="<?=$photo?>" title="<?=$arItem["DETAIL_PICTURE"]["DESCRIPTION"]?>" >
                                    </a>
                                    <?
                                } 
                                else
                                {
                                    ?>
                                    <img alt="<?=$arItem["DETAIL_PICTURE"]["DESCRIPTION"]?>" border="0" src="<?=$photo?>" title="<?=$arItem["DETAIL_PICTURE"]["DESCRIPTION"]?>" >
                                    <?
                                }
                                ?>
                                <div class="catalog-label">
                                    <?if($arItem["PROPERTIES"]["SERVICE_ICO"]["VALUE_XML_ID"] == 'Y' || $arItem["PROPERTIES"]["SHOW_IN_SERVICE"]["VALUE_XML_ID"] == 'Y'){?>
                                        <div class="catalog-label__item">
                                            <a class="catalog-label__icon catalog-label__icon_service" href="/service/" title="Сервисное обслуживание, требует пуско-наладки">&nbsp;</a>
                                        </div>
                                    <?}?>
                                    <?if($arItem["PROPERTIES"]["OUT_ICO"]["VALUE_XML_ID"] == 'Y'){?>
                                        <div class="catalog-label__item">
                                            <span class="catalog-label__icon catalog-label__icon_out" title="Снят с производства">&nbsp;</span>
                                        </div>
                                    <?}?>
                                    <?if($arItem["PROPERTIES"]["AVAILABLE_ICO"]["VALUE_XML_ID"] == 'Y' || $arItem["CATALOG_QUANTITY"] > 0){?>
                                        <div class="catalog-label__item">
                                            <span class="catalog-label__icon catalog-label__icon_available" title="Товар в наличии">&nbsp;</span>
                                        </div>
                                    <?}?>
                                    <?if($arItem["PROPERTIES"]["NEW"]["VALUE_FLAG"] == 'Y'){?>
                                        <div class="catalog-label__item">
                                            <span class="catalog-label__icon catalog-label__icon_new" title="Новинка">&nbsp;</span>
                                        </div>
                                    <?}?>
                                    <?if($arItem["PROPERTIES"]["ACTION_ICO"]["VALUE_XML_ID"] == 'Y'){?>
                                        <div class="catalog-label__item">
                                            <span class="catalog-label__icon catalog-label__icon_action" title="Специальное предложение. Акция!">&nbsp;</span>
                                        </div>
                                    <?}?>
                                </div>
							</div>
							<div class="catalog-item__text">
								<div class="catalog-item__header">
                                    <?
                                    if(!$arResult["SHOW_SIMPLE_TABLE"])
                                    {
                                        ?>
                                        <a class="catalog-item__title" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                                            <?=$arItem["PROPERTIES"]["NAIMENOVANIE_DLYA_SAYTA_KRATKOE"]["VALUE"]?>
                                        </a>
                                        <?
                                    }
                                    else
                                    {
                                        ?>
                                        <span class="catalog-item__title">
                                            <?=$arItem["PROPERTIES"]["NAIMENOVANIE_DLYA_SAYTA_KRATKOE"]["VALUE"]?>
                                        </span>
                                        <?
                                    }
                                    if($arItem["PROPERTIES"]["CML2_ARTICLE"]["VALUE"] <> "")
                                    {
                                        ?>
                                        <span class="catalog-item__article">
                                            арт. <?=$arItem["PROPERTIES"]["CML2_ARTICLE"]["VALUE"]?>
                                        </span>
                                        <?
                                    }
                                    ?>
								</div>
								<?if($arItem["DETAIL_TEXT"] <> ""){?>
									<div class="catalog-item__descr">
										<?if($arItem["DETAIL_TEXT"] <> ""){?>
											<?$endStr = '<span class="catalog-grid-descr__hider">&nbsp;</span>'?>
											<?=getDetilTextWithOutTable(truncateStr($arItem["DETAIL_TEXT"], LENGTH_PREVIEW_TEXT, $endStr, 'html', 'fp'));?>
										<?}?>
									</div>
								<?}?>
							</div>
						</div>
					</td>
                    <?
                    if(SHOW_PRICE === "Y")
                    {
                        ?>
                        <td class="catalog-grid__cell_price">
                            <?=getPrintPrice($arItem["CATALOG_PRICE_2"]);?>
                        </td>
                        <?
                    }
                    ?>
					<td class="catalog-grid__cell_select">
						<?itc\CUncachedArea::show('compareLinkSec'.$arItem["ID"]);?>
					</td>
                    <td class="catalog-grid__cell_select" input="" type="checkbox">
						<input class="catalog-grid-control catalog-grid-control_bin add_to_basket_input" type="checkbox" data-product_id="<?=$arItem["ID"]?>">
					</td>
				</tr>
			<?}?>
		</tbody>
	</table>
	<?
	if(
		$arResult["SHOW_SYMBOLS"]["SERVICE"] == "Y"		||
		$arResult["SHOW_SYMBOLS"]["OUT"] == "Y" 		||
		$arResult["SHOW_SYMBOLS"]["AVAILABLE"] == "Y" 	||
		$arResult["SHOW_SYMBOLS"]["NEW"] == "Y" 		||
		$arResult["SHOW_SYMBOLS"]["ACTION"] == "Y"
	)
	{
		?>
		<div class="catalog-legend">
			<div class="catalog-legend__header">Условные обозначения:</div>
			<div class="catalog-legend__content">
				<div class="catalog-label">
					<?if($arResult["SHOW_SYMBOLS"]["SERVICE"] == "Y"){?>
						<div class="catalog-label__item">
							<a class="catalog-label__icon catalog-label__icon_service" href="/service/" title="Сервисное обслуживание, требует пуско-наладки">&nbsp;</a>
							<span class="catalog-label__text">
								<a href="/service/">Сервисное обслуживание, требует пуско-наладки</a>
							</span>
						</div>
					<?}?>
					<?if($arResult["SHOW_SYMBOLS"]["OUT"] == "Y"){?>
						<div class="catalog-label__item">
							<span class="catalog-label__icon catalog-label__icon_out" title="Снят с производства">&nbsp;</span>
							<span class="catalog-label__text">Снят с производства</span>
						</div>
					<?}?>
					<?if($arResult["SHOW_SYMBOLS"]["AVAILABLE"] == "Y"){?>
						<div class="catalog-label__item">
							<span class="catalog-label__icon catalog-label__icon_available" title="Товар в наличии">&nbsp;</span>
							<span class="catalog-label__text">Товар в наличии</span>
						</div>
					<?}?>
					<?if($arResult["SHOW_SYMBOLS"]["NEW"] == "Y"){?>
						<div class="catalog-label__item">
							<span class="catalog-label__icon catalog-label__icon_new" title="Новинка">&nbsp;</span>
							<span class="catalog-label__text">Новинка</span>
						</div>
					<?}?>
					<?if($arResult["SHOW_SYMBOLS"]["ACTION"] == "Y"){?>
						<div class="catalog-label__item">
							<span class="catalog-label__icon catalog-label__icon_action" title="Специальное предложение. Акция!">&nbsp;</span>
							<span class="catalog-label__text">Специальное предложение. Акция!</span>
						</div>
					<?}?>
				</div>
			</div>
		</div>
		<?
	}
	?>
<?}?>
<?$this->SetViewTarget("showCatSectionDescriptionBottom");?>
<?if($arResult["DESCRIPTION"] <> ""){?>
    <div class="catalog-category-details">
        <p>
            <?=$arResult["DESCRIPTION"]?>
        </p>
    </div>
<?}?>
<?$this->EndViewTarget();?>
<?$this->SetViewTarget("showCatSectionUFDescriptionBottom");?>
	<?if($arResult["UF_BOTTOM_DESCRIPTION"] <> ""){?>
		<p>
			<?=htmlspecialcharsBack($arResult["UF_BOTTOM_DESCRIPTION"])?>
		</p>
	<?}?>
<?$this->EndViewTarget();?>
<?$this->SetViewTarget("showCatSectionNavString");?>
<?
if ($arParams["DISPLAY_BOTTOM_PAGER"])
{
    ?><? echo $arResult["NAV_STRING"]; ?><?
}
?>
<?$this->EndViewTarget();?>