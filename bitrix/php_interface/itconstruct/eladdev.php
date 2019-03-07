<?
$itc_eladdev = true;
AddEventHandler("iblock", "OnAfterIBlockElementAdd", Array("ITCElemAdd", "OnBeforeIBlockElementUpdateHandler"));
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", Array("ITCElemAdd", "OnBeforeIBlockElementAddHandler"));

class ITCElemAdd { 
    function OnBeforeIBlockElementAddHandler(&$arFields) {
	if($arFields['WF_NEW'])return true; // from standalone elemet add form, elemnt add twice...
	CModule::IncludeModule("iblock");
	$rsET = CEventType::GetList(Array());
	while ($arET = $rsET->Fetch()){
		preg_match('#^ITC_ELEMENT_ADD_IBLOCK([0-9]+)$#smi', $arET['EVENT_NAME'], $id);
		if($id[1] != $arFields['IBLOCK_ID'])continue;
		
		
		$filds = Array(
			'NAME' => $arFields['NAME'],
			'SECTIONS' => ''
		);
		
		// Sections
		$sec = CIBlockElement::GetElementGroups($arFields['ID'], true);
		$i = 0;
		while($ar_group = $sec->Fetch())$filds['SECTIONS'] .= (($i++)?'; ':''). $ar_group['NAME'];

		// Standalone fields
		$res = CIBlockElement::GetByID($arFields['ID']);
		if($ar_res = $res->GetNext()){
			$filds['PREVIEW_TEXT'] = $ar_res['PREVIEW_TEXT'];
			$filds['DETAIL_TEXT'] = $ar_res['DETAIL_TEXT'];
		}
		
		// Admin link
		$res = CIBlock::GetByID($arFields['IBLOCK_ID']);
		if($ar_res = $res->GetNext())$filds['DIRECT_LINK'] = 'http://'.$_SERVER['SERVER_NAME'].'/bitrix/admin/iblock_element_edit.php?ID='.$arFields['ID'].'&type='.$ar_res['IBLOCK_TYPE_ID'].'&IBLOCK_ID='.$arFields['IBLOCK_ID'];

		$ps = Array();
  $OrderElement = Array();
		$props = CIBlockElement::GetProperty($arFields['IBLOCK_ID'], $arFields['ID']);
		// $ar_props['MULTIPLE']
		while($ar_props = $props->Fetch()){
			if(empty($ps[$ar_props['CODE']]))$ps[$ar_props['CODE']] = Array();
			
			switch($ar_props['PROPERTY_TYPE']){
			case 'F':
				$ar_props['VALUE'] = CFile::GetPath($ar_props['VALUE']);
				break;

			case 'L':
				$property_enums = CIBlockPropertyEnum::GetList(
					Array("SORT"=>"ASC", "VALUE"=>"ASC"),
					Array("ID"=>$ar_props['VALUE'])
				);
				$enum_fields = $property_enums->GetNext();
				$ar_props['VALUE'] = $enum_fields['VALUE'];
				break;

			case 'S':
				if($ar_props['USER_TYPE'] == 'HTML')$ar_props['VALUE'] = $ar_props['VALUE']['TEXT'];	// text/HTML
    if($ar_props['USER_TYPE'] == 'UserID'){
					$rsUser = CUser::GetByID($ar_props['VALUE']);
					$arUser = $rsUser->Fetch();
					$ar_props['VALUE'] = $arUser['NAME']. ' '. $arUser['LAST_NAME']. "( ". $arUser['EMAIL']. " )";
				}
    
				break;
    
			}
			$ps[$ar_props['CODE']][] = $ar_props['VALUE'];
		}
		
		foreach($ps as $code => $vals){
			$filds[$code] = '';
   if(is_array($vals[0])){
				ob_start();?>
				<table>
     <tr>
      <th>ID</th>
      <th>Наименование</th>
      <th>Количество</th>
     </tr>
				<?foreach($vals as $order):?>
				 <tr>
      <td><?=$order['ELEMENT'];?></td>
      <td><?=$order['NAME'];?></td>
      <td><?=$order['COUNT'];?></td>
     </tr>
				<?endforeach;?>
    </table>
				<?
				$str = ob_get_contents();
				ob_end_clean();
				$filds[$code] = $str;
			}else{
			 foreach($vals as $i => $val){
				 if($i)$filds[$code] .= '; ';
				 $filds[$code] .= $val;
			 }
   }
   
		}

		require($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/mainpage.php");
		CEvent::Send($arET['EVENT_NAME'], CMainPage::GetSiteByHost(), $filds); // SITE_ID - always say "ru" in administrtive panel.
		break;
	}
	return true; 
    } 
    
    function OnBeforeIBlockElementUpdateHandler(&$arFields){
	    if($arFields['IBLOCK_ID'] == 14)return true;
	    return ITCElemAdd::OnBeforeIBlockElementAddHandler($arFields);
    }
} 
?>