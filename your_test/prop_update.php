<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");



$el = new CIBlockSection;

$res = CIBlockSection::GetList(array("ID" => "DESC"), array( "IBLOCK_ID" => 1, "ACTIVE" => "Y"));
$i = 0;
while( $ar_res = $res->GetNext()) {
	
	if( empty($ar_res['CODE'])) {
		$params = Array(
		   "max_len" => "100", // �������� ���������� ��� �� 100 ��������
		   "change_case" => "L", // ����� ������������� � ������� ��������
		   "replace_space" => "_", // ������ ������� �� ������ �������������
		   "replace_other" => "_", // ������ ����� ������� �� ������ �������������
		   "delete_repeat_replace" => "true", // ������� ������������� ������ �������������
		);

			
		$code = CUtil::translit( $ar_res['NAME'], "ru", $params); 	

		$arFields = array("CODE" => $code );
		$upd_res = $el->Update($ar_res['ID'], $arFields);
		$i++;
	}
}

echo $i;
?>


