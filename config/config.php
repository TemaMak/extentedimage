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

$config['topic_preview_width'] = 300;
$config['comment_preview_width'] = 100;

$config['topic_preview_enable'] = true;
$config['comment_preview_enable'] = true;

/*
 * Проверка размера изображения перед созданием превью.
 * true - если реальная ширина изображения меньше ширины для превью, то превью не создается
 * false - необходимость создания превью определяется флагами  *_enable
 */
$config['check_image_width_for_resize'] = true;

/*
 * Проверка необходимости генерировать html-код для popup'а с полноразмерным изображением 
 * true - код генерируется только если был создан файл превью 
 * false - код генерируется всегда
 */
$config['check_image_width_for_popup'] = true;

return $config;
?>