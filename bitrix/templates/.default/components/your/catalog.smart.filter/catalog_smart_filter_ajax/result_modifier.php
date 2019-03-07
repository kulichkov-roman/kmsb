<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
//if($USER->isAdmin())
//{
//	echo "<pre>"; var_dump($arItem["VALUE"]); echo "</pre>";
//}

// показать/скрыть фильтр
$arResult['SHOW_FILTER'] = 'N';
foreach($arResult['ITEMS'] as &$arItem)
{
	if(sizeof($arItem["VALUES"]) > 0)
	{
		if(isset($arItem["VALUES"]['MAX']) || isset($arItem["VALUES"]['MIN']))
			continue;

		$arResult['SHOW_FILTER'] = 'Y';
			break;
	}
}
unset($arItem);

// подсчет выбранных значений
$resCountChecker = 0;
foreach($arResult['ITEMS'] as &$arItem)
{
	if(is_array($arItem["VALUES"]))
	{
		$countChecker = 0;
		foreach($arItem["VALUES"] as $val => $ar)
		{
			if($ar["CHECKED"])
			{
				$countChecker++;
			}
		}
		if($countChecker > 0)
		{
			$arItem["COUNT_CHECKED"] = $countChecker;
			$resCountChecker += $countChecker;
			$countChecker = 0;
		}
	}
}
unset($arItem);

if ($resCountChecker > 0)
{
	$arResult["RES_COUNT_CHECKED"] = $resCountChecker;
}

// сортировка значений в умном фильтре

foreach($arResult["ITEMS"] as $key=>$arValue)
{


    if(!empty($arValue["VALUES"]))
    {
        if($USER->isAdmin())
        {
            //natsort($arValue["VALUES"]);
        }

        foreach ($arValue["VALUES"] as $key => $row) {
            $num = str_replace("ml", "", $key);
            $sortValues[$key]  = $num;
        }
        array_multisort($sortValues, SORT_ASC, $arItem['VALUES']);
        unset($sortValues);
    }
}

// пересортировка массива
foreach($arResult["ITEMS"] as $key=>$arValue)
{
    // цены не считать
    if (!($arValue["PROPERTY_TYPE"] == "N" || isset($arValue["PRICE"])) && count($arValue["VALUES"]))
    {
        $arValues = Array();
        $arMatches = Array();
        $arResValues = Array();

        // получить значения сформировать их в массив
        foreach ($arValue["VALUES"] as $keyVal => $value)
        {
            $arMatches[$keyVal] = $value["VALUE"];
        }

        // применить натуральную сортировку
        natsort($arMatches);

        // пересобрать массив
        foreach($arMatches as $keyTmp => $arItemTmp)
        {
            $arResValues[] = $arValue["VALUES"][$keyTmp];
        }

        $arResult["ITEMS"][$key]["VALUES"] = $arResValues;
    }
}
?>