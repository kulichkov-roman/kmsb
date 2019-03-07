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

//echo "<pre>"; var_dump($arResult); echo "</pre>";

?>

<div class="b-projects">
    <h2>
        Последние реализованные проекты
    </h2>
    <?foreach($arResult["ITEMS"] as $arItem){?>
        <?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="project__item project__item_spec" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="project-img">
                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                    <?
                    if (!is_array($arItem["DETAIL_PICTURE"])) {
                        $photo = itc\Resizer::get(NO_PHOTO_ID, 'crop', 279, 172, NO_PHOTO_EXTENSION);
                    } else {
                        $extension = end(explode('.', $arItem["DETAIL_PICTURE"]["SRC"]));
                        $photo = itc\Resizer::get($arItem["DETAIL_PICTURE"]["ID"], 'crop', 279, 172, $extension);
                    }
                    ?>
                    <img alt="<?=$arItem["NAME"]?>" src="<?=$photo?>">
                </a>
            </div>
            <div class="project-text">
                <a class="project-title" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
                <div class="project-info">
                    <?if($arItem["PREVIEW_TEXT"]){?>
                        <p>
                            <?=$arItem["PREVIEW_TEXT"]?>
                        </p>
                    <?}?>
                </div>
            </div>
        </div>
    <?}?>
</div>