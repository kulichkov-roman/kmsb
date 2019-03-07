<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

if(count($arResult["ITEMS"]) < 1)
	return;?>
	
<div class="advantages-wrapper">
	<div class="container">
		<div class="row advantages">					
			<?foreach($arResult["ITEMS"] as $arItem):?>				
				<div class="col-sm-6 col-md-3">
					<div class="adv-caption">
						<?if(!empty($arItem["DISPLAY_PROPERTIES"]["ICON"])):?>
							<div class="adv-icon">
								<i class="fa <?=$arItem['DISPLAY_PROPERTIES']['ICON']['VALUE']?>"></i>
							</div>
						<?endif;?>
						<div class="adv-text"><?=$arItem["NAME"]?></div>
					</div>
				</div>				
			<?endforeach;?>
		</div>
	</div>
</div>