<?php

/**
* This is a simple library for tracking metrics with Yardstick.
*/

class Yardstick {

	private $api_key;
	private $options;

	function __construct($key, $options = {})
	{
		$this->api_key = $key;
		$this->options = $options;
	}

	function track($evnt, $tracker = '')
	{
		$headers = array(
			'Accept: application/json',
			'Content-Type: application/json',
			'X-Yardstick-Token: '.$this->api_key
		);

		$ch = curl_init('http://api.yardstick.it/metric/'.$tracker);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_USERAGENT, 'yardstick/0.0.1 (YardstickPHP)');
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($evnt));

		$return = curl_exec($ch);
		$curl_error = curl_error($ch);
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		curl_close($ch);

		// Check to ensure success
		if($http_code !== 200)
			return false;
		else
			return true;
	}
}

?>