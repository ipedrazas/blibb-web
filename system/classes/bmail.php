<?php

include_once __DIR__."/../../lib/Swift/swift_required.php";


class BMail{

	function valid_dot_pos($email) { 
	    $str_len = strlen($email); 
        for($i=0; $i<$str_len; $i++) { 
            $current_element = $email[$i]; 
            if($current_element == "." && ($email[$i+1] == ".")) { 
                return false; 
                break; 
            } 
            else { 

            } 
        } 
        return true; 
    } 
    function valid_local_part($local_part) { 
        if(preg_match("/[^a-zA-Z0-9-_@.!#$%&'*\/+=?^`{\|}~]/", $local_part)) { 
            return false; 
        } 
        else { 
            return true; 
        } 
    } 
    function valid_domain_part($domain_part) { 
        if(preg_match("/[^a-zA-Z0-9@#\[\].]/", $domain_part)) { 
            return false; 
        } 
        elseif(preg_match("/[@]/", $domain_part) && preg_match("/[#]/", $domain_part)) { 
            return false; 
        } 
        elseif(preg_match("/[\[]/", $domain_part) || preg_match("/[\]]/", $domain_part)) { 
            $this->dot_pos = strrpos($domain_part, "."); 
            if(($this->$dot_pos < strrpos($domain_part, "]")) || (strrpos($domain_part, "]") < strrpos($domain_part, "["))) { 
                return true; 
            } 
            elseif(preg_match("/[^0-9.]/", $domain_part)) { 
                return false; 
            } 
            else { 
                return false; 
            } 
        } 
        else { 
            return true; 
        } 
    } 


		public function email_valid($temp_email) { 

			
		        // trim() the entered E-Mail 
		        $str_trimmed = trim($temp_email); 
		        // find the @ position 
		        $at_pos = strrpos($str_trimmed, "@"); 
		        // find the . position 
		        $dot_pos = strrpos($str_trimmed, "."); 
		        // this will cut the local part and return it in $local_part 
		        $local_part = substr($str_trimmed, 0, $at_pos); 
		        // this will cut the domain part and return it in $domain_part 
		        $domain_part = substr($str_trimmed, $at_pos); 
		        if(!isset($str_trimmed) || is_null($str_trimmed) || empty($str_trimmed) || $str_trimmed == "") { 
		            return false; 
		        } 
		        elseif(!$this->valid_local_part($local_part)) { 
		            return false; 
		        } 
		        elseif(!$this->valid_domain_part($domain_part)) { 
		            return false; 
		        } 
		        elseif($at_pos > $dot_pos) { 
		            return false; 
		        } 
		        elseif(!$this->valid_local_part($local_part)) { 
		            return false; 
		        } 
		        elseif(($str_trimmed[$at_pos + 1]) == ".") { 
		            return false; 
		        } 
		        elseif(!preg_match("/[(@)]/", $str_trimmed) || !preg_match("/[(.)]/", $str_trimmed)) { 
		            return false; 
		        }
		        elseif(substr_count($str_trimmed, '@')!=1){
		        	// if there's more than one @
					return false;			
		        } 
		        else { 
		            return true; 
		        } 
		} 
	
	public function sendMail($email, $name, $subject, $html, $text){
	     
	     $from='info@blibb.net';
	     $fromName='Blibb';
	       
	      // This is your From email address
	      $from = array($from => $fromName);
	      // Email recipients
	      $to = array(
	        $name=>$email
	      );
	             
	      // Login credentials
	      $username = '127biscuits';
	      $password = 't0t0r012:se';
	       
	      // Setup Swift mailer parameters
	      $transport = Swift_SmtpTransport::newInstance('smtp.sendgrid.net', 587);
	      $transport->setUsername($username);
	      $transport->setPassword($password);
	      $swift = Swift_Mailer::newInstance($transport);
	       
	      // Create a message (subject)
	      $message = new Swift_Message($subject);
	       
	      // attach the body of the email
	      $message->setFrom($from);
	      $message->setBody($html, 'text/html');
	      $message->setTo($to);
	      $message->addPart($text, 'text/plain');
	       
	      // send message 
	      if ($recipients = $swift->send($message, $failures))
	      {
	        // This will let us know how many users received this message
	        return 'Message sent out to '.$recipients.' users';
	      }
	      // something went wrong =(
	      else
	      {
	        echo "Something went wrong - ";
	        print_r($failures);
	      }
	}
}