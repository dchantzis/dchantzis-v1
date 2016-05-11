<?php

define('SYSTEM_MODE','localhost'); //'localhost' or 'server'

switch(SYSTEM_MODE)
{
	case 'localhost':
		define('DB_HOST', 'localhost');
		define('DB_DATABASE', '');
		define('DB_USER', '');
		define('DB_PASSWORD', '');
		break;
	case 'server':
		define('SERVER_DB_PREFIX','');
		define('DB_HOST', '');
		define('DB_DATABASE', SERVER_DB_PREFIX.'');
		define('DB_USER', SERVER_DB_PREFIX.'');
		define('DB_PASSWORD', '');
		break;
	default:
		//do nothing
		break;
}//switch

$csrf_password_generator = hash('sha256', date("Y-m-d"));

define('SERVER_NAME','dimitrioschantzis.com');
define('DEFAULT_EMAIL','info@dimitrioschantzis.com');
define('CSRF_PASS_GEN',$csrf_password_generator);
define('CONTACT_MESSAGE_MAX_LENGTH',3000);

?>
