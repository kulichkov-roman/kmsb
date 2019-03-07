<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if($USER->isAdmin())
{
	//pre($arResult);
}
?>

<?if (!empty($arResult)){?>
	<div class="catalog-menu">
		<ul class="catalog-type__list">
			<li class="catalog-type__item"><span class="catalog-type__link catalog-type__link_state_active" title="Каталог"><span class="link-text">По всем товарам</span></span></li>
			<li class="catalog-type__item"><a href="<?=CATALOG_MANUFACTURERS_URL_KS?>" class="catalog-type__link" title="По производителям"><span class="link-text">По производителям</span></a></li>
		</ul>
		<div class="catalog-menu-tools">
			<div class="menu-toggler">
				<ul class="menu-toggle__list">
					<li class="menu-toggle__item"><a href="javascript:;" class="menu-toggle__link" data-action="show-available" title="Показать только с остатками"><span class="link-text">Показать только с остатками</span></a></li>
					<li class="menu-toggle__item menu-toggle__item_state_active"><a href="javascript:;" class="menu-toggle__link" data-action="show-all" title="Показать все"><span class="link-text">Показать все</span></a></li>
				</ul>
			</div>
			<div class="menu-toggler">
				<ul class="menu-toggle__list">
					<li class="menu-toggle__item menu-toggle__item_state_active"><a href="javascript:;" class="menu-toggle__link" data-action="open-all" title="Развернуть все"><span class="link-text">Развернуть все</span></a></li>
					<li class="menu-toggle__item"><a href="javascript:;" class="menu-toggle__link" data-action="close-all" title="Свернуть все"><span class="link-text">Свернуть все</span></a></li>
				</ul>
			</div>
		</div>
		<ul class="catalog-menu__list catalog-menu__list_mode_balances">
			<?
			$previousLevel = 0;
			foreach ($arResult as $arItem) {
				if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel) {
					echo str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));
				}
				if ($arItem["IS_PARENT"]) {
					if($arItem["PARAMS"]["UF_POSITIVE_BALANCES"] === '1') {
						$classList = "js_positive-balances";
					}?>
					<li class="catalog-menu__item <?=$classList?> <?=$arItem["SELECTED"] === true ? "catalog-menu__item_state_active" : "";?>">
						<?if($arItem["PARAMS"]["UF_POSITIVE_BALANCES"] === "1") {?>
							<a class="catalog-menu__link js_positive-balances-link" href="<?=$arItem["LINK"]?>">
								<span class="link-text"><?=$arItem["TEXT"]?></span> <span class="catalog-menu__count"><?='('.$arItem["PARAMS"]["UF_COUNT_BALANCE"].')'?></span>
							</a>
						<?}?>
						<?
						$arParseUrl = array_unique(explode("/", $arItem["LINK"]));
						$arParseUrl = array_diff($arParseUrl, array(''));

						$arItem["LINK"] = "/".$arParseUrl[1]."/".$arParseUrl[3]."/";
						?>
						<a class="catalog-menu__link" href="<?=$arItem["LINK"]?>">
							<span class="link-text"><?=$arItem["TEXT"]?></span> <span class="catalog-menu__count"><?='('.$arItem["PARAMS"]["UF_COUNT_ELEM"].')'?></span>
						</a>
						<ul class="catalog-menu__list catalog-menu__list-level-<?=$arItem["DEPTH_LEVEL"]?>">
				<?} else {
					if($arItem["PARAMS"]["UF_POSITIVE_BALANCES"] === '1') {
						$classList = "js_positive-balances";
					}?>
					<li class="catalog-menu__item <?=$classList?> <?=$arItem["SELECTED"] === true ? "catalog-menu__item_state_active" : "";?>">
						<?if($arItem["PARAMS"]["UF_POSITIVE_BALANCES"] === "1") {?>
							<a class="catalog-menu__link js_positive-balances-link" href="<?=$arItem["LINK"]?>">
								<span class="link-text"><?=$arItem["TEXT"]?></span> <span class="catalog-menu__count"><?='('.$arItem["PARAMS"]["UF_COUNT_BALANCE"].')'?></span>
							</a>
						<?}?>
						<?
						$arParseUrl = array_unique(explode("/", $arItem["LINK"]));
						$arParseUrl = array_diff($arParseUrl, array(''));

						$arItem["LINK"] = "/".$arParseUrl[1]."/".$arParseUrl[3]."/";
						?>
						<a class="catalog-menu__link"  href="<?=$arItem["LINK"]?>">
							<?=$arItem["TEXT"]?>
							<span class="catalog-menu__count"><?='('.$arItem["PARAMS"]["UF_COUNT_ELEM"].')'?></span>
						</a>
					</li>
				<?}?>
				<?$previousLevel = $arItem["DEPTH_LEVEL"];?>
				<?
			}
			if ($previousLevel > 1) {
				echo str_repeat("</ul></li>", ($previousLevel-1));
			}?>
		</ul>
		<div class="catalog-summary">
			<?$count = getTotalCountElem(CATALOG_IBLOCK_ID_KS);?>
			Всего <span class="catalog-summary__value"><?=$count?></span> <?=plural($count, 'товар', 'товара', 'товаров');?>
		</div>
	</div>
<?}?>