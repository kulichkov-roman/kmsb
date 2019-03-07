<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<!--GALLERY_PREVIEW-->
<?if(is_array($arResult["DISPLAY_PROPERTIES"]["GALLERY"]["FILE_VALUE"]) && count($arResult["DISPLAY_PROPERTIES"]["GALLERY"]["FILE_VALUE"]) > 0):
	if(isset($arResult["DISPLAY_PROPERTIES"]["GALLERY"]["FILE_VALUE"]["ID"])):
		$arTmp = $arResult["DISPLAY_PROPERTIES"]["GALLERY"]["FILE_VALUE"];
		unset($arResult["DISPLAY_PROPERTIES"]["GALLERY"]["FILE_VALUE"]);
		$arResult["DISPLAY_PROPERTIES"]["GALLERY"]["FILE_VALUE"][0] = $arTmp;
	endif;	
	foreach($arResult["DISPLAY_PROPERTIES"]["GALLERY"]["FILE_VALUE"] as $key => $arFile):		
		$arFileTmp = CFile::ResizeImageGet(
			$arFile,
			array("width" => 800, "height" => 600),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true
		);
		$arResult["DISPLAY_PROPERTIES"]["GALLERY"]["FILE_VALUE"][$key]["PREVIEW"] = $arFileTmp["src"];		
	endforeach;
endif;?>

<!--FILES_DOCS-->
<?if(is_array($arResult["DISPLAY_PROPERTIES"]["FILES_DOCS"]["FILE_VALUE"]) && count($arResult["DISPLAY_PROPERTIES"]["FILES_DOCS"]["FILE_VALUE"]) > 0):	
	if(isset($arResult["DISPLAY_PROPERTIES"]["FILES_DOCS"]["FILE_VALUE"]["ID"])):
		$arTmp = $arResult["DISPLAY_PROPERTIES"]["FILES_DOCS"]["FILE_VALUE"];
		unset($arResult["DISPLAY_PROPERTIES"]["FILES_DOCS"]["FILE_VALUE"]);
		$arResult["DISPLAY_PROPERTIES"]["FILES_DOCS"]["FILE_VALUE"][0] = $arTmp;
	endif;
	foreach($arResult["DISPLAY_PROPERTIES"]["FILES_DOCS"]["FILE_VALUE"] as $key => $arFile):		
		$fileTypePos = strrpos($arFile["FILE_NAME"], ".");		
		$fileType = substr($arFile["FILE_NAME"], $fileTypePos + 1);
		$fileTypeFull = substr($arFile["FILE_NAME"], $fileTypePos);
		
		$fileName = str_replace($fileTypeFull, "", $arFile["ORIGINAL_NAME"]);
		
		$fileSize = $arFile["FILE_SIZE"];
		$metrics = array(
			0 => GetMessage('SIZE_B'),
			1 => GetMessage('SIZE_KB'),
			2 => GetMessage('SIZE_MB'),
			3 => GetMessage('SIZE_GB')
		);
		$metric = 0;
		while(floor($fileSize / 1024) > 0) {
			$metric ++;
			$fileSize /= 1024;
		}
		$fileSizeFormat = round($fileSize, 1)." ".$metrics[$metric];

		$arResult["DISPLAY_PROPERTIES"]["FILES_DOCS"]["FILE_VALUE"][$key]["FILE_NAME"] = $fileName;		
		$arResult["DISPLAY_PROPERTIES"]["FILES_DOCS"]["FILE_VALUE"][$key]["FILE_TYPE"] = $fileType;
		$arResult["DISPLAY_PROPERTIES"]["FILES_DOCS"]["FILE_VALUE"][$key]["FILE_SIZE"] = $fileSizeFormat;
	endforeach;
endif;

/***CACHE_KEYS***/
$this->__component->SetResultCacheKeys(
	array(		
		"PREVIEW_PICTURE",
		"PREVIEW_TEXT",
		"DETAIL_PICTURE"
	)
);?>