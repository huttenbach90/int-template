<?php

// Bylo by vhodne presunout nekam jinam
Class IMT_Helper_Http
{

	/**
	 * @param $url string
	 * @param string $httpAuthData Pro pripadnou HTTP autentizaci na cili. Ve formatu username:password.
	 * @param array $cookies
	 * @param array $postFields array containt data to POST
	 * @param bool $ssl - Bude dotazovana SSL verze stranky?
	 * @param bool $followRedirects - Nasledovat hlavicku Location?
	 * @return array
	 */
	public function makeRequest($url, $httpAuthData = '', $cookies = [], $postFields = [], $ssl = false, $followRedirects = false)
	{
		$options = [
			CURLOPT_RETURNTRANSFER => true,     	 	// return web page
			CURLOPT_HEADER => false,                 	// don't return headers
			CURLOPT_FOLLOWLOCATION => $followRedirects, // follow redirects
			CURLOPT_ENCODING => "",                  	// handle all encodings
			CURLOPT_USERAGENT => "allstar.cz",  		// who am i
			CURLOPT_AUTOREFERER => true,         		// set referer on redirect
			CURLOPT_CONNECTTIMEOUT => 120,       		// timeout on connect
			CURLOPT_TIMEOUT => 120,                  	// timeout on response
			CURLOPT_MAXREDIRS => 10,                 	// stop after 10 redirects

		];

		if (!empty($postFields)) {
			$options[CURLOPT_POSTFIELDS] = http_build_query($postFields);
		}

		if ($ssl) {
			$options[CURLOPT_SSL_VERIFYPEER] = false;// Disabled SSL Cert checks
			$options[CURLOPT_SSL_VERIFYHOST] = false;
		}

		if (!empty($cookies)) {
			$options[CURLOPT_HTTPHEADER] = $cookies;
		}


		if (!empty($httpAuth)) {
			$options[CURLOPT_USERPWD] = $httpAuthData;
		}

		$ch = curl_init($url);
		curl_setopt_array($ch, $options);


		$out = [
			'content' => curl_exec($ch),
			'error' => curl_errno($ch),
			'errmsg' => curl_error($ch),
			'header' => curl_getinfo($ch)
		];

		curl_close($ch);
		return $out;
	}

}
?>