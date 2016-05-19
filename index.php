<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';

$config = parse_ini_file("config.ini", true);

$required_config = array("hosts", "info");
foreach($required_config as $key) {
	if (!array_key_exists($key, $config)) throw new Exception("Please configure the application before running");
}

function loadServers($hosts) {
	$servers = array();
	foreach ($hosts as $host => $ports) {
		//Check if a list of ports (rather than a single port)
		if (is_array($ports)) {
			foreach($ports as $port) {
				$servers[$host . ":" . $port] = MinecraftServerStatus\MinecraftServerStatus::query($host, intval($port));
			}
		} else {
			$servers[$host . ":" . $ports] = MinecraftServerStatus\MinecraftServerStatus::query($host, intval($ports));
		}
	}
	return $servers;	
}

// Load in an array of MinecraftServerStatus objects
$servers = loadServers($config["hosts"]);

// Get templates 
$loader = new Twig_Loader_Filesystem("templates");
$twig = new Twig_Environment($loader);

echo $twig->render("index.html", array("info" => $config["info"], "servers" => $servers));