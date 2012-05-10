<?php


	
class common {
		
		
		/**
		 *	Sets a cookie in the client's browser
		 * @param string $name Cookie name
		 * @param variant $value Cookie value. Can be none
		 * @param integer $expires The time at which the cookie expires, in days. If no one is provided, cookie expires at the end of the session
		 * @param string $path The path on the server in which the cookie will be available (false -> current directory, '/' -> entire domain)
		 * @param string $domain The domain that the cookie is available (Important with subdomains!)
		 * @param boolean $secure If true, cookie will be only be transmitted over a secure HTTPS connection
		 * @return boolean True if sent, false otherwise
		 */
		public function setBrowserCookie($name,$value = false,$expires = 0,$path = "/",$domain = false,$secure = false) {
			if (!$name) return false;

			$time = ($expires) ? time()+60*60*24*$expires : false;

			return setcookie($name, $value, $time, $path, $domain, $secure);
		}

		public function getIpAddress() {
			$ipHeads = array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR');
		    foreach ( $ipHeads as $key) {
		        if (array_key_exists($key, $_SERVER) === true) {
		            foreach (explode(',', $_SERVER[$key]) as $ip) {
		                if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
		                    return $ip;
		                }
		            }
		        }
		    }
		}


	function formatCss($css){
		$css = str_replace('{', '{'.chr(13).chr(9), $css);
		return str_replace(';', ';'.chr(13).chr(9), $css);
		
	}
	function cleanCss($css){		
		$css = str_replace(chr(9), '', $css);
		$css = str_replace(chr(10), '', $css);
		$css = str_replace(chr(13), '', $css);
		return $css;
	}
	
	function getPageURL() {
		$pageURL = 'http';
		if(isset($_SERVER["HTTPS"])){
			if ($_SERVER["HTTPS"] == "on") {
				 $pageURL .= "s";
			}		 
		}
		$pageURL .= "://";

		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}

}