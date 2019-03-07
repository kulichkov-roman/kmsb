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

//echo "<pre>"; var_dump(array_shift($arResult["ITEMS"])); echo "</pre>";
?>

<?if(!empty($arResult['ITEMS'])){?>
	<?$arItem = array_shift($arResult["ITEMS"]);?>
	<div class="index-section-wrap">
        <?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="index-section__header">
            <?=$arItem["NAME"]?>
        </div>
		<div id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="index-section__content">
			<a href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"] <> "" ? $arItem["PROPERTIES"]["LINK"]["VALUE"] : "javascript:void(0);";?>" title="<?=$arItem["NAME"]?>">
				<?
				if (!is_array($arItem["PREVIEW_PICTURE"])) {
					$photo = itc\Resizer::get(NO_PHOTO_ID, 'crop', 366, 205, NO_PHOTO_EXTENSION);
				} else {
					$extension = end(explode('.', $arItem["PREVIEW_PICTURE"]["SRC"]));
					$photo = itc\Resizer::get($arItem["PREVIEW_PICTURE"]["ID"], 'crop', 366, 205, $extension);
				}
				?>
				<img src="<?=$photo?>">
			</a>
		</div>
    </div>
<?}?>
