<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

//pre($arResult); die('1');

$curDir = $APPLICATION->GetCurDir();
$arCurPach = explode("/", $curDir);

$arCurPachUrl = array_unique($arCurPach);
$arCurPachUrl = array_diff($arCurPachUrl, array(''));

if($arCurPachUrl[3] == 'section')
{
	foreach($arResult as &$arItem)
	{
		$arPach = explode("/", $arItem["LINK"]);
		
		$arPachUrl = array_unique($arPach);
		$arPachUrl = array_diff($arPachUrl, array(''));
		
		if($arPachUrl[3] === $arCurPachUrl[4])
		{
			$arItem["SELECTED"] = true;
		}
		else
		{
			$arItem["SELECTED"] = false;
		}
	}
	unset($arItem);
}
?>