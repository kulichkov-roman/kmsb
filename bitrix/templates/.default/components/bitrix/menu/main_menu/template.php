<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?//echo "<pre>"; var_dump($arResult); echo "</pre>";?>

<?if (!empty($arResult)){?>
    <ul class="main-menu__list">
        <?
        foreach($arResult as $arItem){
            if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
                continue;
            ?>
            <?if($arItem["SELECTED"]){?>
                <li class="main-menu__item main-menu__item_state_active">
                    <a class="main-menu__link main-menu__link_state_active" href="<?=$arItem["LINK"]?>" title="<?=$arItem["TEXT"]?>">
                        <?=$arItem["TEXT"]?>
                    </a>
                </li>
            <?} else {?>
                <li class="main-menu__item">
                    <a class="main-menu__link" href="<?=$arItem["LINK"]?>" title="<?=$arItem["TEXT"]?>">
                        <?=$arItem["TEXT"]?>
                    </a>
                </li>
            <?}?>
        <?}?>
    </ul>
<?}?>