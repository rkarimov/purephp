<?php
  if (function_exists('apache_request_headers'))
  	$headers = apache_request_headers();
	elseif (function_exists('getallheader'))
		$headers = getallheader();
	else
    $headers = $_SERVER;

	if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
		print '<pre>' . print_r($headers, 1) . '</pre>';
		exit;
	}
?>
<!DOCTYPE html>
<html>
<head>
  <script type="text/javascript" src="jquery.js"></script>
</head> 
<body>
  <div id="ajax-inner"></div>
	<script type="text/javascript">
		console.log('test');
		$.ajax({
        type: "GET", 
        url: "index.php",
        contentType: "text/html",
        beforeSend: function(jqXHR, settings){
          jqXHR.setRequestHeader("testpure", "any data . ..test.");
          jqXHR.setRequestHeader("test.pointed", "any data   test dsds...");
					jqXHR.setRequestHeader("test.pointed.more", "any data   test dsds...");
				},
				success: function(data, status,jqXHR) {
					$('#ajax-inner').html(data);
				},
		});
	</script>
</body>
</html>