<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="stylesheet" href="./css/hello.css" type="text/css" />
		<title>Hello, NIFTYCloud C4SA!</title>
	</head>
    <div class="content">
	<body>
		<h1>Hello, NIFTYCloud C4SA!</h1>
<?php 
	mb_language("uni");
	mb_internal_encoding("utf-8");
	mb_http_input("auto");
	mb_http_output("utf-8");
	$date = date('l jS \of F Y h:i:s A');
	$str = $date.'にHello, NIFTYCloud C4SAしました。';
	print<<<EOF
<p>
$str<br>

</p>
EOF;
?>
	</body>
	</div>
</html>