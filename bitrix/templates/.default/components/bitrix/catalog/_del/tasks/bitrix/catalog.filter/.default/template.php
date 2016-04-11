<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?global $sub_sec;?>
<?if(!$sub_sec):?>
<?
 $search_item = '';
 $value = '';
 if(array_key_exists('search_item', $_REQUEST) && $_REQUEST['search_item'])
 {
   $search_item = $_REQUEST["search_item"];
   $val_mas = $_REQUEST["tasks_filter_pf"];
   $value = $val_mas[$search_item];
 }
?>
<? /*<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>"  method="get"> */ ?>
<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="/tasks/" method="get">
	<table cellspacing="0" cellpadding="2">
		<tr>
  <td>
  <select name="search_item" onChange="document.getElementById('inp').name = 'tasks_filter_pf['+this.value+']';">
   <?foreach($arResult["arrProp"] as $arItem):?>
    <option value="<?=$arItem["CODE"]?>" <?if($arItem["CODE"] == $search_item):?>selected<?endif?>><?=$arItem["NAME"]?></option>
   <?endforeach?>
  </select>
  </td>
  <td><input id="inp" type="text" name="tasks_filter_pf[<?if($search_item) echo $search_item; else echo "gost";?>]" value="<?=$value?>"></td>
		<td><input type="submit" name="set_filter" value="Поиск" /><input type="hidden" name="set_filter" value="Y" /></td>
		</tr>
	</table>
</form>
<?endif?>