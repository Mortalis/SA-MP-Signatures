<?php
/**
 * @project:
 *      SA:MP Dynamic Signatures
 * @file:
 *		signature.php
 * @author:
 *      Djole
 * @version:
 *      v1.0
 * @last updated:
 *      N/A
 */
 
include "config/configuration.php";
include "includes/database.php";

if (!$aGlobalConfig["settings"]["use_ini"])
{
	try
	{
		$iQuery = DB::getInstance();
	}
	catch (Exception $sException)
	{
		die($sException->getMessage());
	}
	
	if (isset($_GET["name"]) && $_GET["name"])
	{
		$iResult = $iQuery->prepare("SELECT `{$aGlobalConfig["rows"]["name"]}`, `{$aGlobalConfig["rows"]["cash"]}`, `{$aGlobalConfig["rows"]["score"]}`, `{$aGlobalConfig["rows"]["kills"]}`, `{$aGlobalConfig["rows"]["deaths"]}` FROM `{$aGlobalConfig["settings"]["user_table"]}` WHERE `{$aGlobalConfig["rows"]["name"]}` = ? LIMIT 0, 1;");
		if ($iResult->execute(array($_GET["name"])))
		{
			$aReturn = $iResult->fetchAll();
			
			if (count($aReturn) && $aReturn)
			{	
				if ($iImage = @imagecreatefrompng($aGlobalConfig["settings"]["image_loc"]))
				{
					header("Content-Type: image/png");
					flush();

					imagettftext($iImage, 15, 0, 31, 22, imagecolorallocate($iImage, 134, 144, 209), $aGlobalConfig["settings"]["font_loc"], "Username: ".$aReturn[0][$aGlobalConfig["rows"]["name"]]);
					imagettftext($iImage, 10, 0, 23, 70, imagecolorallocate($iImage, 0, 0, 0), $aGlobalConfig["settings"]["font_loc"], "Money: $".$aReturn[0][$aGlobalConfig["rows"]["cash"]]);
					imagettftext($iImage, 10, 0, 23, 80, imagecolorallocate($iImage, 0, 0, 0), $aGlobalConfig["settings"]["font_loc"], "Score: ".$aReturn[0][$aGlobalConfig["rows"]["score"]]);
					imagettftext($iImage, 10, 0, 23, 90, imagecolorallocate($iImage, 0, 0, 0), $aGlobalConfig["settings"]["font_loc"], "Kills: ".$aReturn[0][$aGlobalConfig["rows"]["kills"]]);
					imagettftext($iImage, 10, 0, 23, 100, imagecolorallocate($iImage, 0, 0, 0), $aGlobalConfig["settings"]["font_loc"], "Deaths: ".$aReturn[0][$aGlobalConfig["rows"]["deaths"]]);

					imagepng($iImage);
					imagedestroy($iImage);
				}
				else
				{
					echo "Oops! Failed to create image.".PHP_EOL;
				}
			}
			else
			{
				echo "No results found!".PHP_EOL;
			}
		}
		else
		{
			echo "Oops! Something went wrong...".PHP_EOL;
		}
	}
	else
	{
		echo "Please provide a valid username!".PHP_EOL;
	}
	
	unset($oReturn, $iResult, $iQuery);
}
else
{
	if (isset($_GET["name"]) && $_GET["name"])
	{
		$sFile = "{$aGlobalConfig["settings"]["ini_loc"]}/{$_GET["name"]}.ini";
		
		if (file_exists($sFile))
		{
			if ($aReturn = parse_ini_file($sFile))
			{
				if ($iImage = @imagecreatefrompng($aGlobalConfig["settings"]["image_loc"]))
				{
					header("Content-Type: image/png");
					flush();
					
					imagettftext($iImage, 15, 0, 31, 22, imagecolorallocate($iImage, 134, 144, 209), $aGlobalConfig["settings"]["font_loc"], "Username: ".$aReturn[$aGlobalConfig["rows"]["name"]]);
					imagettftext($iImage, 10, 0, 23, 70, imagecolorallocate($iImage, 0, 0, 0), $aGlobalConfig["settings"]["font_loc"], "Money: $".$aReturn[$aGlobalConfig["rows"]["cash"]]);
					imagettftext($iImage, 10, 0, 23, 80, imagecolorallocate($iImage, 0, 0, 0), $aGlobalConfig["settings"]["font_loc"], "Score: ".$aReturn[$aGlobalConfig["rows"]["score"]]);
					imagettftext($iImage, 10, 0, 23, 90, imagecolorallocate($iImage, 0, 0, 0), $aGlobalConfig["settings"]["font_loc"], "Kills: ".$aReturn[$aGlobalConfig["rows"]["kills"]]);
					imagettftext($iImage, 10, 0, 23, 100, imagecolorallocate($iImage, 0, 0, 0), $aGlobalConfig["settings"]["font_loc"], "Deaths: ".$aReturn[$aGlobalConfig["rows"]["deaths"]]);
					
					imagepng($iImage);
					imagedestroy($iImage);
				}
				else
				{
					echo "Oops! Failed to create image.".PHP_EOL;
				}
			}
			else
			{
				echo "Oops! Something went wrong...".PHP_EOL;
			}
		}
		else
		{
			echo "No results found!".PHP_EOL;
		}
	}
	else
	{
		echo "Please provide a valid username!".PHP_EOL;
	}
	
	unset($aReturn, $sFile, $_GET["name"]);
}