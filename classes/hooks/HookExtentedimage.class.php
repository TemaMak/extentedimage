<?php

class PluginExtentedimage_HookExtentedimage extends Hook {

    /*
     * Регистрация событий на хуки
     */
    public function RegisterHook() {
		$this->AddHook('module_topic_uploadtopicimagefile_after', 'createPrev');
		$this->AddHook('template_uploadimg_source', 'set_type_upload');
    }

    public function createPrev($aParams) {
		$sPath = $aParams['result'];
		
		list($sEnableKey,$sWidthKey) = $this->Image_getPreviewConfigKey();
		
		if($sPath && Config::Get($sEnableKey) && Config::Get($sWidthKey)){
			$sLocalPath = $this->Image_GetServerPath($sPath);
			$sPreviewPath = $this->Image_GetPreviewServerPath($sLocalPath);
			
			$sDirUpload = str_replace(Config::Get('path.root.server'),'',dirname($sPreviewPath)); 
			$sFileNameTmp = basename($sPreviewPath);
			list($sFileName,$sExtension) = explode('.',$sFileNameTmp);

			$this->Image_Resize(
				$sLocalPath,
				$sDirUpload,
				$sFileName,
				Config::Get('view.img_max_width'),
				Config::Get('view.img_max_height'),
				Config::Get($sWidthKey),
				null,
				true
			);
		} 

		
		
    }
    
	public function set_type_upload($aParams){
		return '<input type="hidden" id="sToLoad" name="sToLoad">';
	}
    
}
?>
