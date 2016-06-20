<?php

$json = false;
$error = true;

$name = trim(strtolower($_GET['name']));
system("C:\wamp\www\Skype4ComUserProfile.exe " . escapeshellarg($name), $return);

if($return != 0)
{
	if($json && $error)
	{
		echo json_encode(array('status' => 'error', 'error' => 'An error occured, please try again later.'));
	}
	else
	{
		// do nothing?
		if($error)
		{	
			echo 'An error occured, please try again later.';
		}
	}
	
	die();
}

sleep(1.5); // time it can take Skype to find a user profile and log it. If this doesn't seem to work or you have a slow connection, increase this as necessary.

$name = str_replace(".", "\.", $name);
$name = str_replace("'", "\'", $name);
$name = str_replace("_", "\_", $name);

$glob = glob('skype/debug-*.log'); $log = array_pop($glob);
$contents = file_get_contents($log);

if(preg_match('/' . $name . '.*?-r(\d+\.\d+\.\d+\.\d+)/', $contents, $results))
{
	if($json)
	{
		echo json_encode(array('status' => 'success', 'success' => $results[1]));
	}
	else
	{
		echo $results[1];
	}
}
else
{
	if($json)
	{
		echo json_encode(array('status' => 'error', 'error' => 'Either that username was not found, or an error occured.'));
	}
	else
	{
		// do nothing?
		if($error)
		{	
			echo 'An error occured, please try again later.';
		}
	}
}

?>