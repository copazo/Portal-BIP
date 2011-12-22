<?php
include(dirname(__FILE__).'../../../config/config.inc.php');
require_once("CategoryConfiguradorController.php");
$clase = new CategoryConfiguradorControllerCore(false,false);
$clase->run();
