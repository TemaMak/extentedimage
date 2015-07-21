<?php


/**
 * Запрещаем напрямую через браузер обращение к этому файлу.
 */
if (!class_exists('Plugin')) {
	die('Hacking attempt!');
}

class PluginExtentedimage extends Plugin {

    public $aInherits = array(
        'module' => array(
            'ModuleImage' => '_ModuleImage',
        ),
    );
	
	public function Activate() {
		return true;
	}

	/**
	 * Инициализация плагина
	 */
	public function Init() {

		$this->Viewer_AppendScript(
    		Plugin::GetTemplatePath(__CLASS__).'/js/script.js'
    	);
    	$this->Viewer_AppendStyle(
    		Plugin::GetTemplatePath(__CLASS__)."/css/jquery.fancybox.css"
    	);
    	$this->Viewer_AppendScript(
    		Plugin::GetTemplatePath(__CLASS__).'/js/jquery.fancybox.pack.js'
    	);
    	
    	
	}
}
?>