<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
 <table cellpadding="3" cellspacing="0">
  <tr>
   <?foreach($arResult as $arItem):?>
    <?if(array_key_exists("image", $arItem["PARAMS"]) && $arItem["PARAMS"]["image"]):?>
     <td align="right" width="40"><a href="<?=$arItem["LINK"]?>" class="menu"><img src="<?=$arItem["PARAMS"]["image"]?>" alt="<?=$arItem["TEXT"]?>" border="0" width="30" height="30"></a>
    <?endif?>
    <td><a href="<?=$arItem["LINK"]?>" class="menu"><?=$arItem["TEXT"]?></a></td>
   <?endforeach?>
  </tr>
 </table>
<?endif?>