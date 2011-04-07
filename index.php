<?php
	include("fbmain.php");
	$auth_url = "http://www.facebook.com/dialog/oauth?client_id=" . $app_id . "&redirect_uri=" . urlencode($canvas_page) . "&scope=friends_about_me, user_about_me";
	$signed_request = $_REQUEST["signed_request"];
	list($encoded_sig, $payload) = explode('.', $signed_request, 2);
	$data = json_decode(base64_decode(strtr($payload, '-_', '+/')), true);       
	if(empty($data["user_id"])) {
		echo("<script> top.location.href='" . $auth_url . "'</script>");
	} else {
		echo "<meta http-equiv=\"REFRESH\" content=\"0;url=$canvas_page\">";
	}
		
	
	
