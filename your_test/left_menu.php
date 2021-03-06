<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

//die('disable');

if (CModule::IncludeModule("iblock"))
{
	// �������� ������ ID ���������, ������� �� ���������� � ������, ������������� �� SECTION_ID
	$arSort = array();
	$arSelect = array("ID", "NAME", "IBLOCK_SECTION_ID");
	$arFilter = array(
		"ACTIVE" => "Y",
		"IBLOCK_ID" => CATALOG_IBLOCK_ID_KS,
		"PROPERTY_AKSESSUAR_V_GRUPPE" => "true",
	);
	$arGroupBy = array('IBLOCK_SECTION_ID');
	
	$rsElements = CIBlockElement::GetList(
		$arSort, 
		$arFilter, 
		$arGroupBy, 
		false, 
		$arSelect
	);
	
	while ($arItem = $rsElements->GetNext())
	{
		$arElement[] = $arItem;
	}
	//echo sizeof($arElement);
	//echo "<pre>"; var_dump($arElement); echo "</pre>";die();
	
	// ��������� SECTION_ID � ������ $arIds
	$arIds = array();
	foreach($arElement as &$arItem)
	{
		$arIds[] = $arItem["IBLOCK_SECTION_ID"];
	}
	unset($arItem, $arElement);
	
	//echo "<pre>"; var_dump($arIds); echo "</pre>";
	
	// ��������� ������ $arIds, �������� SECTION_ID �� ���������.
	foreach($arIds as $key=>$id)
	{
		$rsPath= GetIBlockSectionPath(CATALOG_IBLOCK_ID_KS, $id);
		while($arItem = $rsPath->GetNext())
		{
			$arPath[] = $arItem["ID"];
		}
		$arIds[$key] = array(
			"ID" => $id,
			"PATH_ID" => $arPath,
		);
		unset($arPath);
	}
	
	//echo "<pre>"; var_dump($arIds); echo "</pre>";
	
	// ���������� �������� ���������������� ��� ���� SECTION_ID �� $arIds
	$bs = new CIBlockSection;
	
	$arFields = Array(
		"UF_SHOW_LEFT_MENU" => true,
	);
	
	foreach($arIds as $arId)
	{
		if($arId["ID"] > 0)
		{
			$rsCurBs = $bs->Update($arId["ID"], $arFields);
			
			foreach($arId["PATH_ID"] as $id)
			{
				$rsPathBs = $bs->Update($id, $arFields);
				//if($rsPathBs)
				//{
				//	echo $id.' true*';
				//}
				//else
				//{
				//	echo $id.' false';
				//}
			}
			
			//if($rsCurBs)
			//{
			//	echo $id.' true';
			//}
			//else
			//{
			//	echo $id.' false';
			//}
		}
	}
	
	unset($arId);
	
	
	
	echo 'done';
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>