<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(count($arResult["ITEMS"])):?>
 <br><br>
 <TABLE WIDTH=100% ALIGN=CENTER  CELLSPACING=0 CELLPADDING=0 BORDER=0>
  <tr><td class="RecordsTableHeader" valign="top"><span class="RecordsTableHeader">Полезная информация</span></td></tr>
  <tr><td>&nbsp;</td></tr>
  <?foreach($arResult["ITEMS"] as $arItem):?>
	  <tr>
				<td style="padding: 0px 30px;">
     <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><b><?=$arItem["NAME"]?></b></a>
		   <?if(is_array($arItem["PREVIEW_PICTURE"])):?>
			   <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img border="0" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["NAME"]?>"  style="float: left; margin-right: 5px; margin-bottom: 5px;"></a>
		   <?endif?>
		   <p align="justify"><?=$arItem["PREVIEW_TEXT"]?> <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><b>...подробнее...</b></a><br></p><br>
    </td>
	  </tr>
  <?endforeach;?>
 </table>
<?endif?>