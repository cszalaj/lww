<?php

	session_start();
	date_default_timezone_set('Etc/UTC');
   	///////////////
	//Set Vars for Testing if test, if not, use the real info
	$whitelist = array(
	    '127.0.0.1',
	    '::1'
	);

	$AuthVars = array();

	if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){

		 /*
		mysql_connect('localhost', 'root', 'm3D1411') or die(mysql_error());
		mysql_select_db('livingwaters') or die(mysql_error());
		
		mysql_connect("localhost", "root", "oct2919@") or die(mysql_error());
    	mysql_select_db('lwecardtest') or die(mysql_error());
		*/

    	$db = new mysqli('localhost', 'root', 'oct2919@', 'lwecardtest');

		if($db->connect_errno > 0){
		    die('Unable to connect to database [' . $db->connect_error . ']');
		}

	    $AuthVars['AUTHORIZENET_API_LOGIN_ID'] = "3TMqen2EMQ9L";
		$AuthVars['AUTHORIZENET_TRANSACTION_KEY'] = "58k9H2RHVst5P4ST";
		$AuthVars['AUTHORIZENET_SANDBOX'] =  true;
	   
	} else {
		 /*
		mysql_connect('localhost', 'root', 'm3D1411') or die(mysql_error());
		mysql_select_db('livingwaters') or die(mysql_error());

		mysql_connect("localhost", "livingwatersecard", "5153Jwrj") or die(mysql_error());
    	mysql_select_db('livingwatersecard') or die(mysql_error());
    	*/

     	$db = new mysqli('localhost', 'livingwatersecard', '5153Jwrj', 'lwecardtest');

		if($db->connect_errno > 0){
		    die('Unable to connect to database [' . $db->connect_error . ']');
		}

    	$AuthVars['AUTHORIZENET_API_LOGIN_ID'] = "34g7ArBLha2";
		$AuthVars['AUTHORIZENET_TRANSACTION_KEY'] = "57qys6h7WANE489U";
		$AuthVars['AUTHORIZENET_SANDBOX'] =  false;

	}

/*
API Login ID 3TMqen2EMQ9L
Transaction Key 5N4jKAHv3j5K68qH
Secret Question Simon

Sandboxcreds
chrisszalaj1
Oct2919@

### Test Credit Card Numbers

| Card Type                  | Card Number      |
|----------------------------|------------------|
| American Express Test Card | 370000000000002  |
| Discover Test Card         | 6011000000000012 |
| Visa Test Card             | 4007000000027    |
| Second Visa Test Card      | 4012888818888    |
| JCB                        | 3088000000000017 |
| Diners Club/ Carte Blanche | 38000000000006   |

*Set the expiration date to anytime in the future.*
*/
