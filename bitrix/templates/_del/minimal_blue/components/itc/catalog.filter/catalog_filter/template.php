<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="content-block content-block-subscribe">
	<h3>Форма поиска</h3>
<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="/catalog/search/" method="get">
	<?foreach($arResult["ITEMS"] as $arItem):
		if(array_key_exists("HIDDEN", $arItem)):
			echo $arItem["INPUT"];
		endif;
	endforeach;?>
	<table class="catalog-search" cellspacing="0" cellpadding="0" border="0">
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<?if(!array_key_exists("HIDDEN", $arItem)):?>
				<tr>
					<td valign="top">
      <?if($arItem["NAME"]):?><?=$arItem["NAME"]?>:<br><?endif?>
					 <?=$arItem["INPUT"]?>
     </td>
				</tr>
			<?endif?>
		<?endforeach;?>
	</table>
 <input type="submit" class="catalog-search-sub" name="set_filter" value="Найти" /><input type="hidden" name="set_filter" value="Y" />
</form>
</div>