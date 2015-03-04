<?php header('Content-type: text/html; charset=utf-8');
  if(!setlocale(LC_ALL, 'ru_RU.utf8')) setlocale(LC_ALL, 'en_US.utf8');
?>
<!DOCTYPE html>
<html>
<head>
  <title>jQuery Forms</title>
</head>
<script src="jquery.js"></script>
<script src="jquery.form.js"></script>
<body>
<h1><?php echo date('H:i:s');?></h1>
<form id="ahah-test" enctype="multipart/form-data" method="POST" >
  <input type="file" name="filetest" />
  <button>Submit</button>
</form> 

<script>
  jQuery('#ahah-test').submit(function(){
    $(this).ajaxSumbit();
    
    return false;
  });
</script>
</body>
<html>