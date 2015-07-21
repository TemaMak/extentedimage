<?php
/*-------------------------------------------------------
*
*   LiveStreet Engine Social Networking
*   Copyright © 2008 Mzhelskiy Maxim
*
*--------------------------------------------------------
*
*   Official site: www.livestreet.ru
*   Contact e-mail: rus.engine@gmail.com
*
*   GNU General Public License, version 2:
*   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*
---------------------------------------------------------
*/

/*
 * Добавляем необходимые параметры в конфиг jevixы
 */
$acfgAllowTagParams = Config::Get('jevix.default.cfgAllowTagParams');
foreach($acfgAllowTagParams as $sKey => $aItem){
	if($aItem[0] == 'a'){
		$acfgAllowTagParams[$sKey][1] = array_merge(
			$aItem[1],
			array('target' => array('_blank'), 'class'=> array('clickable_img'))
		);
	}
}
Config::Set('jevix.default.cfgAllowTagParams',$acfgAllowTagParams);

$config=array();

$config['preview_width'] = 600;
return $config;
?>