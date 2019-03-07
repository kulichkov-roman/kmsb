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

//echo "<pre>"; var_dump($arResult["ITEMS"]); echo "</pre>";

?>

<div class="b-manufacturers">
    <h2>Список производителей, по которым рекомендуется проводить пуско-наладочные работы и ежегодное техническое обслуживание</h2>
    <div class="manufacturer__list">
        <?foreach($arResult["ITEMS"] as $arItem){?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="manufacturer__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="manufacturer__item-wrap">
                    <div class="manufacturer-img">
                        <div class="manufacturer-img-wrap">
                            <a href="http://www.mtrus.com" target="_blank">
                                <?
                                if (!is_array($arItem["PREVIEW_PICTURE"])) {
                                    $photo = itc\Resizer::get(NO_PHOTO_ID, 'crop', 149, 64, NO_PHOTO_EXTENSION);
                                } else {
                                    $extension = end(explode('.', $arItem["PREVIEW_PICTURE"]["SRC"]));
                                    $photo = itc\Resizer::get($arItem["PREVIEW_PICTURE"]["ID"], 'crop', 149, 64, $extension);
                                }
                                ?>
                                <img alt="<?=$arItem["NAME"]?>" src="<?=$photo?>">
                            </a>
                        </div>
                    </div>
                    <div class="manufacturer-text">
                        <div class="manufacturer-header">
                            <a class="manufacturer-title" href="http://www.mtrus.com" target="_blank"><?=$arItem["NAME"]?></a>
                        </div>
                        <div class="manufacturer-info">
                            <?if($arItem["PREVIEW_TEXT"] <> ""){?>
                                <p>
                                    <?=$arItem["PREVIEW_TEXT"]?>
                                </p>
                            <?}?>
                        </div>
                        <a class="manufacturer-prod-link" href="javascript:;" target="_blank">Номенклатура</a>
                        <a class="manufacturer-price-link" href="price.xls">Прайс-лист</a>
                    </div>
                </div>
            </div>
        <?}?>
    </div>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]){?>
	<br /><?=$arResult["NAV_STRING"]?>
<?}?>