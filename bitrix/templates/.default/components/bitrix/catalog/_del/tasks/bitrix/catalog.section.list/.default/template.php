<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
 global $sub_sec;
 $sub_sec = count($arResult["SECTIONS"]);
 if(!array_key_exists('search_item', $_REQUEST) || !count($_REQUEST['search_item']))
 {
?>
<h1>
<?foreach($arResult["SECTIONS"] as $arSection):?>
	<?=str_repeat("&nbsp;&nbsp;&nbsp;", $arSection["DEPTH_LEVEL"] - $arResult["SECTION"]["DEPTH_LEVEL"])?> <A HREF="<?=$arSection["SECTION_PAGE_URL"]?>"><img src="/images/bull2.gif" border=0> &nbsp;<?=$arSection["NAME"]?></A><BR>
<?endforeach?>
</h1>
<? }?>