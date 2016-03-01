<?php
/**
 * Land Leg Client v2.0
 * @authors XenK0u
 * @date    2016-02-28
 */
require_once 'conf.php';
require_once 'view.php';
?>
<br>
<iframe height="30px" src="http://enet.10000.gd.cn:8001/hbservice/client/active?username=<?php echo U; ?>&clientip=<?php echo CLINENTIP; ?>&nasip=<?php echo NASIP; ?>&mac=<?php echo MAC; ?>&timestamp=<?php echo TIME; ?>&authenticator=<?php echo strtoupper(md5(CLINENTIP . NASIP . MAC . TIME . SECRET)) ?>"></iframe>
<form action="login.php" method="post">
	<br>
	<input type="submit" name="s" value="login">
	<input type="submit" name="s" value="logout">
	<input type="button" value="active" onclick="window.open('index.php')">
</form>
<script language="JavaScript">
function myrefresh()
{window.location.reload();}
setTimeout('myrefresh()',30000);
</script>
