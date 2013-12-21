<?php
/**
 * @project:
 *      SA:MP Dynamic Signatures
 * @file:
 *	database.php
 * @author:
 *      Djole
 * @version:
 *      v1.0
 * @last updated:
 *      N/A
 */

class DB extends PDO
{
	protected static
		$iInstance = NULL;
	
	public static function getInstance()
	{
		if (self::$iInstance === NULL)
		{
			global
				$aGlobalConfig;

			self::$iInstance = new DB
			(
				"mysql:host={$aGlobalConfig["mysql"]["host"]};port={$aGlobalConfig["mysql"]["port"]};dbname={$aGlobalConfig["mysql"]["name"]};",
				$aGlobalConfig["mysql"]["user"],
				$aGlobalConfig["mysql"]["pass"]
			);
		}
		return self::$iInstance;
	}
}
