<?php
error_reporting(0);
$user = $_POST['user'];
$pass = $_POST['pass'];
$secretkey = "62f8ce9f74b12f84c123cc23437a4a32";

function tao_sig($postdata){
	global $secretkey;
	$textsig = "";
	foreach($postdata as $key => $value){
		$textsig .= "$key=$value";
	}
	$textsig .= $secretkey;
	$textsig = md5($textsig);
	
	return $textsig;
}

function getpage($url, $postdata='')
{
	$c = curl_init();
	curl_setopt($c, CURLOPT_URL, $url);
	curl_setopt($c, CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($c, CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($c, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0');

	if($postdata != "")
	{
		curl_setopt($c, CURLOPT_POST, 1);
		curl_setopt($c, CURLOPT_POSTFIELDS, $postdata);
	}
	
	$page = curl_exec($c);
	curl_close($c);
	return $page;
}
if($_GET['type'] == "gettoken")
{

	$postdata = array(
		"api_key" => "882a8490361da98702bf97a021ddc14d",
		"email" => $user,
		"format" => "JSON",
		"locale" => "vi_vn",
		"method" => "auth.login",
		"password" => $pass,
		"return_ssl_resources" => "0",
		"v" => "1.0"
	);
	
	$postdata['sig'] = tao_sig($postdata);
	
	http_build_query($postdata);
	
	$data = getpage("https://api.facebook.com/restserver.php",$postdata);
	$data = json_decode($data);
	$token = $data->access_token;
?>
	<div class="bs-callout bs-callout-info">
  		<textarea class="form-control"><?php echo $token;?></textarea>
  		<div style="text-align: center; padding-top: 10px;">
			<a style="cursor: pointer" onclick="check_token('<?php echo $token;?>')"><button class="btn btn-danger">Kiểm tra quyền token</button></a>
		</div>
		<div style="padding-top: 10px;" id="check">
			
		</div>
  	</div>
<?php
}
if($_GET['type'] == "checktoken")
{
	$token = $_POST['token'];
	$data = getpage("https://graph.facebook.com/me/permissions?access_token=$token");
	$data = json_decode($data);
	$data = $data->data;
	echo "<pre>";
	print_r($data);
	echo "</pre>";
}

?>