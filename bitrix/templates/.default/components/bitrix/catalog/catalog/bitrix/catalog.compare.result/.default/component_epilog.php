<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
//-->
// Раскоментировать если нужно сделать кнопку Купить.
// Не работает форма в форме.
?>
<?/*----------------------------Вывод кнопки---------------------------*/?>
<?/*if(sizeof($arResult["arCompare"]) > 0){?>
	<?foreach($arResult["arCompare"] as $key => $arItem){?>
		<?itc\CUncachedArea::startCapture();?>
		<?if($arItem['inBacket']){?>
			<a rel="nofollow" href="<?=BACKET_PAGE_URL?>" title="Перейти в корзину" class="btn btn-sm btn-info" >
				Уже в корзине
				<i class="icon-cart"></i>
			</a>
		<?} else {?>
			<button id="add-to-basket" type="submit" productid="<?=$arItem['ID']?>"  class="btn btn-sm btn-info add_basket">
				В корзину
				<i class="icon-cart"></i>
			</button>
		<?}?>
		<?
		$showNavCompare = itc\CUncachedArea::endCapture();
		itc\CUncachedArea::setContent("compareAddToBacket".$arItem["ID"], $showNavCompare);
		?>
	<?}?>
<?}*/?>
<?//<--?>

<?
$APPLICATION->SetPageProperty("description", $arResult["NAME"]);
$APPLICATION->SetPageProperty("title", "Сравнение товаров");
?>