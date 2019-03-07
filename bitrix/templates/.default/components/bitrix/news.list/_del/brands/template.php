<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<h1>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<A HREF="<?=$arItem["DETAIL_PAGE_URL"]?>"><img src="/images/bull2.gif" border=0> &nbsp;<?=$arItem["NAME"]?></A><BR>
<?endforeach;?>
</h1>