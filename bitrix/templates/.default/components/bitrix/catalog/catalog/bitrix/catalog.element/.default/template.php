	<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$this->setFrameMode(true);
?>
<?
if($USER->isAdmin())
{
    //echo "<pre>"; var_dump($arResult); echo "</pre>";
    //echo "<pre>"; var_dump($arParams); echo "</pre>";
}
?>
<?$this->SetViewTarget("showCatElemHeader");?>
    <h1>
        <?if($arResult["PROPERTIES"]["NAIMENOVANIE_DLYA_SAYTA_POLNOE"]["VALUE"] <> ""){?>
            <?=$arResult["PROPERTIES"]["NAIMENOVANIE_DLYA_SAYTA_POLNOE"]["VALUE"]?>
            <?if($arResult["PROPERTIES"]["CML2_ARTICLE"]["VALUE"] <> ""){?>
                <span class="b-card__article">(артикул <?=$arResult["PROPERTIES"]["CML2_ARTICLE"]["VALUE"]?>)</span>
            <?}?>
        <?} else {?>
            <?=$arResult["NAME"]?>
        <?}?>
    </h1>
<?$this->EndViewTarget();?>
<div class="b-card__aside"
    data-arcticle = "<?=$arResult['PROPERTIES']['CML2_ARTICLE']['VALUE']?>"
    data-product-id = "<?=$arResult['ID']?>"
    >
    <div class="b-card__aside-main">
		<div class="catalog-label">
            <?if($arResult["PROPERTIES"]["SERVICE_ICO"]["VALUE_XML_ID"] == 'Y' || $arResult["PROPERTIES"]["SHOW_IN_SERVICE"]["VALUE_XML_ID"] == 'Y'){?>
                <div class="catalog-label__item">
                    <a class="catalog-label__icon catalog-label__icon_service" href="<?=SERVICE_URL_KS?>" title="Сервисное обслуживание, требует пуско-наладки">&nbsp;</a>
                </div>
            <?}?>
            <?if($arResult["PROPERTIES"]["OUT_ICO"]["VALUE_XML_ID"] == 'Y'){?>
                <div class="catalog-label__item">
                    <span class="catalog-label__icon catalog-label__icon_out" title="Снят с производства">&nbsp;</span>
                </div>
            <?}?>
            <?if($arResult["PROPERTIES"]["AVAILABLE_ICO"]["VALUE_XML_ID"] == 'Y' || $arResult["CATALOG_QUANTITY"] > 0){?>
                <div class="catalog-label__item">
                    <span class="catalog-label__icon catalog-label__icon_available" title="Товар в наличии">&nbsp;</span>
                </div>
            <?}?>
            <?if($arResult["PROPERTIES"]["NEW"]["VALUE_FLAG"] == 'Y'){?>
                <div class="catalog-label__item">
                    <span class="catalog-label__icon catalog-label__icon_new" title="Новинка">&nbsp;</span>
                </div>
            <?}?>
            <?if($arResult["PROPERTIES"]["ACTION_ICO"]["VALUE_XML_ID"] == 'Y'){?>
                <div class="catalog-label__item">
                    <span class="catalog-label__icon catalog-label__icon_action" title="Специальное предложение. Акция!">&nbsp;</span>
                </div>
            <?}?>
        </div>
        <?if(is_array($arResult["DETAIL_PICTURE"]) || is_array($arResult["PROPERTIES"]["MORE_PHOTO"])){?>
            <div class="b-card-section b-card-section_type_photo">
                <div class="b-card-gallery">
                    <ul class="card-gallery__list">
                        <?
                        $index = 1;
                        $showDetailPicture = false;

                        if (!is_array($arResult["DETAIL_PICTURE"])){
                            $photoDetail = itc\Resizer::get(NO_PHOTO_ID, 'width', 1024, null, NO_PHOTO_EXTENSION);
                            $photoPrePreview = itc\Resizer::get(NO_PHOTO_ID, 'auto', 300, 300, NO_PHOTO_EXTENSION);
                            $photoPreview = itc\Resizer::get(NO_PHOTO_ID, 'crop', 76, 76, NO_PHOTO_EXTENSION);
						} else {
                            $extension = end(explode('.', $arResult["DETAIL_PICTURE"]["SRC"]));
                            $photoDetail = itc\Resizer::get($arResult["DETAIL_PICTURE"]["ID"], 'width', 1024, null, $extension);
                            //$photoPrePreview = CTPic::resizeImage($arResult["DETAIL_PICTURE"]["ID"], 'cropml', 299, 232);
                            $photoPrePreview = itc\Resizer::get($arResult["DETAIL_PICTURE"]["ID"], 'auto', 300, 300, $extension);
                            $photoPreview = itc\Resizer::get($arResult["DETAIL_PICTURE"]["ID"], 'height', null, 76, $extension);
                            $showDetailPicture = true;
                            $index++;
						}
                        ?>
                        <li class="card-gallery__item card-gallery__item_state_active">
							<?
							if($arResult["PROPERTIES"]["NAIMENOVANIE_DLYA_SAYTA_POLNOE"]["VALUE"] <> ""){
								$title = $arResult["PROPERTIES"]["NAIMENOVANIE_DLYA_SAYTA_POLNOE"]["VALUE"];
							} else {
								$title = $arResult["NAME"];
							}
							?>
                            <a rel="gallery1" href="<?=$photoDetail?>" title="<?=$title?>" class="card-gallery__link js__openPhotoInPopup">
                                <img src="<?=$photoPrePreview?>" border="0" alt="<?=$title?>" title="<?=$title?>" />
                            </a>
                        </li>
                        <?if(is_array($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"])){?>
                            <?foreach($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $key=>$id){?>
                                <?if($index == 1){
                                    $class = ' card-gallery__item_state_active';
                                } else {
                                    $class = '';
                                }?>
                                <li class="card-gallery__item<?=$class?>">
                                    <a rel="gallery1" href="<?=itc\Resizer::get($id, 'width', 1024, null, NO_PHOTO_EXTENSION);?>" class="card-gallery__link js__openPhotoInPopup" alt="<?=$arResult["PROPERTIES"]["MORE_PHOTO"]["DESCRIPTION"][$key]?>" title="<?=$arResult["PROPERTIES"]["MORE_PHOTO"]["DESCRIPTION"][$key]?>">
                                        <img src="<?=itc\Resizer::get($id, 'auto', 300, 300, NO_PHOTO_EXTENSION);?>" border="0" alt="<?=$arResult["PROPERTIES"]["MORE_PHOTO"]["DESCRIPTION"][$key]?>" title="<?=$arResult["PROPERTIES"]["MORE_PHOTO"]["DESCRIPTION"][$key]?>"/>
                                    </a>
                                </li>
                                <?$index++;?>
                            <?}?>
                        <?}?>
                    </ul>
					<?if(is_array($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"])){?>
						<div class="card-preview">
							<div class="card-preview-wrap">
								<ul class="card-preview__list">
                                    <?if($showDetailPicture){?>
									    <li class="card-preview__item card-preview__item_state_active">
									    	<a href="#photo1" class="card-preview__link js__changePhotoInGallery" title="<?=$arResult["DETAIL_PICTURE"]["DESCRIPTION"]?>">
                                            <span class="card-preview__link__wrap">
                                                <img src="<?=$photoPreview?>" border="0" alt="<?=$arResult["DETAIL_PICTURE"]["DESCRIPTION"]?>" title="<?=$arResult["DETAIL_PICTURE"]["DESCRIPTION"]?>" />
                                            </span>
									    	</a>
									    </li>
                                    <?}?>
                                    <?$index = 2;?>
									<?foreach($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $key=>$id){?>
										<li class="card-preview__item <?=$showDetailPicture === false ? 'card-gallery__item_state_active' : '';?>">
											<a href="#photo<?=$index?>" class="card-preview__link js__changePhotoInGallery" alt="<?=$arResult["PROPERTIES"]["MORE_PHOTO"]["DESCRIPTION"][$key]?>" title="<?=$arResult["PROPERTIES"]["MORE_PHOTO"]["DESCRIPTION"][$key]?>">
                                                <span class="card-preview__link__wrap">
											   		<img src="<?=itc\Resizer::get($id, 'auto', 76, 76, NO_PHOTO_EXTENSION);?>" border="0" alt="<?=$arResult["PROPERTIES"]["MORE_PHOTO"]["DESCRIPTION"][$key]?>" title="<?=$arResult["PROPERTIES"]["MORE_PHOTO"]["DESCRIPTION"][$key]?>"/>
                                                </span>
											</a>
										</li>
                                        <?$index++;?>
									<?}?>
								</ul>
							</div>
						</div>
					<?}?>
                </div>
            </div>
        <?}?>
        <div class="b-card-section b-card-section_type_bin">
			<?/*if($arResult["CATALOG_PRICE_2"] <> ""){?>
				<div class="b-card-price"><?=getPrintPrice($arResult["CATALOG_PRICE_2"])?> с НДС</div>
				<div class="b-card-rate">1 $ = <span class="b-card-rate__value"><?=$arResult["CURRENCYRATES"]["RATES"]?></span> (от <?=date("d.m.y")?>)</div>
            <?}*/?>
			<?itc\CUncachedArea::show('add_in_basket');?>
        </div>
    </div>
</div>
<div class="b-card__content">
    <div class="b-card-section">
        <?if($arResult["DETAIL_TEXT"] <> '' && ($arResult["DETAIL_TEXT"] != '<p>#TABLE_PROP#</p>' || $arResult["DETAIL_TEXT"] != '#TABLE_PROP#')){
            $arDetailText = explode("<p>#TABLE_PROP#</p>", $arResult["DETAIL_TEXT"]);

            if(sizeof($arDetailText) >= 1){
                $mod = 0;
                $index = 0;
                foreach($arDetailText as $key => $value){
                    $mod = $index % 2;
                    if($index == 0){
                        echo $arDetailText[$key];
                    } else {
                        echo '</div>';
                        itc\CUncachedArea::show('showTableProp');
                        echo '<div class="b-card-section">';
                        if($arDetailText[$key] <> ""){
                            echo $arDetailText[$key];
                        }
                    }
                    $index++;
                }
            } else {
                echo '</div>';
                itc\CUncachedArea::show('showTableProp');
            }
            ?>
        <?}?>
    </div>
	<?if(sizeof($arResult["PROPERTIES"]["KOMPLEKTUYUSHCHIE"]["OPTIONS"]) > 0){?>
		<div class="b-card-section b-card-section_size_12 b-card-section_type_options">
			<div class="b-card-section__header">
				Опции
			</div>
			<ul class="option__list">
				<?foreach ($arResult["PROPERTIES"]["KOMPLEKTUYUSHCHIE"]["OPTIONS"] as $arOption){?>
					<li class="option__item">
						<a class="option__link" href="<?=$arOption["DETAIL_PAGE_URL"]?>" target="_blank" title="<?=$arOption["PROPERTY_NAIMENOVANIE_DLYA_SAYTA_POLNOE_VALUE"]?> (в новом окне)">
							<span class="option__title"><?=$arOption["PROPERTY_NAIMENOVANIE_DLYA_SAYTA_POLNOE_VALUE"]?></span>
							<?if(is_array($arOption["DETAIL_PICTURE"])){?>
								<span class="option__img">
									<?
									$extension = end(explode('.', $arOption["DETAIL_PICTURE"]["SRC"]));
									$photoPreview = itc\Resizer::get($arOption["DETAIL_PICTURE"]["ID"], 'crop', 100, 100, $extension);
									?>
									<img src="<?=$photoPreview?>" alt="<?=$arOption["DETAIL_PICTURE"]["DESCRIPTION"]?>"/>
								</span>
							<?}?>
						</a>
					</li>
				<?}?>
			</ul>
		</div>
	<?}?>
</div>