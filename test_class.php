<?php
class test_class {
  protected $test_var;
  
  function __contruct(){
    $test_var = "test variable value";
  }
  
  function output() {
    echo $test_var;
  }
}