<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Восстановление пароля");
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:system.auth.changepasswd", 
	""
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>