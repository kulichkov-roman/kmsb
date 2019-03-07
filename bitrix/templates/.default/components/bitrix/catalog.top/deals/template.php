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

if($USER->isAdmin())
{
    //echo "<pre>"; var_dump($arResult); echo "</pre>";
}
?>

<div class="b-specials">
    <div class="specials__header">
        Наши специальные предложения
    </div>
    <div class="b-offers">
        <ul class="offer__list">
            <?foreach($arResult["ITEMS"] as $arItem){
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
                
                if($arItem["PROPERTIES"]["LINK"]["VALUE"] <> ""){
                    $link = $arItem["PROPERTIES"]["LINK"]["VALUE"];
                } else {
                    $link = 'javascript:void(0);';
                }
                ?>
                <li class="offer__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <div class="offer__img">
                        <a class="offer__link" href="<?=$link?>">
                            <?
                            if (!is_array($arItem["DETAIL_PICTURE"])) {
                                $photo = itc\Resizer::get(NO_PHOTO_PL_352_152_ID, 'crop', 352, 152, NO_PHOTO_EXTENSION);
                            } else {
                                $extension = end(explode('.', $arItem["DETAIL_PICTURE"]["SRC"]));
                                $photo = itc\Resizer::get($arItem["DETAIL_PICTURE"]["ID"], 'auto', 352, 152, $extension);
                            }
                            ?>
                            <img src="<?=$photo?>" alt="<?=$arItem["DETAIL_PICTURE"]["DESCRIPTION"]?>" title="<?=$arItem["DETAIL_PICTURE"]["DESCRIPTION"]?>">
                        </a>
                    </div>
                    <div class="offer__header">
                        <div class="offer__header-wrap">
                            <?
                            if($arItem["PROPERTIES"]["LINK"]["VALUE"] <> ""){
                                ?>
                                <a href="<?=$link?>" class="offer__link">
                                    <?=$arItem["NAME"]?>
                                </a>
                                <?
                            } else {
                                ?>
                                <span class="offer__link">
                                    <?=$arItem["NAME"]?>
                                </span>
                                <?
                            }
                            ?>
                        </div>
                        <?if($arItem["PROPERTIES"]["PRICE"]["VALUE"]){?>
                            <div class="offer__details">
                                Цена <?=$arItem["PROPERTIES"]["PRICE"]["VALUE"]?>
                            </div>
                        <?}?>
                        <?if($arItem["DETAIL_TEXT"] <> ""){?>
                            <a class="offer__link-more" href="javascript:;">
                                <span class="offer__link-more__text offer__link-more__text_open">Подробнее...</span>
                                <span class="offer__link-more__text offer__link-more__text_close">Свернуть</span>
                            </a>
                        <?}?>
                    </div>
                    <?if($arItem["DETAIL_TEXT"] <> ""){?>
                        <div class="offer__announce">
                            <?=$arItem["DETAIL_TEXT"]?>
                        </div>
                    <?}?>
                </li>
            <?}?>
        </ul>
    </div>
</div>