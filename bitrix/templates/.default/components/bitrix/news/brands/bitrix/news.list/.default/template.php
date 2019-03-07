<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if($arResult["ITEMS"]){?>
	<div>
		<ul class="manufacturer-menu__list">
			<?foreach($arResult["ITEMS"] as $arItem){?>
				<li class="manufacturer-menu__item">
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="manufacturer-menu__link" title="<?=$arItem["NAME"]?>"><?=$arItem["NAME"]?></a>
					<?/*<span class="manufacturer-menu__link manufacturer-menu__link_state_active" title="МЕТТЛЕР ТОЛЕДО">
						<?=$arItem["NAME"]?>
					</span>*/?>
				</li>
			<?}?>
		</ul>
	</div>
<?}?>