<?php


/**
 * App::import('Lib', 'Permissions.Introspector');
 * $introspector = new Introspector();
 * 
 */
class Introspector extends Object {
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * 
	 */
	function get_controllers($include_plugins = false) {
		$controllers = $this->get_controller_list();
		
		if ($include_plugins) {
			$plugins = App::objects('plugin', null, false);
			foreach ($plugins as $plugin) {
				$controllers = $controllers + $this->get_controller_list($plugin);
			}
		}
		return $controllers;
	}
	
	/**
	 * Get a list of controllers in the app or from a plugin.
	 *
	 * Returns an array of path => import notation.
	 *
	 * @param string $plugin Name of plugin to get controllers for
	 * @return array
	 **/
	function get_controller_list($plugin = null) {
		if (!$plugin) {
			$controllers = App::objects('controller', null, false);
			
			// do not include App controller
			$appIndex = array_search('App', $controllers);
			if ($appIndex !== false) {
				unset($controllers[$appIndex]);
			}
		} else {
			$pluginPath = App::pluginPath($plugin);
			$controllers = App::objects('controller', $pluginPath . 'controllers' . DS, false);
			
			// do not include pluginApp controller
			$appIndex = array_search($plugin . 'App', $controllers);
			if ($appIndex !== false) {
				unset($controllers[$appIndex]);
			}
		}
		return $controllers;
	}
	
	
}