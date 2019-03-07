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
	//echo "<pre>"; var_dump($arResult["PROPERTIES"]["SLIDER_PHOTO"]["VALUE_PREVIEW"]); echo "</pre>";
}
?>
<div class="b-project">
    <div class="project-photo">
		<div class="project-gallery">
			<ul class="project-photo__list">
				<?
				$ds = 0;
				$index = 0;
				foreach($arResult["PROPERTIES"]["SLIDER_PHOTO"]["VALUE_DETAIL"] as $key=>$src) {
					if($index == 0) {
						$class = "project-photo__item_state_active";

						if(is_array($arResult["DETAIL_PICTURE"])) {
							$title = $arResult["DETAIL_PICTURE"]["DESCRIPTION"];
						}
					} else {
						$class = "";

						$title = $arResult["PROPERTIES"]["PHOTO"]["DESCRIPTION"][$ds];
						$ds++;
					}
					?>
					<li class="project-photo__item <?=$class?>" >
						<a class="project-photo__link" rel="8244232" href="<?=$arResult["PROPERTIES"]["SLIDER_PHOTO"]["VALUE_DETAIL"][$key]?>" title="<?=$title?>">
							<img src="<?=$src?>" border="0" title="<?=$title?>" />
						</a>
					</li>
					<?
					$index++;
				}
				?>
			</ul>
		</div>
		<?if(sizeof($arResult["PROPERTIES"]["SLIDER_PHOTO"]["VALUE_PREVIEW"])>1){?>
			<div class="project-preview">
				<ul class="project-preview__list">
					<?
					$ds = 0;
					$index = 0;
					foreach($arResult["PROPERTIES"]["SLIDER_PHOTO"]["VALUE_PREVIEW"] as $key=>$src){
						if($index == 0) {
							$class = "project-preview__item_state_active";

							if(is_array($arResult["DETAIL_PICTURE"])) {
								$title = $arResult["DETAIL_PICTURE"]["DESCRIPTION"];
							}
						} else {
							$class = "";

							$title = $arResult["PROPERTIES"]["PHOTO"]["DESCRIPTION"][$ds];
							$ds++;
						}
						?>
						<li class="project-preview__item <?=$class?>">
							<a class="project-preview__link" rel="8244232" href="<?=$arResult["PROPERTIES"]["SLIDER_PHOTO"]["VALUE_DETAIL"][$key]?>" title="<?=$title?>">
								<img src="<?=$src?>" title="<?=$title?>" />
							</a>
						</li>
						<?
						$index++;
					}
					?>
				</ul>
			</div>
		<?}?>
    </div>
    <?if($arResult["DETAIL_TEXT"] <> ""){?>
        <div class="project-text">
            <?=$arResult["DETAIL_TEXT"];?>
        </div>
    <?}?>
</div>