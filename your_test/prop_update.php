<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");



$el = new CIBlockSection;

$res = CIBlockSection::GetList(array("ID" => "DESC"), array( "IBLOCK_ID" => 1, "ACTIVE" => "Y"));
$i = 0;
while( $ar_res = $res->GetNext()) {
	
	if( empty($ar_res['CODE'])) {
		$params = Array(
		   "max_len" => "100", // обрезает символьный код до 100 символов
		   "change_case" => "L", // буквы преобразуютс€ к нижнему регистру
		   "replace_space" => "_", // мен€ем пробелы на нижнее подчеркивание
		   "replace_other" => "_", // мен€ем левые символы на нижнее подчеркивание
		   "delete_repeat_replace" => "true", // удал€ем повтор€ющиес€ нижние подчеркивани€
		);

			
		$code = CUtil::translit( $ar_res['NAME'], "ru", $params); 	

		$arFields = array("CODE" => $code );
		$upd_res = $el->Update($ar_res['ID'], $arFields);
		$i++;
	}
}

echo $i;
?>


