<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<TABLE WIDTH=100% ALIGN=CENTER  CELLSPACING=0 CELLPADDING=0 BORDER=0 style="padding:10 20 10 20;">
	<TR>
		<td>
				<h1><?=$arResult["NAME"]?></h1>
    <?if(is_array($arResult["PREVIEW_PICTURE"])):?>
     <?if(is_array($arResult["DETAIL_PICTURE"])):?><a href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" target="_blank"><?endif?>
				 <img border="0" src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arResult["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arResult["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["PREVIEW_PICTURE"]["DESCRIPTION"]?>" title="<?=$arResult["NAME"]?>" style="float: left; margin-right: 5px; margin-bottom: 5px;">
			 	<?if(is_array($arResult["DETAIL_PICTURE"])):?></a><?endif?>
				<?endif;?>
    <p align=justify>
    <?if($arResult["DETAIL_TEXT"]):?>
		   <?=$arResult["DETAIL_TEXT"]?>
	   <?elseif($arResult["PREVIEW_TEXT"]):?>
		   <?=$arResult["PREVIEW_TEXT"]?>
	   <?endif;?>
    </p>
		</td>
	</tr>
</table>