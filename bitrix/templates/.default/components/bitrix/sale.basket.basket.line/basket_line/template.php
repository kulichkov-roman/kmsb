<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/*$cartStyle = 'bx_cart_block';
$cartId = $cartStyle.$component->getNextNumber();
$arParams['cartId'] = $cartId;

if ($arParams['SHOW_PRODUCTS'] == 'Y')
	$cartStyle .= ' bx_cart_sidebar';

if ($arParams['POSITION_FIXED'] == 'Y')
{
	$cartStyle .= " bx_cart_fixed {$arParams['POSITION_HORIZONTAL']} {$arParams['POSITION_VERTICAL']}";
	if ($arParams['SHOW_PRODUCTS'] == 'Y')
		$cartStyle .= ' close';
}*/
?>
<?
// pre($arResult)?>

В <a href="/personal/cart/" class="cart-status__link">корзине</a>
<span id="cart_products_count"><?=$arResult["NUM_PRODUCTS"]?> <?=$arResult["PRODUCT(S)"]?></span>
<?if(SHOW_PRICE === "Y"){?>
    на сумму <span id="cart_total_sum">
        <?=getPrintPrice(preg_replace('#[^0-9]#', '', $arResult["TOTAL_PRICE"]))?>
    </span>
<?}?>

<?/*?>
<script>
	var <?=$cartId?> = new BitrixSmallCart;
</script>

<div id="<?=$cartId?>" class="<?=$cartStyle?>">
	<?$frame = $this->createFrame('bx_cart_block', false)->begin()?>
		<?require(realpath(dirname(__FILE__)).'/ajax_template.php')?>
	<?$frame->beginStub()?>
		<div class="bx_small_cart">
			<span class="icon_cart"></span>
			<?=GetMessage('TSB1_CART')?>
		</div>
	<?$frame->end()?>
</div>

<script>
	<?=$cartId?>.siteId       = '<?=SITE_ID?>';
	<?=$cartId?>.cartId       = '<?=$cartId?>';
	<?=$cartId?>.ajaxPath     = '<?=$componentPath?>/ajax.php';
	<?=$cartId?>.templateName = '<?=$templateName?>';
	<?=$cartId?>.arParams     =  <?=CUtil::PhpToJSObject ($arParams)?>;
	<?=$cartId?>.closeMessage = '<?=GetMessage('TSB1_COLLAPSE')?>';
	<?=$cartId?>.openMessage  = '<?=GetMessage('TSB1_EXPAND')?>';
	<?=$cartId?>.activate();
</script>
<?*/?>