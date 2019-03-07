<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$arParams["IBLOCK_ID"] = 45;

$elementId = 27498;
if($elementId && ($arParams["IBLOCK_ID"] == 45)){
	CModule::IncludeModule("iblock");
	$rsElements = CIBlockElement::GetList(
		array(),
		array(
			"ID" => $elementId
		),
		false,
		false,
		array(
			"ID",
			"NAME",
			"PROPERTY_Person"
		)
	);
	if($arElement = $rsElements -> GetNext()){
		$personId = $arElement["PROPERTY_PERSON_VALUE"];
		if($personId){
			$rsElement = CIBlockElement::GetById($personId);
			if($arElement = $rsElement -> GetNext()){
				$sectionId = $arElement["ID"];
				pre($sectionId);
			}
		}
	}
}
echo 'completed';