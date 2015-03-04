<?php
header('Content-type:text/html; charset=utf-8');
// Connecting, selecting database
$link = mysql_connect('localhost', 'root', '123')
    or die('Could not connect: ' . mysql_error());
echo 'Connected successfully';
mysql_select_db('royal_present') or die('Could not select database');

// Performing SQL query
$query = 'SELECT * FROM `carriers2`';
$result = mysql_query($query) or die('Query failed: ' . mysql_error());

// Printing results in HTML
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
    $id = $line['carriers_id'];
        $city = mb_convert_case($line['city'], MB_CASE_TITLE, 'UTF-8');
        print $city . '<br>';
        $query = "
          UPDATE `carriers2`
          set `city`='$city'
          where `carriers_id`=$id 
          ";
        mysql_query($query) or die('Query failed: ' . mysql_error());

}

$query = 'UPDATE `carriers2` set `carriers_title`=\'Новая почта. Самовывоз.\'';
mysql_query($query) or die('Query failed: ' . mysql_error());

// Free resultset
mysql_free_result($result);

// Closing connection
mysql_close($link);

function strtolower_utf8($text){
 $text = mb_convert_case($text, MB_CASE_LOWER, "UTF-8");
 return $text;
}