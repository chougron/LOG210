<?php

/**
 * Root of the project
 */
define("ROOT", realpath(__dir__."/.."));

require_once (ROOT. '/app/component/Kernel.php');

App\Component\Kernel::run();