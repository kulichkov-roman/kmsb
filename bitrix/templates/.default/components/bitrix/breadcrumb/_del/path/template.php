<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;
$strReturn = '';
if(count($arResult) > 1)
{
$strReturn = '<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 10px;"><tr><td>';
for($index = 0, $itemSize = count($arResult); $index < $itemSize; $index++)
{
  $strReturn .= '<nobr><img src="/images/bull.gif">&nbsp;&nbsp;';

	 $title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	 if($arResult[$index]["LINK"] <> "")
		  $strReturn .= '<strong><a href="'.$arResult[$index]["LINK"].'" title="'.$title.'">'.$title.'</a></strong>&nbsp;</nobr> ';
	 else
		  $strReturn .= '<strong>'.$title.'</strong>&nbsp;</nobr> ';
}
$strReturn .= '</td></tr></table>';
}
return $strReturn;
?>