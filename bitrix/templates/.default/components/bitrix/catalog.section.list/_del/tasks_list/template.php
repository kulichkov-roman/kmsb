<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(count($arResult["SECTIONS"])):?>
 <table style="border: 1px outset rgb(0, 0, 0);" border="0" cellpadding="2" cellspacing="0" width="100%">
  <tr align="center"><td class="RecordsTableHeader3">Комплекты оборудования</td></tr>
  <tr align="center" valign="top">
   <td style="padding: 15px 0px;">
    <select style="width: 200px;" name="task" onChange="if(this.value) location.href=this.value;">
     <option value="">Выберите задачу</option>
     <?foreach($arResult["SECTIONS"] as $arSection):?>
	     <?
       $s_name = $arSection["NAME"];
       if(strlen($s_name) > 33)
         $s_name = substr($s_name, 0, 30)."...";
      ?>
      <option value="<?=$arSection["SECTION_PAGE_URL"]?>" title="<?=$arSection["NAME"]?>"><?=$s_name?></option>
     <?endforeach?>
    </select>
   </td>
  </tr>
 </table>
<?endif?>