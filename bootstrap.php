<?php
// define workflow root
if (!defined("WORKFLOW_ROOT")) { define("WORKFLOW_ROOT", "./"); }

include_once(WORKFLOW_ROOT . "libs/utils.php");
include_once(WORKFLOW_ROOT . "libs/workflows.php");

include_once(WORKFLOW_ROOT . "libs/Config.class.php");
include_once(WORKFLOW_ROOT . "libs/KSAPI.class.php");

loadClasses(WORKFLOW_ROOT . "libs");
