<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';

$config = parse_ini_file("config.ini", true);

if (!array_key_exists("hosts", $config)) throw new Exception("Please configure the application before running");


// Load all the servers
$servers = array();
foreach ($config["hosts"] as $host => $port) {
	array_push($servers, MinecraftServerStatus\MinecraftServerStatus::query($host, $port));
}

// Get templates 
$loader = new Twig_Loader_Filesystem("templates");
$twig = new Twig_Environment($loader);

echo $twig->render("index.html", array("servers" => $servers));