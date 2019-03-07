<?require($_SERVER["DOCUMENT_ROOT"]. "/bitrix/modules/main/include/prolog_before.php");?>
<?
function getBasketItemId($fUser, $productId, $mainProductId = false){

	CModule::IncludeModule('sale');

	//это не опция
	if(!$mainProductId){
		$arFindFilter = array(
			'FUSER_ID' 	=> $fUser, 
			'LID' 		=> SITE_ID, 
			'ORDER_ID' 	=> 'NULL', 
			'DELAY' 	=> 'N', 
			'CAN_BUY' 	=> 'Y',
		);
		
		$arFind = CSaleBasket::GetList($arFindSort, array_merge($arFindFilter, array('PRODUCT_ID' => $productId)), false, false, array('ID'))->Fetch();
		return $arFind["ID"];
	}

	//это опция
	$strSql = "select bbasket.ID 
	from b_sale_basket bbasket join b_sale_basket_props as bprops on 
	bbasket.ID = bprops.BASKET_ID 
		where FUSER_ID = ". $fUser ." AND PRODUCT_ID =" . $productId . "  AND bprops.CODE = 'MAIN_PRODUCT' AND bprops.VALUE = " . $mainProductId . "
	AND ORDER_ID IS NULL AND CAN_BUY = 'Y' AND DELAY = 'N' AND LID = '" . SITE_ID . "';";

	global $DB;
	$rsQuery = $DB -> Query($strSql);
	if($arDBFields = $rsQuery -> Fetch()){
		$basketItemId = $arDBFields["ID"];
		return $basketItemId;
	}

	return false;
}


// $arFindFilter = array(
// 	'FUSER_ID' 	=> CSaleBasket::GetBasketUserID(), 
// 	'LID' 		=> SITE_ID, 
// 	'ORDER_ID' 	=> 'NULL', 
// 	'DELAY' 	=> 'N', 
// 	'CAN_BUY' 	=> 'Y',
// 	'MAIN_PRODUCT' => 19200
// );
// $rsFind = CSaleBasket::GetList($arFindSort, array_merge($arFindFilter, array('PRODUCT_ID' => $arProductToDelete['ID'])), false, false);

// while($arFind = $rsFind -> Fetch()){
// 	// pre($arFind);
// }

// $fUser = CSaleBasket::GetBasketUserID();
// $productId = 18467;
// $mainProductId = 19199;

// $strSql = "select bbasket.ID 
// 	from b_sale_basket bbasket join b_sale_basket_props as bprops on 
// 	bbasket.ID = bprops.BASKET_ID 
// 		where FUSER_ID = ". $fUser ." AND PRODUCT_ID =" . $productId . "  AND bprops.CODE = 'MAIN_PRODUCT' AND bprops.VALUE = " . $mainProductId . "
// 	AND ORDER_ID IS NULL AND CAN_BUY = 'Y' AND DELAY = 'N' AND LID = '" . SITE_ID . "';";

// global $DB;
// $rsQuery = $DB -> Query($strSql);
// if($arDBFields = $rsQuery -> Fetch()){
// 	$basketId = $arDBFields["ID"];
// }
// echo 'completed';

$fUser = CSaleBasket::GetBasketUserID();
$productId = 18467;
// $productId = 19200;
$mainProductId = 19199;

$basketItemId = getBasketItemId($fUser, $productId, $mainProductId);
pre($basketItemId);
echo 'cc';