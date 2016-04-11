<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
global $APPLICATION;
?>
<?
//-->
// Вставляю кнопку 'Положить в корзину' 
itc\CUncachedArea::startCapture();
?>
	<a href="<?=BASKET_URL_KS?>" class="cart-bin__button<?=$arResult['inBacket'] ? " cart-bin__button_state_order" : ""?>" title="">
		<span class="button-text button-text_type_put" title="Положить в корзину">В корзину</span>
		<span class="button-text button-text_type_order" title="<?=$arResult['inBacket'] ? "Уже в корзине" : "Оформить заказ"?>"><?=$arResult['inBacket'] <> "" ? "Уже в корзине" : "Оформить заказ"?></span>
	</a>
<?
$add_in_basket = itc\CUncachedArea::endCapture();
itc\CUncachedArea::setContent('add_in_basket', $add_in_basket);
//<--
?>

<?
itc\CUncachedArea::startCapture();

if(sizeof($arResult["DISPLAY_PROPERTIES"]) > 1)
{
    ?>
    <div class="b-card-section">
        <div class="b-card-section__header b-card-param__header">
            Технические характеристики
        </div>
        <ul class="card-param__list">
            <?
            foreach($arResult ["DISPLAY_PROPERTIES"] as $arProp)
            {
                switch($arProp["CODE"])
                {
                    case "CML2_ARTICLE":
                        continue 2;
                    break;
                }
                if(!is_array($arProp["VALUE"]) && $arProp["VALUE"] <> "")
                {
                    ?>
                    <li class="card-param__item">
                        <span class="card-param__title">
                            <span class="card-param__title__text">
                                <?=$arProp["NAME"]?>
                            </span>
                        </span>
                        <span class="card-param__value">
                            <?=htmlspecialcharsBack($arProp["VALUE"])?>
                        </span>
                    </li>
                    <?
                }
            }
            ?>
        </ul>
    </div>
    <?
}
$showTableProp = itc\CUncachedArea::endCapture();
itc\CUncachedArea::setContent('showTableProp', $showTableProp);
?>