<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<TABLE WIDTH=100% ALIGN=CENTER  CELLSPACING=0 CELLPADDING=0 BORDER=0 style="padding:10 20 10 20;">
 <?foreach($arResult["ITEMS"] as $arItem):?>
  <tr>
   <td>
    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><h1><?=$arItem["NAME"]?></h1></a>
    <?if(is_array($arItem["PREVIEW_PICTURE"])):?>
     <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img border="0" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["NAME"]?>" style="float: left; margin-right: 5px; margin-bottom: 5px;"></a>
    <?endif?>
    <p align="justify"><?=$arItem["PREVIEW_TEXT"]?> <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><b>...подробнее...</b></a><br></p><br>
   </td>
  </tr>
 <?endforeach;?>
</table>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>