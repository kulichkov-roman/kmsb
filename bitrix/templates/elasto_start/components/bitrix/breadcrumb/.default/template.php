<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

if(empty($arResult))
	return "";

$strReturn = "";

$strReturn .= "<div class='breadcrumb'>";

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++) {
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);

	$nextRef = ($index < $itemSize - 2 && $arResult[$index+1]["LINK"] <> "" ? " itemref='breadcrumb_".($index + 1)."'" : "");
	$child = ($index > 0 ? " itemprop='child'" : "");
	$arrow = ($index > 0 ? "<i class='separate'></i>" : "");

	if($arResult[$index]["LINK"] <> "" && $index != $itemSize - 1) {
		$strReturn .= "<div class='breadcrumb-item' id='breadcrumb_".$index."' itemscope='' itemtype='http://data-vocabulary.org/Breadcrumb'".$child.$nextRef.">".$arrow."<a href='".$arResult[$index]["LINK"]."' title='".$title."' itemprop='url'><span itemprop='title'>".$title."</span></a></div>";
	} else {
		$strReturn .= "<div class='breadcrumb-item'>".$arrow."<span>".$title."</span></div>";
	}
}

$strReturn .= "</div>";

return $strReturn;?>