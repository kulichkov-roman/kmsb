<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$this->setFrameMode(true);

if($arResult["FILE"] <> ""):
	if(filesize($arResult["FILE"]) > 0):?>
		<div class="description">
			<?include($arResult["FILE"]);?>
		</div>
	<?endif;
endif;?>