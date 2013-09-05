#!/usr/bin/env php
<?php
class Log{
	public static function error($m){
		fprintf(STDERR, $m.PHP_EOL);
	}
	public static function info($m){
		fprintf(STDOUT, $m.PHP_EOL);
	}
}

// Expected files and directories for Kohana 3 framework 
$rfiles = array(
	'index.php',
	'application',
	'application/bootstrap.php',
	'application/classes',
	'application/classes/controller',
	'application/classes/model',
	'application/views',
	'application/logs',
	'application/messages',
	'application/config'
);

// Check requried files and directories
foreach($rfiles as $file){
	if(!file_exists($file)){
		Log::error("Not in a valid kohana 3 directory");
		exit(1);
	}
}

if($argc<2){
	Log::error("Command not provided");
	Log::info("Valid commands are:");
	Log::info("generate, help and test");
	exit(1);
}

function autoloader($class) {
	
    $fname = dirname(__FILE__).'/commands/' . $class . '.php';
	if(file_exists($fname)){
		include $fname;
		return true;
	}else{
		return false;
	}
}
spl_autoload_register('autoloader');


// Get the main command name and its parameters
$command = $argv[1];
$params = array_slice($argv,2);

// determine class name
$classname = "ko3_".$command;

// find the class and run it
if(class_exists($classname)){
	$obj = new $classname;
	$obj->run($params);
}else{
	Log::error("'$command' not implemented.");
}
