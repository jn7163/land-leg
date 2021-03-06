<?php
/**
 * Land Leg Client v2.0
 * @authors XenK0u
 * @date    2016-02-28
 */
require_once 'conf.php';

function post_j($url, $jsonStr) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonStr);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json; charset=utf-8',
		'Content-Length: ' . strlen($jsonStr)
		)
	);
	$response = curl_exec($ch);
	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	return array($httpCode, $response);
}

function login($token) {
	$str = CLINENTIP . NASIP . MAC . TIME . $token . SECRET;
	$auth = strtoupper(md5($str));

	$url = "http://enet.10000.gd.cn:10001/client/login";	
	$jsonStr_m = json_encode(array(
		"username" => U,
		"password" => P,
		"verificationcode" => "",
		"clientip" => CLINENTIP,
		"nasip" => NASIP,
		"mac" => MAC,
		"iswifi" => WIFI2,
		"timestamp" => TIME,
		"authenticator" => $auth
		)
	);
	return $msg = list($returnCode, $returnContent) = post_j($url, $jsonStr_m);
}

function logout() {
	$str = CLINENTIP . NASIP . MAC . TIME . SECRET;
	$auth = strtoupper(md5($str));
	$url = "http://enet.10000.gd.cn:10001/client/logout";
	$jsonStr = json_encode(array(
		"clientip" => CLINENTIP,
		"nasip" => NASIP,
		"mac" => MAC,
		"timestamp" => TIME,
		"authenticator" => $auth
		)
	);
	return $msg = list($returnCode, $returnContent) = post_j($url, $jsonStr);
}

function challenge() {
	$str = CLINENTIP . NASIP . MAC . TIME . SECRET;
	$auth = strtoupper(md5($str));
	$url = "http://enet.10000.gd.cn:10001/client/challenge";
	$jsonStr_m = json_encode(array(
		"username" => U,
		"clientip" => CLINENTIP,
		"nasip" => NASIP,
		"mac" => MAC,
		"iswifi" => WIFI2,
		"timestamp" => TIME,
		"authenticator" => $auth
		)
	);
	$token = list($returnCode, $returnContent) = post_j($url, $jsonStr_m);
	$token_obj = json_decode($token['1']);
	return $token_obj->{'challenge'};
}


if(isset($_POST['s'])) {
	if($_POST['s'] == 'login') {
		$msg = login(challenge());
	}
	else if($_POST['s'] == 'logout') {
		$msg = logout();
	}
}

require_once 'view.php';
?>
<form action="" method="post">
	<input type="submit" name="s" value="login">
	<input type="submit" name="s" value="logout">
	<input type="button" value="active" onclick="window.location.href='index.php'">
</form>
<?php if(isset($msg)) echo '<p style="color:red"><i>Msg: '.$msg[1].'</i></p>'; ?>
