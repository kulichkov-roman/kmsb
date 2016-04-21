<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule('iblock') || !CModule::IncludeModule('sale') || !CModule::IncludeModule('catalog')) {
	return;
}

global $USER, $APPLICATION;

if(!function_exists('getBasketItemId')){
	function getBasketItemId($fUser, $productId, $mainProductId = false){

		CModule::IncludeModule('sale');

		if(!$productId){
			return false;
		}

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
			where FUSER_ID = ". intval($fUser) ." AND PRODUCT_ID =" . intval($productId) . "  AND bprops.CODE = 'MAIN_PRODUCT' AND bprops.VALUE = " . intval($mainProductId) . "
		AND ORDER_ID IS NULL AND CAN_BUY = 'Y' AND DELAY = 'N' AND LID = '" . SITE_ID . "';";

		global $DB;
		$rsQuery = $DB -> Query($strSql);
		if($arDBFields = $rsQuery -> Fetch()){
			$basketItemId = $arDBFields["ID"];
			return $basketItemId;
		}

		return false;
	}
}

if(!function_exists('getMainProductIds')){
	function getMainProductIds(){
		CModule::IncludeModule('sale');

		$arBasketItemIds = array();
		$arFindFilter = array(
			'FUSER_ID' 	=> CSaleBasket::GetBasketUserID(), 
			'LID' 		=> SITE_ID, 
			'ORDER_ID' 	=> 'NULL', 
			'DELAY' 	=> 'N', 
			'CAN_BUY' 	=> 'Y',
		);

		$rsBasket = CSaleBasket::GetList(array(), $arFindFilter, false, false, array('ID'));
		while($arBasket = $rsBasket ->Fetch()){
			$arBasketItemIds[] = $arBasket["ID"];
		}

		$arMainProducts = array();
		if($arBasketItemIds){
			$rsBasket = CSaleBasket::GetPropsList(
				array(),
				array(
					"@BASKET_ID" => $arBasketItemIds,
					"CODE" => "MAIN_PRODUCT"
				)
			);
			while ($arBasketProp = $rsBasket->Fetch())
			{
				$basketItemId = $arBasketProp["BASKET_ID"];
			   	$arMainProducts[$basketItemId] = $arBasketProp["VALUE"];
			}
		}

		return $arMainProducts;
	}
}
if(!function_exists('getBasketOptionIds')){
	function getBasketOptionIds($productId){
		CModule::IncludeModule('sale');

		if(!$productId){
			return false;
		}
		
		$fUser = CSaleBasket::GetBasketUserID();

		$strSql = "select bbasket.ID 
			from b_sale_basket bbasket join b_sale_basket_props as bprops on 
			bbasket.ID = bprops.BASKET_ID 
				where FUSER_ID = ". intval($fUser) ." AND bprops.CODE = 'MAIN_PRODUCT' AND bprops.VALUE = " . intval($productId) . "
			AND ORDER_ID IS NULL AND CAN_BUY = 'Y' AND DELAY = 'N' AND LID = '" . SITE_ID . "';";

		global $DB;
		$rsQuery = $DB -> Query($strSql);

		$arOptionIds = array();
		while($arDBFields = $rsQuery -> Fetch()){
			$basketItemId = $arDBFields["ID"];
			$arOptionIds[] = $basketItemId;
		}

		return $arOptionIds;
	}
}


$arResult = array();

$arParams['USER_TYPE_ID'] = 2;
$arParams['SEND_ME_PROP_ID'] = 19;
$arParams['USER_ID'] = intval($USER->GetID());

if(empty($arParams['USER_ID'])) {
	$arResult['POST']['FIELDS']['REGISTER'] = 'Y';
}

$arResult['ERRORS'] = array();

if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['action']) && $_POST['ajaxBasket'] === 'Y') {
	// basket actions
	$APPLICATION->RestartBuffer();
	$result = 'error';
	
	$arFindSort = array(
		'PRODUCT_ID' => 'ASC'
	);
	
	$arFindFilter = array(
		'FUSER_ID' 	=> CSaleBasket::GetBasketUserID(), 
		'LID' 		=> SITE_ID, 
		'ORDER_ID' 	=> 'NULL', 
		'DELAY' 	=> 'N', 
		'CAN_BUY' 	=> 'Y'
	);

	$fUser = CSaleBasket::GetBasketUserID();
	$productId = $_POST['productId'];
	$mainProductId = $_POST['mainProductId'];

	switch($_POST['action']) {
		case 'update':
			$basketItemId = getBasketItemId($fUser, $productId, $mainProductId);

			if($basketItemId) {
				if(CSaleBasket::Update($basketItemId, array('QUANTITY' => $_POST['quantity']))) {
					$result = 'success';
				}
			} else {
				$productId = $_POST['productId'];
				$quantity = $_POST['quantity'];

				$arSort = array();
                $arSelect = array(
                    "ID",
                    "NAME",
                    "PROPERTY_NAIMENOVANIE_DLYA_SAYTA_POLNOE"
                );
                $arFilter = array(
                    "IBLOCK_ID" => CATALOG_IBLOCK_ID_KS,
                    "ID" => $productId
                );

                $rsElements = CIBlockElement::GetList(
                    $arSort,
                    $arFilter,
                    false,
                    false,
                    $arSelect
                );

                $arElement = $rsElements->GetNext();

                $arFields = array(
                    'PRODUCT_ID' => $productId,
                    'PRODUCT_PRICE_ID' => 0,
                    'PRICE' => 0.00,
                    'CURRENCY' => 'RUB',
                    'WEIGHT' => 0,
                    'QUANTITY' => !empty($quantity) ? $quantity : 1,
                    'LID' => SITE_ID,
                    'DELAY' => 'N',
                    'CAN_BUY' => 'Y',
                    'NAME' => $arElement["PROPERTY_NAIMENOVANIE_DLYA_SAYTA_POLNOE_VALUE"],
                    'MODULE' => 'catalog',
                );

                $arProps = array();

                $arProps[] = array(
                    "NAME" => 'Арктикул',
                    "CODE" => 'CML2_ARTICLE',
                    "VALUE" => htmlspecialcharsEx($_REQUEST['product_props']['articul']),
                    "SORT" => 100
                );

                $arProps[] = array(
                	"NAME" => "Основной товар",
                	"CODE" => "MAIN_PRODUCT",
                	"VALUE" => intval($_REQUEST["mainProductId"]),
                	"SORT" => 100
                );

                $arFields["PROPS"] = $arProps;

                $sb = new CSaleBasket;

                if($sb->Add($arFields))
                {
                    $result = 'success';
                }
				// if(Add2BasketByProductID($_POST['productId'], $_POST['quantity'])) {
				// 	$result = 'success';
				// }
			}
			break;
			
		case 'delete':
		
			if(!empty($_POST['productId'])) {
				$basketItemId = getBasketItemId($fUser, $productId, $mainProductId);

				if($basketItemId) {
					CSaleBasket::Delete($basketItemId);
					$result = 'success';
				}
				
				$arBasketOptionIds = getBasketOptionIds($productId);

				foreach($arBasketOptionIds as $basketOptionId){
					CSaleBasket::Delete($basketOptionId);
				}
			}
			break;
			
		case 'clear':
		
			if(CSaleBasket::DeleteAll(CSaleBasket::GetBasketUserID())) {
				$result = 'success';
			}
			break;
			
		default:
	}
	print json_encode($result);
	die();
}
// profile
$rsUserProfiles = CSaleOrderUserProps::GetList(
	array('DATE_UPDATE' => 'DESC'),
	array(
		'PERSON_TYPE_ID' 	=> $arParams['USER_TYPE_ID'],
		'USER_ID' 			=> $arParams['USER_ID']
	)
);
if($arUserProfiles = $rsUserProfiles->GetNext()) {
	$arParams['PROFILE_ID'] = IntVal($arUserProfiles['ID']);
}
// props
$arFilter = array(
	'PERSON_TYPE_ID' 	=> $arParams['USER_TYPE_ID'], 
	'ACTIVE' 			=> 'Y', 
	'UTIL' 				=> 'N', 
	'RELATED' 			=> false
);

$rsProperties = CSaleOrderProps::GetList(
	array(
		'GROUP_SORT' 		=> 'ASC',
		'PROPS_GROUP_ID' 	=> 'ASC',
		'USER_PROPS' 		=> 'ASC',
		'SORT' 				=> 'ASC',
		'NAME' 				=> 'ASC'
	),
	$arFilter,
	false,
	false,
	array(
		'ID', 'NAME', 'TYPE', 'REQUIED', 'DEFAULT_VALUE', 'IS_LOCATION', 'PROPS_GROUP_ID', 'SIZE1', 'SIZE2', 'DESCRIPTION',
		'IS_EMAIL', 'IS_PROFILE_NAME', 'IS_PAYER', 'IS_LOCATION4TAX', 'DELIVERY_ID', 'PAYSYSTEM_ID', 'MULTIPLE',
		'CODE', 'GROUP_NAME', 'GROUP_SORT', 'SORT', 'USER_PROPS', 'IS_ZIP', 'INPUT_FIELD_LOCATION'
	)
);

$arUserPropsIds = array();
while ($arProperties = $rsProperties->GetNext()) {
	//$arProperties['VALUE'] = $arResult['POST']['PROPS'][$arProperties['ID']];
	$arResult['PROPS'][$arProperties['ID']] = $arProperties;
	if($arProperties['USER_PROPS'] == 'Y') {
		$arUserPropsIds[] = $arProperties['ID'];
	}

}

// basket items
$arSort =  array(
	'PRODUCT_ID' => 'ASC',
);

$arFilter = array(
	'FUSER_ID' 	=> CSaleBasket::GetBasketUserID(),
	'LID' 		=> SITE_ID,
	'ORDER_ID' 	=> 'NULL',
	'DELAY' 	=> 'N',
	'CAN_BUY' 	=> 'Y'
);

$arSelect = array(
	'ID', 
	'NAME',
	'DETAIL_PAGE_URL',
    'PRODUCT_ID', 
	'QUANTITY', 
	'PRICE',
	'CURRENCY',
);

$productIds = array();
$xmlIds = array();

$arMainProducts = getMainProductIds();

$rsBasketItems = CSaleBasket::GetList($arSort, $arFilter, false, false, $arSelect);
while($arItem = $rsBasketItems->Fetch()) {
	$arItem['SUM'] = $arItem['QUANTITY'] * $arItem['PRICE'];

	$mainProductId = $arMainProducts[$arItem["ID"]];

	//это опция
	if($mainProductId){
		$arOptionQuantites[$arItem['PRODUCT_ID'] . '_' . $mainProductId] = $arItem["QUANTITY"];		
	}

	$arResult['ITEMS'][$arItem['PRODUCT_ID']] = $arItem;		
	
	$arResult['ORDER_INFO']['SUM'] += $arItem['SUM'];
	$productIds[] = $arItem['PRODUCT_ID'];
}

$arProductIDs = array();
$arDetailPicture = array();
if(!empty($productIds)) {
	$rsProducts = CIBlockElement::GetList(array('ID' => 'ASC'), array('IBLOCK_ID' => CATALOG_IBLOCK_ID_KS, 'ID' => $productIds), false, false, array('ID', 'XML_ID', 'DETAIL_PAGE_URL', 'DETAIL_PICTURE', 'PROPERTY_KOMPLEKTUYUSHCHIE', 'PROPERTY_NAIMENOVANIE_DLYA_SAYTA_POLNOE', 'PROPERTY_NAIMENOVANIE_DLYA_SAYTA_KRATKOE', 'PROPERTY_CML2_ARTICLE'));
	while($arProduct = $rsProducts->GetNext()) {
		$arResult['ITEMS'][$arProduct['ID']]['XML_ID'] = $arProduct['XML_ID'];
		$arResult['ITEMS'][$arProduct['ID']]['PRODUCT_ID'] = $arProduct['ID'];
        $arResult['ITEMS'][$arProduct['ID']]['DETAIL_PAGE_URL'] = $arProduct['DETAIL_PAGE_URL'];

        if($arProduct['DETAIL_PICTURE'] <> ""){
            $arResult['ITEMS'][$arProduct['ID']]['DETAIL_PICTURE'] = $arProduct['DETAIL_PICTURE'];
        } else {
            $arResult['ITEMS'][$arProduct['ID']]['DETAIL_PICTURE'] = "";
        }

		$arResult['ITEMS'][$arProduct['ID']]['OPTIONS'] = $arProduct['PROPERTY_KOMPLEKTUYUSHCHIE_VALUE'];

		$coutOptions = sizeof($arResult['ITEMS'][$arProduct['ID']]['OPTIONS']);
		if($coutOptions == 0)
		{
			$arResult['ITEMS'][$arProduct['ID']]["OPTIONS_STATUS"] = 'У данного товара нет опций';
		}

		$arResult['ITEMS'][$arProduct['ID']]['NAIMENOVANIE_DLYA_SAYTA_POLNOE'] = $arProduct['PROPERTY_NAIMENOVANIE_DLYA_SAYTA_POLNOE_VALUE'];
		$arResult['ITEMS'][$arProduct['ID']]['NAIMENOVANIE_DLYA_SAYTA_KRATKOE'] = $arProduct['PROPERTY_NAIMENOVANIE_DLYA_SAYTA_KRATKOE_VALUE'];

		$arResult['ITEMS'][$arProduct['ID']]['PROPERTY_CML2_ARTICLE'] = $arProduct['PROPERTY_CML2_ARTICLE_VALUE'];
		//$arResult['PRODUCTS'][$arProduct['ID']] = $arProduct;
		$arResult['XML'][$arProduct['XML_ID']] = $arProduct['ID'];
		$xmlIds = array_merge($xmlIds, $arProduct['PROPERTY_KOMPLEKTUYUSHCHIE_VALUE']);

        $arDetailPicture[] = $arProduct['DETAIL_PICTURE'];
        $arProductIDs[] = $arProduct['ID'];
	}

    if(!empty($arDetailPicture))
    {
        $strIds = implode(",", $arDetailPicture);

        $fl = new CFile;

        $arOrder = array();
        $arFilter = array(
            "MODULE_ID" => "iblock",
            "@ID" => $strIds
        );

        $arDetailPicture = array();

        $rsFile = $fl->GetList($arOrder, $arFilter);
        while($arItem = $rsFile->GetNext())
        {
            $arDetailPicture[$arItem["ID"]] = $arItem;

            $extension = GetFileExtension("/upload/".$arItem["SUBDIR"]."/".$arItem["FILE_NAME"]);
            $urlDetailPicture = itc\Resizer::get($arItem["ID"], 'crop', 100, 100, $extension);

            $arDetailPicture[$arItem["ID"]]['SRC'] = $urlDetailPicture;
        }

        foreach($arProductIDs as &$id)
        {
            $arResult['ITEMS'][$id]['DETAIL_PICTURE'] = $arDetailPicture[$arResult['ITEMS'][$id]['DETAIL_PICTURE']]['SRC'];
        }
        unset($id, $arDetailPicture, $arProductIDs);
    }
}

$productIdsForPrice = array();
if(!empty($xmlIds)) {
	$rsProducts = CIBlockElement::GetList(array('ID' => 'ASC'), array('IBLOCK_ID' => CATALOG_IBLOCK_ID_KS, 'XML_ID' => $xmlIds), false, false, array('ID', 'NAME', 'XML_ID', 'DETAIL_PAGE_URL', 'DETAIL_PICTURE', 'PROPERTY_NAIMENOVANIE_DLYA_SAYTA_POLNOE', 'PROPERTY_NAIMENOVANIE_DLYA_SAYTA_KRATKOE', 'PROPERTY_CML2_ARTICLE'));
	while($arProduct = $rsProducts->GetNext()) {
		//$arResult['PRODUCTS'][$arProduct['ID']] = $arProduct;
		$arResult['ITEMS'][$arProduct['ID']]['NAME'] = $arProduct['NAME'];
		$arResult['ITEMS'][$arProduct['ID']]['XML_ID'] = $arProduct['XML_ID'];
		$arResult['ITEMS'][$arProduct['ID']]['DETAIL_PAGE_URL'] = $arProduct['DETAIL_PAGE_URL'];

        if($arProduct['DETAIL_PICTURE'] <> ""){
            $arResult['ITEMS'][$arProduct['ID']]['DETAIL_PICTURE'] = $arProduct['DETAIL_PICTURE'];
        } else {
            $arResult['ITEMS'][$arProduct['ID']]['DETAIL_PICTURE'] = "";
        }

		$arResult['ITEMS'][$arProduct['ID']]['PRODUCT_ID'] = $arProduct['ID'];
		$arResult['ITEMS'][$arProduct['ID']]['NAIMENOVANIE_DLYA_SAYTA_POLNOE'] = $arProduct['PROPERTY_NAIMENOVANIE_DLYA_SAYTA_POLNOE_VALUE'];
		$arResult['ITEMS'][$arProduct['ID']]['NAIMENOVANIE_DLYA_SAYTA_KRATKOE'] = $arProduct['PROPERTY_NAIMENOVANIE_DLYA_SAYTA_KRATKOE_VALUE'];

		$arResult['ITEMS'][$arProduct['ID']]['PROPERTY_CML2_ARTICLE'] = $arProduct['PROPERTY_CML2_ARTICLE_VALUE'];
		$arResult['XML'][$arProduct['XML_ID']] = $arProduct['ID'];
		$productIdsForPrice[] = $arProduct['ID'];

        $arDetailPicture[] = $arProduct['DETAIL_PICTURE'];
        $arProductIDs[] = $arProduct['ID'];
	}

    if(!empty($arDetailPicture))
    {
        $strIds = implode(",", $arDetailPicture);

        $fl = new CFile;

        $arOrder = array();
        $arFilter = array(
            "MODULE_ID" => "iblock",
            "@ID" => $strIds
        );

        $arDetailPicture = array();

        $rsFile = $fl->GetList($arOrder, $arFilter);
        while($arItem = $rsFile->GetNext())
        {
            $arDetailPicture[$arItem["ID"]] = $arItem;

            $extension = GetFileExtension("/upload/".$arItem["SUBDIR"]."/".$arItem["FILE_NAME"]);
            $urlDetailPicture = itc\Resizer::get($arItem["ID"], 'crop', 100, 100, $extension);

            $arDetailPicture[$arItem["ID"]]["SRC"] = $urlDetailPicture;
        }

        foreach($arProductIDs as &$id)
        {
            $arResult['ITEMS'][$id]['DETAIL_PICTURE'] = $arDetailPicture[$arResult['ITEMS'][$id]['DETAIL_PICTURE']]['SRC'];
        }
        unset($id, $arDetailPicture, $arProductIDs);
    }
}

if(!empty($productIdsForPrice)) {
	$rsPrices = CPrice::GetList(
		array('PRODUCT_ID' => 'ASC'),
		array(
			'PRODUCT_ID' 		=> $productIdsForPrice,
			'CATALOG_GROUP_ID' 	=> 2
		)
	);
	while($arPrice = $rsPrices->Fetch()) {
		if(empty($arResult['ITEMS'][$arPrice['PRODUCT_ID']]['QUANTITY'])) {
			$arResult['ITEMS'][$arPrice['PRODUCT_ID']]['PRICE'] = $arPrice['PRICE'];
			$arResult['ITEMS'][$arPrice['PRODUCT_ID']]['CURRENCY'] = $arPrice['CURRENCY'];
			$arResult['ITEMS'][$arPrice['PRODUCT_ID']]['QUANTITY'] = 0;
			$arResult['ITEMS'][$arPrice['PRODUCT_ID']]['SUM'] = 0;
		}
	}
}

$arOptionXmlIds = array();
foreach($arResult['ITEMS'] as $id => $item) {
	foreach($item['OPTIONS'] as $optionKey => $optionXmlId) {
		$arResult['ITEMS'][$id]['OPTIONS'][$optionKey] = $arResult['ITEMS'][$arResult['XML'][$optionXmlId]];
		$arOptionXmlIds[] = $optionXmlId;
		// unset($arResult['ITEMS'][$arResult['XML'][$optionXmlId]]);
	}
}

foreach($arOptionXmlIds as $optionXmlId){
	unset($arResult['ITEMS'][$arResult['XML'][$optionXmlId]]);
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirmOrder']) && !empty($arResult['ITEMS'])) {
	// add order
	foreach($_POST['PROPS'] as $id => $value) {
		$arResult['POST']['PROPS'][$id] = htmlspecialchars($value);
		$arResult['PROPS'][$id]['VALUE'] = $arResult['POST']['PROPS'][$id];
	}
	foreach($_POST['FIELDS'] as $id => $value) {
		$arResult['POST']['FIELDS'][$id] = htmlspecialchars($value);
	}
	
	if(!isset($_POST['FIELDS']['REGISTER']) || !empty($arParams['USER_ID'])) {
		unset($arResult['POST']['FIELDS']['REGISTER']);
	}

	$arFilePropIds = array();
	foreach($_FILES["PROPS"] as $fieldName => $arValues){
		foreach($arValues as $propKey => $value){
			$arFilePropIds[] = $propKey;
			$arResult["POST"]["PROPS"][$propKey][ $fieldName ] = $value;
			$arResult['PROPS'][$propKey]['VALUE'][$fieldName] = $value;
		}
	}
	$arFilePropIds = array_unique($arFilePropIds);

	foreach($arFilePropIds as $filePropId){
		$arResult['PROPS'][$filePropId]['VALUE'] = CFile::SaveFile($arResult['PROPS'][$filePropId]['VALUE']);
	}

	if($arResult['POST']['FIELDS']['REGISTER'] == 'Y' && empty($arParams['USER_ID'])) {

		if(strlen($arResult['POST']['FIELDS']['PASSWORD']) < 6 || strlen($arResult['POST']['FIELDS']['CONFIRM_PASSWORD']) < 6) {
			$arResult['ERRORS'][] = 'Длина пароля должна быть не менее 6-ти символов';
		}
		
		if($arResult['POST']['FIELDS']['PASSWORD'] != $arResult['POST']['FIELDS']['CONFIRM_PASSWORD']) {
			$arResult['ERRORS'][] = 'Пароли не совпадают';
		}
		
		if(!check_email($arResult['POST']['FIELDS']['EMAIL'])) {
			$arResult['ERRORS'][] = 'Некорректный email';
		}
		
		if(CUser::GetList(($by = 'ID'), ($order = 'DESC'), array('LOGIN' => $arResult['POST']['FIELDS']['EMAIL']), array('FIELDS' => 'ID'))->Fetch()) {
			$arResult['ERRORS'][] = 'Пользователь с таким email уже существует';
		}

		$user = new CUser;
		$arUserFields = array(
			'EMAIL' 			=> $arResult['POST']['FIELDS']['EMAIL'],
			'LOGIN' 			=> $arResult['POST']['FIELDS']['EMAIL'],
			'NAME'				=> $arResult['POST']['PROPS'][27],
			'LID' 				=> SITE_ID,
			'ACTIVE'            => 'Y',
			'GROUP_ID'          => array(3),
			'PASSWORD'          => $arResult['POST']['FIELDS']['PASSWORD'],
			'CONFIRM_PASSWORD'  => $arResult['POST']['FIELDS']['CONFIRM_PASSWORD'],
			'WORK_COMPANY'		=>$arResult['POST']['PROPS'][20], 
			'WORK_NOTES'		=>$arResult['POST']['PROPS'][30],
			'WORK_PHONE'		=>$arResult['POST']['PROPS'][24],
			'PERSONAL_PHONE'	=>$arResult['POST']['PROPS'][25],
			'WORK_FAX'			=>$arResult['POST']['PROPS'][26],
			'UF_INN'			=>$arResult['POST']['PROPS'][22],
			'UF_KPP'			=>$arResult['POST']['PROPS'][23],
			'WORK_STREET'		=>$arResult['POST']['PROPS'][21],
			'UF_FILES'			=> array(
				0 => $arResult['POST']['PROPS'][28]
			)
		);
		
		if(empty($arResult['ERRORS'])) {
			if(!$arParams['USER_ID'] = $user->Add($arUserFields)) {
				$arResult['ERRORS'][] = $user->LAST_ERROR;
			} else {
				$USER->Authorize($arParams['USER_ID']);
				unset($arResult['POST']['FIELDS']['REGISTER']);
			}
		}
	}

	if(empty($arResult['ERRORS'])) {
		$arOrderFields = array(
		   'LID' 				=> SITE_ID,
		   'PERSON_TYPE_ID' 	=> $arParams['USER_TYPE_ID'],
		   'PAYED' 				=> 'N',
		   'CANCELED' 			=> 'N',
		   'STATUS_ID' 			=> 'N',
		   'PRICE' 				=> $arResult['ORDER_INFO']['SUM'],
		   'CURRENCY' 			=> 'RUB',
		   'USER_ID' 			=> !empty($arParams['USER_ID']) ? $arParams['USER_ID'] : 1,
		   'USER_DESCRIPTION' 	=> $arResult['POST']['FIELDS']['COMMENT']
		);


		if(!$orderId = CSaleOrder::Add($arOrderFields)) {
			$arResult['ERRORS'][] = 'Ошибка добавления заказа';
		}
		
	}
	
	if(empty($arResult['ERRORS'])) {
		
		$arEventFields = array(
			'ORDER_ID' 		=> $orderId,
			'ORDER_LINK' 	=> 'http://' . $_SERVER['HTTP_HOST'] . '/bitrix/admin/sale_order_detail.php?ID=' . $orderId,
		);
		
		if(!empty($arParams['USER_ID'])) {
			CSaleOrderUserProps::DoSaveUserProfile($arParams['USER_ID'], $arParams['PROFILE_ID'], $arResult['POST']['PROPS'][27], $arParams['USER_TYPE_ID'], $arResult['POST']['PROPS'], $arResult['ERRORS']);
		}
		
		CSaleBasket::OrderBasket($orderId, CSaleBasket::GetBasketUserID(), SITE_ID);
		foreach($arResult['PROPS'] as $propId => $arProp) {
			CSaleOrderPropsValue::Add(array(
				'NAME' 				=> $arProp['NAME'],
				'CODE'				=> $arProp['CODE'],
				'ORDER_PROPS_ID' 	=> $arProp['ID'],
				'ORDER_ID' 			=> $orderId,
				'VALUE' 			=> $arProp['VALUE'],
			));
			$arEventFields['P_' . $arProp['CODE']] = $arProp['VALUE'];
		}
		// добавить EMAIL текущего авторизованного пользователя
		$arEventFields['P_' . 'EMAIL'] = $USER->GetEmail();
	}
	
	if(empty($arResult['ERRORS'])) {
		$arResult['MESSAGE'] = 'Заказ №' . $orderId . ' успешно создан!';
		switch($arResult['PROPS'][$arParams['SEND_ME_PROP_ID']]['VALUE']) {
			case 1:
				// коммерческое предложение
				break;
			case 2:
				// счет на оплату
				break;
			default:
		}
		
		// send letter to manager
		if(SHOW_PRICE === 'Y')
		{
			$productsTable = '<table border="0" cellpadding="8" cellspacing="0" width="700">
				<tbody>
					<tr bgcolor="#B1B1BE" color="#FFFFFF" style="background:#b1b1be;color:#ffffff;font-weight:bold">
						<td width="70%">
							<span style="text-align:center">Товар</span>
						</td>
						<td>
							<span style="text-align:center">Цена</span>
						</td>
						<td>
							<span style="text-align:center">Кол-во</span>
						</td>
						<td>
							<span style="text-align:center">Сумма</span>
						</td>
					</tr>
			';
		}
		else
		{
			$productsTable = '<table border="0" cellpadding="8" cellspacing="0" width="700">
				<tbody>
					<tr bgcolor="#B1B1BE" color="#FFFFFF" style="background:#b1b1be;color:#ffffff;font-weight:bold">
						<td width="85%">
							<span style="text-align:center">Товар</span>
						</td>
						<td style="text-align:center">
							<span>Кол-во</span>
						</td>
					</tr>
			';
		}
		$pNum = 1;
		foreach($arResult['ITEMS'] as $id => $arItem) {
			if(SHOW_PRICE === 'Y')
			{
				if($arItem['PROPERTY_CML2_ARTICLE'] <> "")
				{
					$article = '(арт. '. $arItem['PROPERTY_CML2_ARTICLE'] .')';
				}

				// $pNum - нумерация списка
				$productsTable .= '
					<tr>
						<td valign="top">
							'.$arItem['NAIMENOVANIE_DLYA_SAYTA_POLNOE'] . ' ' . $article . '
						</td>
						<td valign="top">
							' . getPrintPrice($arItem['PRICE']) . '
						</td>
						<td valign="top">
							' . intval($arItem['QUANTITY']) . '
						</td>
						<td style="text-align:center" valign="top">
							' . getPrintPrice($arItem['SUM'])  . '
						</td>
					</tr>
				';
			}
			else
			{
				if($arItem['PROPERTY_CML2_ARTICLE'] <> "")
				{
					$article = '(арт. '. $arItem['PROPERTY_CML2_ARTICLE'] .')';
				}
				// $pNum - нумерация списка
				$productsTable .= '
					<tr>
						<td valign="top">
							' . $arItem['NAIMENOVANIE_DLYA_SAYTA_POLNOE'] . ' ' . $article . '
						</td>
						<td style="text-align:center" valign="top">
							' . intval($arItem['QUANTITY']) . '
						</td>
					</tr>
				';
			}
			if(!empty($arItem['OPTIONS'])) {
				$opNum = 0;

				$first = true;
				foreach($arItem['OPTIONS'] as $key => $option) {
					if(!$arOptionQuantites[$option['PRODUCT_ID'] . '_' . $id])
					{
						continue;
					}
					if(SHOW_PRICE === 'Y')
					{
						if($option['PROPERTY_CML2_ARTICLE'] <> "")
						{
							$article = '(арт. '. $option['PROPERTY_CML2_ARTICLE'] .')';
						}

						// $opNum - нумерация списка
						$productsTable .= '
							<tr>
								<td style="padding: 3px 8px 3px 20px;" valign="top">
									' . $option['NAIMENOVANIE_DLYA_SAYTA_POLNOE'] . ' ' . $article . '
								</td>
								<td style="padding: 3px 8px;" valign="top">
									' . getPrintPrice($option['PRICE']) . '
								</td>
								<td style="padding: 3px 8px; text-align:center" valign="top">
									' . intval($arOptionQuantites[$option['PRODUCT_ID'] . '_' . $id]) . '
								</td>
								<td style="padding: 3px 8px;" valign="top">
									' . getPrintPrice($option['SUM'])  . '
								</td>
							</tr>
						';
					}
					else
					{
						// $opNum - нумерация списка
						if($option['PROPERTY_CML2_ARTICLE'] <> "")
						{
							$article = '(арт. '. $option['PROPERTY_CML2_ARTICLE'] .')';
						}

						$productsTable .= '
							<tr>
								<td style="padding: 3px 8px 3px 20px;" valign="top">
									' . $option['NAIMENOVANIE_DLYA_SAYTA_POLNOE'] . ' ' . $article . '
								</td>
								<td style="padding: 3px 8px; text-align:center" valign="top">
									' . intval($arOptionQuantites[$option['PRODUCT_ID'] . '_' . $id]) . '
								</td>
							</tr>
						';
					}
					$opNum++;
				}
				if(!$first)
				{
					$productsTable .= '
						</table></td></tr>
                    ';
				}
			}
			$pNum++;

			if(SHOW_PRICE === 'Y')
			{
				$colspan = 4;
			}
			else
			{
				$colspan = 2;
			}

			if($opNum > 0 && $opNum < sizeof($arItem['OPTIONS']))
			{
				$arItem["OPTIONS_STATUS"] = 'Покупатель выбрал не все опции';
			}
			elseif($opNum == 0 && sizeof($arItem['OPTIONS']) > 0)
			{
				$arItem["OPTIONS_STATUS"] = 'Покупатель не выбрал ни одной опции';
			}
			elseif($opNum > 0 && $opNum == sizeof($arItem['OPTIONS']))
			{
				$arItem["OPTIONS_STATUS"] = 'Покупатель выбрал все опции';
			}

			$productsTable .= '
				<tr>
					<td colspan="'.$colspan.'" style="padding-top: 0; font-size: 11px; border-bottom:1px solid #d6d6dc">
            	        '.$arItem["OPTIONS_STATUS"].'
            		</td>
            	</tr>
            ';
		}
		if(SHOW_PRICE === 'Y')
		{
			$productsTable .= '<tr style="border-bottom:1px solid #d6d6dc">
				<td colspan="3" valign="top"><strong>Итого</strong></td>
				<td valign="top"><strong>' . getPrintPrice($arResult['ORDER_INFO']['SUM']) . '</strong></td>
			</tr>';
		}
		$productsTable .= '</tbody></table>';

		$arEventFields['PRODUCTS'] = $productsTable;

		if($arResult['PROPS'][28]['VALUE']){
			SendAttache("NEW_ORDER_TO_ADMIN", SITE_ID, $arEventFields, CFile::GetPath($arResult['PROPS'][28]['VALUE']));
		} else {
			CEvent::SendImmediate('NEW_ORDER_TO_ADMIN', 's1', $arEventFields);
		}
	}
	
}

// props
$rsPropVariants = CSaleOrderPropsVariant::GetList(
	array('SORT' => 'ASC'),
	array('ORDER_PROPS_ID' => $arParams['SEND_ME_PROP_ID'])
);
while ($arPropVariant = $rsPropVariants->Fetch()) {
	$arResult['PROPS'][$arParams['SEND_ME_PROP_ID']]['VALUES'][] = $arPropVariant;
}

if(!empty($arUserPropsIds) && !empty($arParams['PROFILE_ID']) && empty($arResult['POST'])) {
 
	$rsProfilePropValues = CSaleOrderUserPropsValue::GetList(array('ID' => 'ASC'), array('USER_PROPS_ID' => $arParams['PROFILE_ID'], 'ORDER_PROPS_ID' => $arUserPropsIds));
	while ($arProfilePropValue = $rsProfilePropValues->Fetch()) {
		$arResult['PROPS'][$arProfilePropValue['ORDER_PROPS_ID']]['VALUE'] = $arProfilePropValue['VALUE'];
	}
}

if(empty($arResult['PROPS'][$arParams['SEND_ME_PROP_ID']]['VALUE'])) {
	$arResult['PROPS'][$arParams['SEND_ME_PROP_ID']]['VALUE'] = $arResult['PROPS'][$arParams['SEND_ME_PROP_ID']]['VALUES'][0]['ID'];
}

$arResult["OPTION_QUANTITY"] = $arOptionQuantites;

$this->IncludeComponentTemplate();
?>