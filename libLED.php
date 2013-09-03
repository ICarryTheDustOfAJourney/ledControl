<?php
/*
	PHP lib to control a WiFi RGB LED controller
	as available from applamp.nl

	V 1.0 03.09.2013 initial release

	Copyright 2013 by Volker Kinkelin, grundguetiger at gmail dot com

	You can do with the source whatever you like if you keep 
	the copyright notice.

	Call examples:
	
		LED::exec( 'hue', 0...255);
		LED::exec( 'on' );
		LED::exec( 'off' );
		LED::exec( 'brightup' );
		LED::exec( 'brightdown' );
		LED::exec( 'speedup' );
		LED::exec( 'speeddown' );
		LED::exec( 'effectup' );
		LED::exec( 'effectdown' );

	You might need to adapt the WiFi Box' IP-address
	and/or port number to make it work.
	
*/

class LED {

	// change address and port number below to match your WiFi configuration:

	public static $ip_address = '192.168.1.100'; // can be 'a.b.c.d' or a dhcp name, if supported by the network
	public static $port_no = '50000'; // usually 50000 unless otherwise configured on the WiFi controller

	// command definitions
	public static function getCommandArr( $cmd, $arg = '' ) {

		switch( strtolower( $cmd ) ) {

			case 'hue':

				return pack( 'CCC', 0x20, $arg, 0x55 );
				break;

			case 'off':

				return pack( 'H*','210055' );
				break;

			case 'on':

				return pack( 'H*','220055' );
				break;

			case 'brightup':

				return pack( 'H*','230055' );
				break;

			case 'brightdown':

				return pack( 'H*','240055' );
				break;

			case 'speedup':

				return pack( 'H*','250055' );
				break;

			case 'speeddown':

				return pack( 'H*','260055' );
				break;

			case 'effectup':

				return pack( 'H*','270055' );
				break;

			case 'effectdown':

				return pack( 'H*','280055' );
				break;

		} // switch( $cmd ) {

	} // public static function command( $cmd, $arg = '') {

	// send command to wifibox
	public static function exec( $cmd, $arg = '' ) {
		
		$socket = @fsockopen( 'udp://' . self::$ip_address . ':' . self::$port_no );

		$commandArr = self::getCommandArr( $cmd, $arg );
		@fputs( $socket, $commandArr, 3 );

		fclose( $socket );

	}

} // class LED {
?>
