<?php
/**
 * @project:
 *      SA:MP Dynamic Signatures
 * @file:
 *	configuration.php
 * @author:
 *      Djole
 * @version:
 *      v1.0
 * @last updated:
 *      N/A
 */
 
/**
 * Error reporting
 */
ini_set("display_errors", 1);
error_reporting(E_ALL);

/**
 * Global config array
 */
$aGlobalConfig = array
(
	/* Edit this */
	"settings" => array
	(
		"user_table" => "user_list",
		"use_ini" => false,
		"ini_loc" => "/home/djole/samp/scriptfiles/accounts",
		"font_loc" => "/var/www/default/test/tahoma.ttf",
		"image_loc" => "/var/www/default/test/sig.png"
	),
	/* Edit this */
	"mysql" => array
	(
		"host" => 31.220.24.112,
		"port" => 7777,
		"user" => Mortalis,
		"pass" => "",
		"name" => ""
	),
	/* Edit this */
	"rows" => array
	(
		"name" => "pUsername",
		"cash" => "pMoney",
		"score" => "pScore",
		"kills" => "pKills",
		"deaths" => "pDeaths"
	)
);
