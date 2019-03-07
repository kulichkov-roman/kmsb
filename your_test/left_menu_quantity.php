<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

//die('disable');

if (CModule::IncludeModule("iblock"))
{
	$arSort = array("SORT"=>"ASC");
	$arSelect = array("ID", "NAME", "IBLOCK_SECTION_ID");
	$arFilter = array(
		"ACTIVE" => "Y",
		"IBLOCK_ID" => CATALOG_IBLOCK_ID_KS,
        "PROPERTY_AKSESSUAR_V_GRUPPE" => "true",
		">CATALOG_QUANTITY" => 0,
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

	$arIds = array();
	foreach($arElement as &$arItem)
	{
		$arIds[] = $arItem["IBLOCK_SECTION_ID"];
	}
	unset($arItem, $arElement);

	//echo "<pre>"; var_dump($arIds); echo "</pre>";

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

	//echo "<pre>"; var_dump($arIds); echo "</pre>"; die();

	$bs = new CIBlockSection;
	
	$arFields = Array(
		"UF_POSITIVE_BALANCES" => true,
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