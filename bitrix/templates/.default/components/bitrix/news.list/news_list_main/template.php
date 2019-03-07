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

<?if(!empty($arResult['ITEMS'])){?>
	<div class="index-section__header">
		Новости
	</div>
	<div class="index-section__content">
		<ul class="news__list">
			<?foreach($arResult["ITEMS"] as $arItem){
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
				<li class="news__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]){?>
						<div class="news__date">
							<?=$arItem["DISPLAY_ACTIVE_FROM"]?>
						</div>
					<?}?>
					<a class="news__title" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
						<?=$arItem["NAME"];?>
					</a>
					<div class="news__announce">
						<?if($arItem["PREVIEW_TEXT"] <> ""){?>
							<p>
								<?=truncateStr($arItem["PREVIEW_TEXT"], 255, "","html");?>
							</p>
						<?}?>
					</div>
				</li>
			<?}?>
		</ul>
		<a href="/news/" class="all-link" title="Архив новостей">Все новости</a>
	</div>
<?}?>
