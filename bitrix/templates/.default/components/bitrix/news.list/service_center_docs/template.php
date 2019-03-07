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
<?if($arResult["ITEMS"]){?>
    <ul class="download__list">
        <?foreach($arResult["ITEMS"] as $arItem){
            $fileSize = $arItem["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"]["FILE_SIZE"];
            $fileSrc = $arItem["DISPLAY_PROPERTIES"]["FILE"]["FILE_VALUE"]["SRC"];
            $fileExt = getFileExtension($fileSrc);
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
            ?>
            <li id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="download__item">
                <div class="download__title">
                  <a class="download__link" href="<?=$fileSrc?>">Скачать</a> <?=$arItem["NAME"]?></div>
                <div class="download__info">
                  (<?=$fileExt?>, <?=CFile::FormatSize($fileSize,1)?>)</div>
            </li>
        <?}?>
    </ul>
<?}?>
