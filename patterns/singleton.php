<?php

class testSingleton {
  private $stringValue = '';
  private static $singletonInstance = NULL;
  private static $singletonCount = 0;
  
  private function __construct(){}
  public function __clone() {
    self::$singletonCount++;
  }

  static function getSingleton() {
    if (!$singletonInstance) {
      $singletonInstance = new self;
    }
    
    return $singletonInstance;
  }

  public function setStringValue($stringValue) {
    $this->stringValue = (string)$stringValue;
  }
  
  public function getStringValue() {
    return $this->stringValue;
  }
  
  public function getClonedSingletons() {
    return self::$singletonCount;
  }
}

class testSingletonIn extends testSingleton{
  public function getStringValue() {
    return 'Inheritor: ' . $this->stringValue;
  }
}

$instance_p1 = testSingletonIn::getSingleton();
$clone_of_ip1 = clone($instance_p1);
print testSingletonIn::getClonedSingletons();
