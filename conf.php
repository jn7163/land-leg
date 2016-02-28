<?php
/**
 * Land Leg Client v2.0
 * @authors XenK0u
 * @date    2016-02-28
 */

define('U', '马赛克');
define('P', '马赛克');
define('CLINENTIP', '马赛克');
define('NASIP', '219.128.230.1');
//mac eg: FF-FF-FF-FF-FF-FF
define('MAC', '马赛克');
define('TIME', getTimestamp());
define('WIFI', '1050');
define('WIFI2', '4060');
define('SECRET', 'Eshore!@#');

function getTimestamp() {
return number_format(microtime(true),3,'','');
}