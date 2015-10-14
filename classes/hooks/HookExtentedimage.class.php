<?php

class PluginExtentedimage_HookExtentedimage extends Hook {

    /*
     * Регистрация событий на хуки
     */
    public function RegisterHook() {
    	$this->AddHook('module_topic_uploadtopicimagefile_before', 'copyUploadFile');
		$this->AddHook('module_topic_uploadtopicimagefile_after', 'createPrev');
		$this->AddHook('template_uploadimg_source', 'set_type_upload');
    }

    public function copyUploadFile(){
 		$sFileTmp=Config::Get('sys.cache.dir').func_generator();
		copy($_FILES['img_file']['tmp_name'],$sFileTmp); 
		$_SESSION['tmp_upload_file']  = $sFileTmp;	
    }
    
    public function createPrev($aParams) {
		$sPath = $aParams['result'];
		
		list($sEnableKey,$sWidthKey) = $this->Image_getPreviewConfigKey();
		
		//$oImage->get_image_params('width')
		$sFileTmp = $_SESSION['tmp_upload_file'];
		$bNeedResize = $this->Image_isNeedResize($sFileTmp);
		echo $bNeedResize;
		if($sPath && $bNeedResize){						
			$sLocalPath = $this->Image_GetServerPath($sPath);
			$sPreviewPath = $this->Image_GetPreviewServerPath($sLocalPath);
			
			$sDirUpload = str_replace(Config::Get('path.root.server'),'',dirname($sPreviewPath)); 
			$sFileNameTmp = basename($sPreviewPath);
			list($sFileName,$sExtension) = explode('.',$sFileNameTmp);

			$aImageParams=$this->Image_BuildParams('topic');
			$this->Image_Resize(
				$sFileTmp,
				$sDirUpload,
				$sFileName,
				Config::Get('view.img_max_width'),
				Config::Get('view.img_max_height'),
				Config::Get($sWidthKey),
				null,
				true,
				$aImageParams
			);
			
			@unlink($sFileTmp);
		} 

		
		
    }
    
	public function set_type_upload($aParams){
		return '<input type="hidden" id="sToLoad" name="sToLoad">';
	}
    
}
?>
