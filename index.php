<?php
// you can use print for debugging purposes, e.g.
// print "this is a debug message\n";

function solution($A) {
    $base = -2;
    $num = 0;
    foreach ($A as $k => $bit) {
        $num += $bit * pow($base, $k);
    }

    $num *= -1;
    $bArray = array();
  	while ($num != 0) {
  		$temp_num = $num;
  		$num = intval($temp_num / $base);
  		$remainder = ($temp_num % $base);
   
  		if ($remainder < 0) {
  			$remainder += abs($base);
  			$num++;
  		}
  		$bArray[] = $remainder;
  	}
   
  	return $bArray;
}