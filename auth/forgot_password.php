<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Восстановление пароля");
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:system.auth.forgotpasswd", 
	"forgotpasswd"
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>