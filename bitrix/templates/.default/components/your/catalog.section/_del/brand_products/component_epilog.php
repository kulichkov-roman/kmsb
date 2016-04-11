<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
global $APPLICATION;
if (isset($templateData['TEMPLATE_THEME']))
{
	$APPLICATION->SetAdditionalCSS($templateData['TEMPLATE_THEME']);
}

/*----------------------------Ссылка сравнения-----------------------*/
if(sizeof($arResult["arOptionsSec"]) > 0)
{
	foreach($arResult["arOptionsSec"] as $arItem)
    {
		//echo "<pre>"; var_dump($_SESSION['CATALOG_COMPARE_LIST']); echo "</pre>";
        
        itc\CUncachedArea::startCapture();
					
		$arUrl = explode("/", $arItem["DETAIL_PAGE_URL"]);
        
		if(is_array($_SESSION['CATALOG_COMPARE_LIST'][CATALOG_IBLOCK_ID_KS]['ITEMS'][$arItem['ID']]))
        {
            ?>
            <input class="catalog-grid-control catalog-grid-control_compare js__addItemToCompare js__compare-id-<?=$arItem['ID']?> checked" checked="checked" onchange="changeCompare(<?="'".getUrlCompareSec($arUrl)."'"?>, <?=$arItem["ID"]?>)" type="checkbox">            
            <?
        } 
        else
        {
            ?>
            <input class="catalog-grid-control catalog-grid-control_compare js__addItemToCompare js__compare-id-<?=$arItem['ID']?>" onchange="changeCompare(<?="'".getUrlCompareSec($arUrl)."'"?>, <?=$arItem["ID"]?>)" type="checkbox">            
            <?
        }
		$compareLinkSec = itc\CUncachedArea::endCapture();
		itc\CUncachedArea::setContent("compareLinkSec".$arItem["ID"], $compareLinkSec);
	}
}

$rsBasket = CSaleBasket::GetList(
    array(),
    array(
        "FUSER_ID" => CSaleBasket::GetBasketUserID(true),
        "LID" => SITE_ID,
        "ORDER_ID" => "NULL",
    )
);
$arBasketItemIDs = array();
while($arBasketItem = $rsBasket -> Fetch()){
    $arBasketItemIDs[] = $arBasketItem["PRODUCT_ID"];
}
?>
<script>
    $(document).ready(function(){
        var arBasketItemIDs = <?=json_encode($arBasketItemIDs)?>;
        for(i = 0; i < arBasketItemIDs.length; i++) {
            inBasketProductId = arBasketItemIDs[i];
            objBasketInput = $('.add_to_basket_input[data-product_id="' + inBasketProductId +'"]');
            objBasketInput.attr("checked", "checked");
        }
    });
</script>