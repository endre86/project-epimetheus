<?php
session_start(); // Start session

// Turn debug mode on / off
$debugMode = true;

if($debugMode)
{
	$time_start = microtime(true); // Start timing the application runtime
	ini_set('display_errors', 1); // Display errors
	ini_set('display_startup_errors', 1); // Display startup errors
}
else
{
	ini_set('display_errors', 0); // Don't display errors
	ini_set('display_startup_errors', 0); // Don't display startup errors
}

include_once 'pagesettings.php'; // Include page settings 
include_once 'router.php'; // Include bootstrap, where the magic begins

if($debugMode): // Lets show some extra information about resource use when in debug mode
	?>
	<?php $time_end = microtime(true); // Stop timing application runtime 
	include_once 'includes/misc/echoArrayTree.php'; // Include function to echo array trees
	?>
	<pre>
	<div style="background:#66FF33;color:black;">
	<b>Debug mode is on!</b>
	Page rendered in <?php echo ($time_end - $time_start); ?> seconds
	Memory (in) use: <?php echo memory_get_usage() / 1000 ?> kb (at end of execution)

	<u>$_SESSION variables in use:</u>
	<?php if(isset($_SESSION)):?>
	<?php echoArrayTree($_SESSION, 1); ?>
	<?php endif; ?>
	
	<u>$_POST variables in use:</u>
	<?php if(isset($_POST)):?>
	<?php echoArrayTree($_POST, 1); ?>
	<?php endif; ?>
	
	<u>$_COOKIE variables in use:</u>
	<?php if(isset($_COOKIE)):?>
	<?php echoArrayTree($_COOKIE, 1); ?>
	<?php endif; ?>
	
	<u>Different access levels</u> <?php echoArrayTree(User::$accesslvls, 1); ?>
	
	<u>Variables in $PAGE</u> <?php echoArrayTree($PAGE, 1); ?>

	-------------------------------------------------------
	<i>(Debug information rendered in index.php)</i>
	</pre>
	
<?php
endif;