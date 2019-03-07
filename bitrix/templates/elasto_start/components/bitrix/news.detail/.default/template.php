<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);?>

<!--PREVIEW_TEXT-->
<?=$arResult["PREVIEW_TEXT"];?>

<!--DETAIL_PICTURE-->
<?if(is_array($arResult["DETAIL_PICTURE"])):?>
			</div>
		</div>
	</div>
	<div class="services-detail-banner" style="background-image:url('<?=$arResult['DETAIL_PICTURE']['SRC']?>');"></div>		
	<div class="container">
		<div class="row">
			<div class="col-md-12">
<?endif;?>

<!--DETAIL_TEXT-->
<?=$arResult["DETAIL_TEXT"];?>

<!--GALLERY_FILES_DOCS-->
<?$this->SetViewTarget("gallery_files_docs");?>

<div class="detail-blocks-wrapper">
<?if((is_array($arResult["DISPLAY_PROPERTIES"]["GALLERY"]["FILE_VALUE"]) && count($arResult["DISPLAY_PROPERTIES"]["GALLERY"]["FILE_VALUE"]) > 0) || (is_array($arResult["DISPLAY_PROPERTIES"]["FILES_DOCS"]["FILE_VALUE"]) && count($arResult["DISPLAY_PROPERTIES"]["FILES_DOCS"]["FILE_VALUE"]) > 0)):?>	
	<!--GALLERY-->
	<?if(is_array($arResult["DISPLAY_PROPERTIES"]["GALLERY"]["FILE_VALUE"]) && count($arResult["DISPLAY_PROPERTIES"]["GALLERY"]["FILE_VALUE"]) > 0):?>
		<div class="gallery-wrapper detail">			
			<div class="container">				
				<div class="row gallery<?=(!$arResult["DISPLAY_PROPERTIES"]["GALLERY_TITLE"] ? ' no_h1' : '');?>">
					<?if($arResult["DISPLAY_PROPERTIES"]["GALLERY_TITLE"]):?>
						<div class="col-md-12">
							<div class="h1"><?=$arResult["DISPLAY_PROPERTIES"]["GALLERY_TITLE"]["VALUE"];?></div>
						</div>
					<?endif;
					foreach($arResult["DISPLAY_PROPERTIES"]["GALLERY"]["FILE_VALUE"] as $key => $arFile):?>
						<div class="col-xs-6 col-sm-6 col-md-3">				
							<a class="gallery-item fancyimage" title="<?=$arFile['DESCRIPTION']?>" href="<?=$arFile['SRC']?>" data-fancybox-group="gallery">
								<span class="item-image"<?=(!empty($arFile['PREVIEW']) ? " style='background-image:url(".$arFile['PREVIEW'].");'" : "");?>></span>
								<?if(!empty($arFile["DESCRIPTION"])):?>
									<span class="item-caption-wrap">
										<span class="item-caption">
											<span class="item-title"><?=$arFile["DESCRIPTION"]?></span>
										</span>
									</span>
								<?endif;?>
							</a>
						</div>
					<?endforeach;?>
				</div>
			</div>
		</div>	
	<?endif;?>

	<!--FILES_DOCS-->
	<?if(is_array($arResult["DISPLAY_PROPERTIES"]["FILES_DOCS"]["FILE_VALUE"]) && count($arResult["DISPLAY_PROPERTIES"]["FILES_DOCS"]["FILE_VALUE"]) > 0):?>
		<div class="files-docs-wrapper">			
			<div class="container">
				<div class="row files-docs">
					<div class="col-md-12">
						<div class="h2"><?=$arResult["DISPLAY_PROPERTIES"]["FILES_DOCS"]["NAME"];?></div>
					</div>
					<?foreach($arResult["DISPLAY_PROPERTIES"]["FILES_DOCS"]["FILE_VALUE"] as $key => $arDoc):?><!--
						--><div class="col-sm-6 col-md-3">
							<a class="files-docs-item" href="<?=$arDoc['SRC']?>" target="_blank">
								<div class="item-icon">
									<?if($arDoc["FILE_TYPE"] == "doc" || $arDoc["FILE_TYPE"] == "docx" || $arDoc["FILE_TYPE"] == "rtf"):?>
										<i class="fa fa-file-word-o"></i>
									<?elseif($arDoc["FILE_TYPE"] == "xls" || $arDoc["FILE_TYPE"] == "xlsx"):?>
										<i class="fa fa-file-excel-o"></i>
									<?elseif($arDoc["FILE_TYPE"] == "pdf"):?>
										<i class="fa fa-file-pdf-o"></i>
									<?elseif($arDoc["FILE_TYPE"] == "rar" || $arDoc["FILE_TYPE"] == "zip" || $arDoc["FILE_TYPE"] == "gzip"):?>
										<i class="fa fa-file-archive-o"></i>
									<?elseif($arDoc["FILE_TYPE"] == "jpg" || $arDoc["FILE_TYPE"] == "jpeg" || $arDoc["FILE_TYPE"] == "png" || $arDoc["FILE_TYPE"] == "gif"):?>
										<i class="fa fa-file-image-o"></i>
									<?elseif($arDoc["FILE_TYPE"] == "ppt" || $arDoc["FILE_TYPE"] == "pptx"):?>
										<i class="fa fa-file-powerpoint-o"></i>
									<?elseif($arDoc["FILE_TYPE"] == "txt"):?>
										<i class="fa fa-file-text-o"></i>
									<?else:?>
										<i class="fa fa-file-o"></i>
									<?endif;?>
								</div>
								<div class="item-caption">
									<span class="item-name"><?=!empty($arDoc["DESCRIPTION"]) ? $arDoc["DESCRIPTION"] : $arDoc["FILE_NAME"]?></span>
									<span class="item-size"><?=GetMessage("SIZE").$arDoc["FILE_SIZE"]?></span>
								</div>
							</a>
						</div><!--
					--><?endforeach;?>
				</div>
			</div>
		</div>	
	<?endif;	
endif;

$this->EndViewTarget();?>