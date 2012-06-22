<?php

class lib {

	// we'll add common and audit to the basic controller


    public function log(){
    	
    	$common = new common();
    	
        $elements = array();
        $elements['u'] = $common->getPageURL();
        $elements['i'] = $common->getIpAddress();
        if(isset($_SERVER['HTTP_USER_AGENT'])){
            $elements['b'] = $_SERVER['HTTP_USER_AGENT'];    
        }
        $elements['c'] = new DateTime('now');
        $sId = session_id();
        if(!empty($sId)){
            $elements['s'] = $sId;
        }
        $current_user = current_user();
        if(isset($current_user)){
            $elements['p'] = $current_user;            
        }
        # TODO: Replace this insert for a Redis insert
        # we don't want to overload Mongo because the Audit
		// Db::insert('audit',  $elements);
			
    }

        # Access to GET/POST/COOKIE parameters the easy way
    private function g($param) {
        global $_GET, $_POST, $_COOKIE;

        if (isset($_COOKIE[$param])){
            if(is_array($_COOKIE[$param])) {
                return implode(",", $_COOKIE[$param]);
            }
            return $_COOKIE[$param];
        }
        if (isset($_POST[$param])) {
            if(is_array($_POST[$param])) {
                return implode(",", $_POST[$param]);
            }
            return $_POST[$param];
        }
        if (isset($_GET[$param])) return $_GET[$param];
        return false;
    }

    public function gt($param) {
        $val = $this->g($param);
        if ($val === false) return false;
        return trim($val);
    }

    public function utf8entities($s) {
        return htmlentities($s,ENT_COMPAT,'UTF-8');
    }

    public function getParameter($name, $default = false, $from = false) {
        if ($from === false) $from = $_REQUEST;
        reset($from);
        while (list($key, $value) = each($from)) {
            if (strcasecmp($key, $name) == 0) return $value;
        }
        return $default;
    }


    protected function root() {
        return dirname(__FILE__);
    }

    protected function setRedirect(){
        $_SESSION['redirect_to'] = $_SERVER["REQUEST_URI"];
    }
    protected function render($file_name, $variables_array = null) {
    	$this->log();
        
        if($variables_array)
            extract($variables_array);
        require($this->root() . '/../../public/views/' . $file_name . '.php');
    }

     public function handleError($number, $message, $file, $line) {
        header("HTTP/1.0 500 Server Error");
        echo $this->render('500', compact('number', 'message', 'file', 'line'));
        die();
    }

    public function show404() {
        header("HTTP/1.0 404 Not Found");
        echo $this->render('404');
        die();
    }

}