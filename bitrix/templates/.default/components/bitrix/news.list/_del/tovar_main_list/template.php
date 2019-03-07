<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(count($arResult["ITEMS"])):?>
<table style="border: 1px outset rgb(0, 0, 0);" border="0" cellpadding="2" cellspacing="0" width="100%">
 <tr align="center"><td class="RecordsTableHeader">Рекомендуем</td></tr>
 <?foreach($arResult["ITEMS"] as $arItem):?>
	 <tr align="center" valign="top">
   <td><br>
   <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><strong><?echo $arItem["NAME"]?></strong></a><br>
		 <?if(is_array($arItem["PREVIEW_PICTURE"])):?>
			 <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img border="0" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>"></a><br>
		 <?endif?>
	  </td>
  </tr>
 <?endforeach;?>
</table>
<?endif?>