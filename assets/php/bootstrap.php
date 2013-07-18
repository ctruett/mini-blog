<?php

	 /**
	 * A bootstrap for the Dropbox SDK usage examples
	 * @link https://github.com/BenTheDesigner/Dropbox/tree/master/examples
	 */

	 // Prevent access via command line interface
	 if (PHP_SAPI === 'cli') {
			exit('bootstrap.php must not be run via the command line interface');
	 }

	 // Don't allow direct access to the bootstrap
	 if(basename($_SERVER['REQUEST_URI']) == 'bootstrap.php'){
			exit('bootstrap.php does nothing on its own. Please see the examples provided');
	 }

	 // Set error reporting
	 error_reporting(-1);
	 ini_set('display_errors', 'On');
	 ini_set('html_errors', 'On');

	 // Register a simple autoload function
	 spl_autoload_register(function($class){
			$class = str_replace('\\', '/', $class);
			require_once('/' . $class . '.php');
	 });

	 // Set your consumer key, secret and callback URL
	 $key    = 'tih2eb9r52hbdfk';
	 $secret = 'jbu74eo1k5h251o';

	 // Check whether to use HTTPS and set the callback URL
	 $protocol = (!empty($_SERVER['HTTPS'])) ? 'https' : 'http';
	 // $callback = $protocol . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	 $callback = $protocol . '://' . $_SERVER['HTTP_HOST']."/update.php";

	 // Instantiate the Encrypter and storage objects
	 $encrypter = new \Dropbox\OAuth\Storage\Encrypter('ab37298c7293df73273491f627dd8c73');

	 // User ID assigned by your auth system (used by persistent storage handlers)
	 $userID = 1;

	 // Create the storage object, passing it the Encrypter object
	 $storage = new \Dropbox\OAuth\Storage\Session($encrypter);


	 // Create the consumer and API objects
	 $OAuth = new \Dropbox\OAuth\Consumer\Curl($key, $secret, $storage, $callback);
	 $dropbox = new \Dropbox\API($OAuth);

?>
