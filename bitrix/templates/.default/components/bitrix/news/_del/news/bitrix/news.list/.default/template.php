<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<TABLE WIDTH=100% ALIGN=CENTER  CELLSPACING=0 CELLPADDING=0 BORDER=0 style="padding:10 20 10 20;">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<tr>
  <td width="70">
   <?if($arItem["DISPLAY_ACTIVE_FROM"]):?>
		 	<?echo $arItem["DISPLAY_ACTIVE_FROM"]?><br>
		 <?endif?>
  </td>
  <td>
		 <?if($arItem["NAME"]):?>
			 <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" class=t ><b><?echo $arItem["NAME"]?></b></a><br />			
		 <?endif;?>
  </td>
 </tr>
 <tr>
  <td width="70">
   <?if(is_array($arItem["PREVIEW_PICTURE"])):?>
			 <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img border="0" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["NAME"]?>"></a>
		 <?else:?>
    &nbsp;
   <?endif?>
  </td>
  <td style="text-align: justify;">
		 <?echo $arItem["PREVIEW_TEXT"];?>
   <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><b>...подробнее...</b></a>
		</td>
	</p>
<tr><td></td><td>
<hr style="width: 80%; height: 2px;">
</td></tr>
<?endforeach;?>

</table>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>