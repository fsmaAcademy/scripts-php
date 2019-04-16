<?php

class StringUtil {
  
  private $value;

  public function __construct(string $value) {
    $this->value = $value;
  }

  public function treatsCep() {
    $this->value = trim($this->value);
    $this->value = str_replace('-', '', $this->value);

  }

}