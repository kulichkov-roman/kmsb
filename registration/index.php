<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация");
?><?$APPLICATION->IncludeComponent(
	"your:main.register", 
	"register", 
	array(
		"SHOW_FIELDS" => array(
			0 => "EMAIL",
			1 => "NAME",
			2 => "PERSONAL_PHONE",
			3 => "WORK_COMPANY",
			4 => "WORK_PHONE",
			5 => "WORK_FAX",
			6 => "WORK_STREET",
			7 => "WORK_NOTES",
		),
		"REQUIRED_FIELDS" => array(
			0 => "EMAIL",
			1 => "NAME",
			2 => "WORK_COMPANY",
			3 => "WORK_PHONE",
			4 => "WORK_STREET",
		),
		"AUTH" => "Y",
		"USE_BACKURL" => "Y",
		"SUCCESS_PAGE" => "",
		"SET_TITLE" => "Y",
		"USER_PROPERTY" => array(
			0 => "UF_FILES",
			1 => "UF_INN",
			2 => "UF_KPP",
		),
		"USER_PROPERTY_NAME" => ""
	),
	false
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>