<?php
class PermissionsController extends PermissionsAppController {
	var $name = 'Permissions';
	
	function admin_index() {
		App::import('Lib', 'Permissions.Introspector');
		$introspector = new Introspector();
		
		$controllers = $introspector->get_controllers();
		debug($controllers);
	}
}
?>