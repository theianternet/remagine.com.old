<?php

set_time_limit(660); //11 minutes

require "inc/global.php";

// We must include the BlueToc libraries
require_once "bluetoc/EventHandlers/ObjectBased.php";
require_once "bluetoc/TocProtocol.php";
require_once "bluetoc/AimClient.php";
require_once "bluetoc/MultiplexListener.php";

// We define our own class, extending AimClient
class iPhoneChat extends AimClient
{		 
	function iPhoneChat($user, $pass)
	{						 
		// Debug mode is by default off
		$this->debug_mode = false;
		
		$this->aim_user = $user;
		$this->aim_pass = $pass;

		$this->didSignIn = false;
		
		$this->connect();
	}
	
	function listen() {
		$this->checkForMessages();
		return parent::listen();
	}

	function checkForMessages() {
		if ($this->aim_user && $this->didSignIn) {
			$search = new Search("ChatMessage");
			$search->addCondition("fromUsername", "=", $this->aim_user);
			foreach ($search->getResults() AS $r) {
				if ($r->type == 0) {
					$this->send_im($r->toUsername, $r->body, false);
					$r->delete();
				} else if ($r->type == 3) {
					$r->delete();
					$this->sign_off();
					exit();
				}
			}
		}
	}
	
	// Handle once we've signed on
	function event_sign_on($args) {
		echo "Yay! I've signed in!\n";
		if ($this->aim_user) {
			$search = new Search("ChatUser");
			$search->addCondition("username","=",$this->aim_user);
			foreach ($search->getResults() AS $r) {
				$r->delete();
			}
			$new = new ChatUser();
			$new->username = $this->aim_user;
			$new->sessionId = $_GET["sessionId"];
			$new->save();
			$this->didSignIn = true;
		}
	}

	function event_buddy_update($args) {
		$new = new ChatMessage();
		$new->fromUsername = $args["user"];
		$new->toUsername = $this->aim_user;
		if ($args["is_online"]) {
			$new->type = 1;
		} else {
			$new->type = 2;
		}
		$new->body = $args["class"];
		$new->save();
	}

	function event_bart($args) {
		/*
		$new = new ChatMessage();
		$new->fromUsername = $args["user"];
		$new->type = 4;
		$new->body = $args["data"];
		$new->save();
		*/
	}

	function event_caps($args) {
		/*
		$new = new ChatMessage();
		$new->fromUsername = "capabilities-". $args["user"];
		$new->type = 5;
		$new->body = $args["cap"];
		$new->save();
		*/
	}

	// Handle when we get an instant message
	function event_im($args)
	{
		//echo "{$this->aim_user}: {$args['user']} IMed me!\n";
		
		// Remember that AIM IMs usually have HTML
		// so we must strip it so that we can
		// easily parse it
		$message = strip_tags($args['message']);

		$new = new ChatMessage();
		$new->fromUsername = $args["user"];
		$new->toUsername = $this->aim_user;
		$new->body = $message;
		$new->type = "0";
		$new->save();
	}
	
	function event_error($args)
	{
		// These are a list of errors in English
		// Most, if not all, errors will return an error number
		// and not the error description
		$connection_errors = array(
			100 => 'Data unable to be sent',
			200 => 'Flapon',
			201 => 'Data not received from server after FLAPON packet',
			202 => 'Invalid FLAP SIGNON response from the server',
			203 => 'Invalid response from the server' );
		
		$aim_errors = array(
			0 => 'Success',
			1 => 'AOLIM Error: Unknown Error',
			2 => 'AOLIM Error: Incorrect Arguments',
			3 => 'AOLIM Error: Exceeded Max Packet Length (1024)',
			4 => 'AOLIM Error: Reading from server',
			5 => 'AOLIM Error: Sending to server',
			6 => 'AOLIM Error: Login timeout',
			901 => 'General Error: %s not currently available',
			902 => 'General Error: Warning of %s not currently available',
			903 => 'General Error: A message has been dropped, you are exceeding the 
					server speed limit',
			950 => 'Chat Error: Chat in %s is unavailable',
			960 => 'IM and Info Error: You are sending messages too fast to %s',
			961 => 'IM and Info Error: You missed an IM from %s because it was too big',
			962 => 'IM and Info Error: You missed an IM from %s because it was sent
					too fast',
			970 => 'Dir Error: Failure',
			971 => 'Dir Error: Too many matches',
			972 => 'Dir Error: Need more qualifiers',
			973 => 'Dir Error: Dir service temporarily unavailble',
			974 => 'Dir Error: Email lookup restricted',
			975 => 'Dir Error: Keyword ignored',
			976 => 'Dir Error: No keywords',
			977 => 'Dir Error: Language not supported',
			978 => 'Dir Error: Country not supported',
			979 => 'Dir Error: Failure unknown %s',
			980 => 'Auth Error: Incorrect nickname or password',
			981 => 'Auth Error: The service is temporarily unavailable',
			982 => 'Auth Error: Your warning level is too high to sign on',
			983 => 'Auth Error: You have been connecting and disconnecting too frequently.
					Wait 10 minutes and try again. If you continue to try, you will need to
					wait even longer.',
			989 => 'Auth Error: An unknown signon error has occurred %s' ); 
			
		// Let's see what kind of error we are faced with
		switch($args['type'])
		{
			// Connection error
			case ERROR_CONNECTION:
				echo "* Connection error: {$connection_errors[$args['number']]} ({$args['number']})\n";
				break;
			// AIM is giving us an error
			case ERROR_AIM:
				echo "* AIM error: {$aim_errors[$args['number']]} ({$args['number']})\n";
				break;
		}
	}
}

$client = new iPhoneChat(base64_decode(urldecode($_GET["username"])), base64_decode(urldecode($_GET["password"])));

$listener = new MultiplexListener();
$listener->add_client($client);
$listener->run($errno, $errstr);

/*
while(true) { // Listen to the bot infinitely
	$client->checkForMessages();
	usleep(500000);
}
*/

?>