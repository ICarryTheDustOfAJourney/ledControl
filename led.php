<?php
/*
	HTTP webservice interface to libLED to control a 
	WiFi Box RGB LED controller via PHP 
	as available from applamp.nl

	V 1.0 03.09.2013 initial release

	Copyright 2013 by Volker Kinkelin, grundguetiger at gmail dot com

	You can do with the source whatever you like if you keep 
	the copyright notice.

	Installation: drop this file together with libLED.php into 
	a directory	and call it like:

	change color:
	
	led.php?hue=123 (can be 0...255 (=blue))

	change state:
	
 	led.php?cmd=on
	led.php?cmd=off
	led.php?cmd=off
	led.php?cmd=brightup
	led.php?cmd=brightdown
	led.php?cmd=speedup
	led.php?cmd=speeddown
	led.php?cmd=effectup
	led.php?cmd=effectdown

	index.html is a demo user interface example
	to play with
*/

// load the libraray
include 'libLED.php';

	// parse request and call lib accordingly
	
	// ip-address specified?	
	if( isset( $_REQUEST['ip']) )  
		LED::$ip_address = substr($_REQUEST['ip'], -20);

	// port number specified?	
	if( isset( $_REQUEST['port']) )
		LED::$port_no = (int)$_REQUEST['port'];

	// command requested?
	if( isset( $_REQUEST['cmd']) )
		LED::exec( $_REQUEST['cmd'] );

	// color change requested?
	// hue=0...255 (0 = 255 = blue, 85 = green, 18 = red)
	if( isset( $_REQUEST['hue']) )
		LED::exec( 'hue', (int)($_REQUEST['hue']) % 256);

?>
