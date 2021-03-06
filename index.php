<?php
/**
 * ███████╗██╗   ██╗ ██████╗ ██╗    ██╗   ██╗███████╗
 * ██╔════╝██║   ██║██╔═══██╗██║    ██║   ██║██╔════╝
 * █████╗  ██║   ██║██║   ██║██║    ██║   ██║█████╗
 * ██╔══╝  ╚██╗ ██╔╝██║   ██║██║    ╚██╗ ██╔╝██╔══╝
 * ███████╗ ╚████╔╝ ╚██████╔╝███████╗╚████╔╝ ███████╗
 * ╚══════╝  ╚═══╝   ╚═════╝ ╚══════╝ ╚═══╝  ╚══════╝
 *
 * Evolve Framework
 * Copyright (c) Vojtěch Hutla, Marian Abaffy
 *
 * Licensed under MIT
 * evolve.github.io
 */

/* Only in dev versions */
error_reporting(E_ALL);
ini_set('display_errors', 1);
/* ==================== */

/* Start time counter */
$start_time = microtime(true);

/* Load application */
include('framework/evolve.php');
include('app/loader.php');

/* Stop time counter */
$timer = microtime(true)-$start_time;
$timer = round($timer, 10);

$api = new API();
$api->status('ok');
$api->response('hello_world','Hello world!');
$api->execute();

/* Initialite development features */
//echo 'Done in '.round($timer,4).' seconds';
