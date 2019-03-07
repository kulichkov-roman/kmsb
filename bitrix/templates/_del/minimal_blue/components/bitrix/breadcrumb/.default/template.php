<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//delayed function must return a string

__IncludeLang(dirname(__FILE__).'/lang/'.LANGUAGE_ID.'/'.basename(__FILE__));
/*
$curPage = $GLOBALS['APPLICATION']->GetCurPage();

if ($curPage != SITE_DIR)
{
	if (empty($arResult) || $curPage != $arResult[count($arResult)-1]['LINK'])
		$arResult[] = array('TITLE' =>  htmlspecialcharsback($GLOBALS['APPLICATION']->GetTitle(false, true)), 'LINK' => "");
}
*/
if(empty($arResult))
	return '<div id="breadcrumb"><a title="'.GetMessage('BREADCRUMB_MAIN').'" href="'.SITE_DIR.'"><img width="12" height="11" src="/bitrix/templates/'.SITE_TEMPLATE_ID.'/images/home.gif" alt="'.GetMessage('BREADCRUMB_MAIN').'" /></a></div>';
	
$strReturn = '<div id="breadcrumb"><a title="'.GetMessage('BREADCRUMB_MAIN').'" href="'.SITE_DIR.'"><img width="12" height="11" src="/bitrix/templates/'.SITE_TEMPLATE_ID.'/images/home.gif" alt="'.GetMessage('BREADCRUMB_MAIN').'" /></a>';

for($index = 0, $itemSize = count($arResult); $index < $itemSize; $index++)
{
	$strReturn .= '<i>&ndash;</i>';

	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	
	if($arResult[$index]["LINK"] <> "")
		$strReturn .= '<a href="'.$arResult[$index]["LINK"].'" title="'.$title.'">'.$title.'</a>';
	else
		$strReturn .= '<span>'.$title.'</span>';
}

$strReturn .= '</div>';

return $strReturn;
?>