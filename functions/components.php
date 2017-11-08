<?php
function import ($componentPath) {
	if ($componentPath[0] !== '/') $componentPath = '/' . $componentPath;
	include_once(get_template_directory() . $componentPath);
}
