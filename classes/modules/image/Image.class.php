<?php

class PluginExtentedimage_ModuleImage extends PluginExtendimage_Inherit_ModuleImage
{
	public function BuildHTML($sPath,$aParams){
		
		$sText = '';
		
		$sText .= '<a href="'.$sPath.'"';
		$sText .=' class="clickable_img"';
		$sText .=' >';
		
		$sText .='<img src="'.$sPath.'" ';
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
}