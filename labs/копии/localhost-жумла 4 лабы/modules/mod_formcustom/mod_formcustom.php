<?php
defined("_JEXEC") or die();

//require_once __DIR__.'/helper.php';

$class_sfx = htmlspecialchars($params->get('class_sfx'));

require JModuleHelper::getLayoutPath('mod_formcustom', $params->get('layout', 'default'));
?>