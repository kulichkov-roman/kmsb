<?require($_SERVER["DOCUMENT_ROOT"]. "/bitrix/modules/main/include/prolog_before.php");?>
<?

class specialOffers{
	const AVAILABLE_PROP_CODE = "AVAILABLE_ICO";
	const AVAILABLE_YES = '135';

	const ITEM_PROP_CODE = "ITEM";

	static $_arSpecialOfferIblockIds = array(
		SLIDER_ON_MAIN_IBLOCK_ID,
		SLIDER_ON_MAIN_IBLOCK_ID
	);

	private static $catalogItemId = false;
	private static $oldActiveStatus = false;

	//установить свойство элемента каталога "Товар в наличии"
	public static function setAvailableProperty($elementId, $value = ""){
		CModule::IncludeModule("iblock");

		CIBlockElement::SetPropertyValuesEx(
	        $elementId,
	        CATALOG_IBLOCK_ID_KS,
	        array(
	            self::AVAILABLE_PROP_CODE => $value
	        )
	    );
	}

	//получить значение свойства-привязки "Товар" для слайдера
	public static function getCatalogItemProperty($elementId){
		CModule::IncludeModule("iblock");

		$rsProp = CIBlockElement::GetProperty(SLIDER_ON_MAIN_IBLOCK_ID, $elementId, array(), array("CODE" => self::ITEM_PROP_CODE));
		$arProp = $rsProp -> GetNext();

		return $arProp["VALUE"];
	}

	//проверить, имеет ли инфоблок отношение к "спец.предложениям"
	function isSpecialOffer($iblockId){
		return in_array(self::$_arSpecialOfferIblockIds);
	}

	//сохранить текущее значение свойства-привязки "товар"
	function saveParams($arFields){
		if(!self::isSpecialOffer($arFields["IBLOCK_ID"])){
			return;
		}

		self::$catalogItemId = self::getCatalogItemProperty($arFields["ID"]);
	}

	//при апдейте элемента слайдера установить для товара свойство "доступность"
	function setAvailablie($arFields){
		if(!self::isSpecialOffer($arFields["IBLOCK_ID"])){
			return;
		}
		
		$elementId = $arFields["ID"];
		$newCatalogItemId = self::getCatalogItemProperty($elementId);
		$oldCatalogItemId = self::$catalogItemId;

		//если деактивировали элемент - убрать свойство "товар в наличии"
		if($arFields["ACTIVE"] != "Y"){
			self::setAvailableProperty($oldCatalogItemId);
			return;
		}

		if(($newCatalogItemId == $oldCatalogItemId )&& (self::oldActiveStatus == "Y")){
			return;
		}		

		//у раннее прикрепленного элемента каталога убираем галочку "товар в наличии"
		if($oldCatalogItemId){
			self::setAvailableProperty($oldCatalogItemId);
		}

		//у прикрепленного элемента ставим галочку "товар в наличии"
		if($newCatalogItemId){
			self::setAvailableProperty($newCatalogItemId, self::AVAILABLE_YES);	
		}
	}
}

$elementId = 18305;
$catalogItemProperty = specialOffers::getCatalogItemProperty($elementId);
specialOffers::setAvailableProperty($catalogItemProperty);
echo 'completed';
?>