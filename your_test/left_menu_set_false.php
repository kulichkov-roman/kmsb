<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

//die('disable');

if (CModule::IncludeModule("iblock"))
{
	$arSort = array();
	$arFilter = array(
		"IBLOCK_ID" => CATALOG_IBLOCK_ID_KS,
	);
	$arSelect = array("ID", "NAME");
				
	$rsSection = CIBlockSection::GetList(
		$arSort,
		$arFilter,
		false,
		$arSelect,
		false
	);
	
	$arSection = array();
	while ($arItem = $rsSection->GetNext())
	{
		$arSectionIDs[] = $arItem["ID"];
	}
	unset($arItem, $arElement);

	$bs = new CIBlockSection;

	$arFields = Array(
		"UF_SHOW_LEFT_MENU" => false,
        "UF_POSITIVE_BALANCES" => false,
	);

	foreach($arSectionIDs as $id)
	{
		if($id > 0)
		{
			$rsCurBs = $bs->Update($id, $arFields);
		}
	}
	unset($arId);

	echo 'done';
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>