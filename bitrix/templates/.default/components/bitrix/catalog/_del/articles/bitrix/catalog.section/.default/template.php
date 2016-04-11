<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(count($arResult["ITEMS"])):?>		
 <TABLE WIDTH=100% ALIGN=CENTER  CELLSPACING=0 CELLPADDING=0 BORDER=0 style="padding:10 20 10 20;">
  <?foreach($arResult["ITEMS"] as $cell=>$arElement):?>
			<tr>
				<td>
     <a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><h1><?=$arElement["NAME"]?></h1></a>
     <?if(is_array($arElement["PREVIEW_PICTURE"])):?>
      <a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><img border="0" src="<?=$arElement["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arElement["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arElement["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arElement["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arElement["NAME"]?>" style="float: left; margin-right: 5px; margin-bottom: 5px;"></a>
					<?endif?>
					<p align="justify"><?=$arElement["PREVIEW_TEXT"]?> <a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><b>...подробнее...</b></a><br></p><br>
				</td>
			</tr>
		<?endforeach;?>
 </table>
<?endif?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>