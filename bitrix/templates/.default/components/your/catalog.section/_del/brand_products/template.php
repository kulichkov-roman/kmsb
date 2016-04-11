<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?//echo "<pre>"; var_dump($arResult["ITEMS"]); echo "</pre>";?>

<?if($arResult["ITEMS"]){?>
	<?if($arResult["DESCRIPTION"] <> ""){?>
		<p>
			<?=$arResult["DESCRIPTION"]?>
		</p>
	<?}?>
	<table border="0" cellpadding="0" cellspacing="0" class="catalog-grid">
		<tbody>
			<tr class="catalog-grid__row_title">
				<td class="catalog-grid__cell_title">
					Наименование
				</td>
				<td class="catalog-grid__cell_price">
					Цена
				</td>
				<td class="catalog-grid__cell_compare">
					<a class="compare-icon state_disabled js__goToCompareIcon" href="/catalog/compare/">
                        <img src="/files/kom-sib/Design/icon-compare.png" title="Сравнить">
                    </a>
				</td>
				<td class="catalog-grid__cell_cart">
					<img src="/files/kom-sib/Design/icon-cart.png" title="В корзину">
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
								<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
									<?
									if (!is_array($arItem["DETAIL_PICTURE"])) {
										$photo = itc\Resizer::get(NO_PHOTO_ID, 'auto', 94, 94, NO_PHOTO_EXTENSION);
									} else {
										$extension = end(explode('.', $arItem["DETAIL_PICTURE"]["SRC"]));
										$photo = itc\Resizer::get($arItem["DETAIL_PICTURE"]["ID"], 'auto', 94, 94, $extension);
									}
									?>
									<img alt="<?=$arItem["DETAIL_PICTURE"]["DESCRIPTION"]?>" border="0" src="<?=$photo?>" title="<?=$arItem["DETAIL_PICTURE"]["DESCRIPTION"]?>" >
								</a>
                                <?if($arItem["PROPERTIES"]["SHOW_ICO"]["VALUE"] == "Y"){?>
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
                                        <?if($arItem["PROPERTIES"]["NEW_ICO"]["VALUE_XML_ID"] == 'Y'){?>
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
                                <?}?>
							</div>
							<div class="catalog-item__text">
								<div class="catalog-item__header">
									<a class="catalog-item__title" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["PROPERTIES"]["NAIMENOVANIE_DLYA_SAYTA_KRATKOE"]["VALUE"]?></a>
									<?if($arItem["PROPERTIES"]["CML2_ARTICLE"]["VALUE"] <> ""){?>
										<span class="catalog-item__article">арт. <?=$arItem["PROPERTIES"]["CML2_ARTICLE"]["VALUE"]?></span>
									<?}?>
								</div>
								<?if($arItem["DETAIL_TEXT"] <> ""){?>
									<div class="catalog-item__descr">
										<?if(mb_strlen($arItem["DETAIL_TEXT"]) > LENGTH_PREVIEW_TEXT){?>
											<?$endStr = '<span class="catalog-grid-descr__hider">&nbsp;</span>'?>
											<?=getDetilTextWithOutTable(truncateStr($arItem["DETAIL_TEXT"], LENGTH_PREVIEW_TEXT, $endStr, 'html'));?>
										<?}?>
									</div>
								<?}?>
							</div>
						</div>
					</td>
					<td class="catalog-grid__cell_price">
						<?=getPrintPrice($arItem["CATALOG_PRICE_2"]);?>
					</td>
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
	if($arResult["SHOW_SYMBOLS"]["SHOW_SYMBOLS_FLAG"] == "Y")
	{
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
	}?>
	<?if($arResult["DESCRIPTION"] <> ""){?>
		<div class="catalog-category-details">
			<p>
				<?=$arResult["DESCRIPTION"]?>
			</p>
		</div>
	<?}?>
<?}?>