<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)){?>
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