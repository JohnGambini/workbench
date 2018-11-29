<?php

define('ABSDIR', dirname(__FILE__));
require_once( ABSDIR . '\config\app_defs.php');

/* autoload composer installed packages */
require SUBSITE_DIR . '\\vendor\\autoload.php';

require WORKBENCH_DIR . '\\php\\workbenchLogin.php';

?>