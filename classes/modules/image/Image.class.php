<?php

class PluginExtentedimage_ModuleImage extends PluginExtendimage_Inherit_ModuleImage{
	public function BuildHTML($sPath,$aParams){
		
		list($sEnableKey,$sWidthKey) = $this->Image_getPreviewConfigKey();
		if(Config::Get($sEnableKey) == true){
			$sPreviewPath = $this->Image_GetPreviewServerPath($sPath);
		} else{
			$sPreviewPath = $sPath;
		}
		
		$sText = '';
		
		$sText .= '<a href="'.$sPath.'"';
		$sText .=' class="clickable_img"';
		$sText .=' >';
		
		$sText .='<img src="'.$sPreviewPath.'" ';
		if (isset($aParams['title']) and $aParams['title']!='') {
			$sText.=' title="'.htmlspecialchars($aParams['title']).'" ';
			/**
			 * Если не определен ALT заполняем его тайтлом
			 */
			if(!isset($aParams['alt'])) $aParams['alt']=$aParams['title'];
		}
		if (isset($aParams['align']) and in_array($aParams['align'],array('left','right','center'))) {
			if ($aParams['align'] == 'center') {
				$sText.=' class="image-center"';
			} else {
				$sText.=' align="'.htmlspecialchars($aParams['align']).'" ';
			}
		}
		
		$sAlt = isset($aParams['alt'])
			? ' alt="'.htmlspecialchars($aParams['alt']).'"'
			: ' alt=""';
		$sText.=$sAlt.' />';

		$sText .='</a>';
		
		return $sText;
	}

	public function GetPreviewServerPath($sServerPath){
		$sFileName = basename($sServerPath);
		$sDir = dirname($sServerPath);
		
		$sPreviewFileName = $sDir.'/prev_'.$sFileName;
		
		return $sPreviewFileName;
	}
	
	public function getPreviewConfigKey(){
		if(isset($_REQUEST['sToLoad'])){
			if($_REQUEST['sToLoad'] == 'topic_text'){
				$sEnableKey = 'plugin.extentedimage.topic_preview_enable';
				$sWidthKey = 'plugin.extentedimage.topic_preview_width';			
			} else {
				$sEnableKey = 'plugin.extentedimage.comment_preview_enable';
				$sWidthKey = 'plugin.extentedimage.comment_preview_width';				
			}
		} else {
			$sEnableKey = 'plugin.extentedimage.topic_preview_enable';
			$sWidthKey = 'plugin.extentedimage.topic_preview_width';
		}
		
		return array($sEnableKey,$sWidthKey);
	}
	
}