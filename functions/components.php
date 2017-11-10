<?php
function import ($componentPath) {
	if (!preg_match('/^\//i', $componentPath)) $componentPath = '/' . $componentPath;
	if (!preg_match('/.php$/i', $componentPath)) $componentPath .= '.php';
	include_once(get_template_directory() . $componentPath);
}
