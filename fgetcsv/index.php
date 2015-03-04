<?php header('Content-type: text/html; charset=utf-8');
  if(!setlocale(LC_ALL, 'ru_RU.utf8')) setlocale(LC_ALL, 'en_US.utf8');
?>
<!DOCTYPE html>
<html>
<head>
  <title>fgetCSV test</title>
</head>
<body>
<?php
$file = fopen('carriers_1_.csv', 'r');
while($row = fgetcsv($file)) {
  print '<pre>' . print_r($row, 1) . '</pre>'; 
}
fclose($file);
?>
</body>
<html>