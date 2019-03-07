<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?foreach($arResult["SECTIONS"] as $arSection){?>
    <div class="manufacturer-section__header">
        <a  class="manufacturer-section__title"><?=$arSection["NAME"]?></a>
        <ul class="manufacturer-section__list">
            <?foreach($arSection["CHILD"] as $arChildSection){?>
                <li class="manufacturer-section__item">
                    <a href="/catalog/manufacturers/section/<?=$arResult["CODE"]?>/<?=$arSection["CODE"]?>/<?=$arResult["S_FILTER_QUERY"]?>"><?=$arChildSection["NAME"]?></a>
                </li>
            <?}?>
        </ul>
    </div>
<?}?>