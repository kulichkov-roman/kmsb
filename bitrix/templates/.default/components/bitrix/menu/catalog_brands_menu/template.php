<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
//echo "<pre>"; var_dump($arResult); echo "</pre>";

//pre($arResult); die('1');
?>
<?if (!empty($arResult)){?>
	<div class="catalog-menu">
        <ul class="catalog-type__list">
            <li class="catalog-type__item">
                <a href="/catalog/" class="catalog-type__link" title="Каталог">По всем товарам</a>
            </li>
            <li class="catalog-type__item">
                <span class="catalog-type__link catalog-type__link_state_active" title="По производителям">По производителям</span>
            </li>
        </ul>
    </div>
    <div class="manufacturer-menu">
        <ul class="manufacturer-menu__list">
            <?foreach($arResult as $arItem){?>
                <?if(!$arItem["SELECTED"]){?>
                    <li class="manufacturer-menu__item">
                <?} else {?>
                    <li class="manufacturer-menu__item manufacturer-menu__item_state_active">
                <?}?>
                    <?if(!$arItem["SELECTED"]){?>
                        <a href="<?=$arItem["LINK"]?>" class="manufacturer-menu__link" title="<?=$arItem["TEXT"]?>"><?=$arItem["TEXT"]?></a>
                    <?} else {?>
                        <span class="manufacturer-menu__link manufacturer-menu__link_state_active" title="<?=$arItem["TEXT"]?>">
                            <?=$arItem["TEXT"]?>
                        </span>
                    <?}?>
                </li>
            <?}?>
        </ul>
    </div>    
<?}?>