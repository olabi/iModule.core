<?php
REQUIRE_ONCE str_replace(DIRECTORY_SEPARATOR.'scripts'.DIRECTORY_SEPARATOR.'php2js.js.php','',$_SERVER['SCRIPT_FILENAME']).'/configs/init.config.php';
header('Content-Type: application/x-javascript; charset=utf-8');

$menu = Request('menu');
$page = Request('page');
$view = Request('view');
$IM = new iModule();
?>
var ENV = {
	DIR:"<?php echo __IM_DIR__; ?>",
	VERSION:"<?php echo __IM_VERSION__; ?>",
	LANGUAGE:"<?php echo $IM->language; ?>",
	MENU:<?php echo $menu ? '"'.$menu.'"' : 'null'; ?>,
	PAGE:<?php echo $page ? '"'.$page.'"' : 'null'; ?>,
	VIEW:<?php echo $view ? '"'.$view.'"' : 'null'; ?>,
	getProcessUrl:function(module,action) {
		return ENV.DIR+"/"+ENV.LANGUAGE+"/process/"+module+"/"+action;
	},
	getApiUrl:function(module,api) {
		return ENV.DIR+"/api/"+module+"/"+api;
	},
	getModuleUrl:function(module,container,idx,isFullUrl,domain,language) {
		var container = container ? container : null;
		var idx = idx ? idx : null;
		var isFullUrl = isFullUrl === true;
		var domain = domain ? domain : null;
		var language = language ? language : ENV.LANGUAGE;
		
		var url = "";
		if (isFullUrl == true || domain !== null) {
			url+= domain ? domain : location.protocol+"//"+location.host;
		}
		url+= ENV.DIR;
		
		url+= "/"+language+"/module/"+module;
		if (container != null) url+= "/"+container;
		if (idx != null) url+= "/"+idx;
		
		return url;
	},
	getUrl:function(menu,page,view,number) {
		var menu = menu === undefined ? null : menu;
		var page = page === undefined ? null : page;
		var view = view === undefined ? null : view;
		var number = number === undefined ? null : number;
		
		menu = menu === null ? ENV.MENU : menu;
		page = page === null && menu == ENV.MENU ? ENV.PAGE : page;
		view = view === null && menu == ENV.MENU && page == ENV.PAGE ? ENV.VIEW : view;
		
		var url = ENV.DIR;
		url+= "/" + ENV.LANGUAGE;
		if (menu === null || menu === false) return url;
		url+= "/" + menu;
		if (page === null || page === false) return url;
		url+= "/" + page;
		if (view === null || view === false) return url;
		url+= "/" + view;
		if (number === null || number === false) return url;
		url+= "/" + number;
		
		return url;
	}
};