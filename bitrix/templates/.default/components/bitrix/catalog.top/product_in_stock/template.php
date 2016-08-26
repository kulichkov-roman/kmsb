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

//echo "<pre>"; var_dump($arResult['ITEMS']); echo "</pre>";
?> 
<?if(!empty($arResult['ITEMS'])){?>
    <div class="index-section-wrap">
        <div class="index-section__header">
			<a rel="nofollow" href="<?=CATALOG_BALANCES_URL_KS?>">Товары на складе</a>
            <span class="index-section__note">
                <?
                $data = getDataBalances();
                if($data !== false)
                {
                    echo $data;
                }
                ?>
            </span>
        </div>
		<div class="index-section__content">
            <div class="offer-gallery">
                <ul class="offer__list">
                    <?foreach($arResult['ITEMS'] as $key => $arItem){?>
						<?
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
						
                        if(is_array($arItem["PROPERTIES"]["LINK_ELEM"]["ELEMENT"])){
                            $link = $arItem["PROPERTIES"]["LINK_ELEM"]["ELEMENT"]["DETAIL_PAGE_URL"];
                        } else {
                            $link = 'javascript:void(0);';
                        }
						$classNoPrice = "";
						if($arItem["PROPERTIES"]["LINK_ELEM"]["ELEMENT"]["CATALOG_PRICE_2"] == ""){
							$classNoPrice = " offer__item_noprice";
						}
                        ?>
						<li id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="offer__item<?=$classNoPrice?>">
							<div class="offer__img">
								<a href="<?=$link?>" class="goods__link">
									<?
									if (!is_array($arItem["DETAIL_PICTURE"])) {
										$photo = itc\Resizer::get(NO_PHOTO_PL_195_144_1_ID, 'crop', 195, 144, NO_PHOTO_EXTENSION);
									} else {
										$extension = end(explode('.', $arItem["DETAIL_PICTURE"]["SRC"]));
										$photo = itc\Resizer::get($arItem["DETAIL_PICTURE"]["ID"], 'auto', 360, 144, $extension);
									}
									?>
									<img src="<?=$photo?>">
								</a>
							</div>
							<div class="offer__header">
								<div class="offer__header-wrap">
									<?
									if($arItem["PROPERTIES"]["LINK_ELEM"]["ELEMENT"]["PROPERTY_NAIMENOVANIE_DLYA_SAYTA_POLNOE_VALUE"] <> ""){
										$prodName = $arItem["PROPERTIES"]["LINK_ELEM"]["ELEMENT"]["PROPERTY_NAIMENOVANIE_DLYA_SAYTA_POLNOE_VALUE"];
									} else {
										$prodName = $arItem["NAME"];
									}
                                    if(is_array($arItem["PROPERTIES"]["LINK_ELEM"]["ELEMENT"])){
                                        ?>
                                        <a href="<?=$link?>" class="offer__link">
                                            <?=$prodName?>
                                        </a>
                                        <?
                                    } else {
                                        ?>
                                        <span class="offer__link">
                                            <?=$prodName?>
                                        </span>
                                        <?
                                    }
                                    ?>
									<?if($arItem["PROPERTIES"]["LINK_ELEM"]["ELEMENT"]["CATALOG_PRICE_2"] <> ""){?>
										<div class="offer__details">Цена: <?=getPrintPrice($arItem["PROPERTIES"]["LINK_ELEM"]["ELEMENT"]["CATALOG_PRICE_2"])?></div>
									<?}?>
								</div>
							</div>
						</li>
					<?}?>
                </ul>
            </div>
        </div>
    </div>
<?}?>
