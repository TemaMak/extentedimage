<?php

class PluginExtentedimage_HookExtentedimage extends Hook {

    /*
     * Регистрация событий на хуки
     */
    public function RegisterHook() {
		$this->AddHook('module_topic_uploadtopicimagefile_after', 'createPrev');

    }

    public function createPrev($aParams) {
		$sPath = $aParams['result'];
		
		if($sPath && Config::Get('plugin.extentedimage.preview_width')){
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
				Config::Get('plugin.extentedimage.preview_width'),
				null,
				true
			);
		} 

		
		
    }
    

}
?>
