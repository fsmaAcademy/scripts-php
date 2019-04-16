<?php

class FileImpl {

  private $diretory;
  private $name;

  public function __construct(string $name, string $directory = NULL) {
    $this->name = $name;
    if ($directory != NULL)
      $this->diretory = $directory . date('dMY');
  }

  public function writeTxt($data) : void {
    if (!$this->diretory) {
      $file = fopen($this->name, 'a+');
      echo "Arquivo criado sem diretorio\n";
    } else {
        if (!is_dir($this->diretory)) {
          mkdir($this->diretory);
        }
        $file = fopen($this->diretory . DIRECTORY_SEPARATOR . $this->name, 'a+');
        echo "Arquivo criado com diretorio\n";
    }
    fwrite($file, $data."\r\n");
    fclose($file);
  }

  public function arrayToFile(array $datas) : void {
    
    $file = NULL;

    if ($this->diretory === NULL) {
      $file = fopen($this->name, 'w+');
    } else {
      if (!is_dir($this->diretory)) {
        mkdir($this->diretory);
      }
      $file = fopen($this->diretory . DIRECTORY_SEPARATOR . $this->name, 'w+');
    }

    
    $headers = array();
    
    foreach ($datas[0] as $keys => $value) {
      array_push($headers, ucfirst($keys));
    }
    
    fwrite($file, implode(';', $headers) . "\r\n");

    foreach ($datas as $row) {
      $colums = array();
      foreach ($row as $key => $value) {
        array_push($colums, $value);
      }
      var_dump($colums);
      fwrite($file, implode(';', $colums) . "\r\n");
    }
  
    fclose($file);
  }

  public function remove() : void {
    if ($this->diretory == NULL) {
      if (file_exists($this->name))
        unlink($this->name);
    } else {
      unlink($this->diretory . DIRECTORY_SEPARATOR . $this->name);
    }
  }

  public function read() : void {
    // if ($this->diretory != NULL && is_dir($this->diretory)) {
    if (file_exists($this->name)) {
      $file = fopen($this->name, 'r');
      $headers = explode(';', fgets($file));
      $datas = array();
      while($row = fgets($file)) {
        $rowData = explode(';', $row);
        $line = array();
        for($i = 0; $i < count($headers); $i++) {
          $line[$headers[$i]] = $rowData[$i];
        }
        array_push($datas, $line);
      }
      fclose($file);
    }
    json_encode($datas);
  }

}

$family = array();

array_push($family, ['name' => 'Thiago Cunha', 'age'  => 29]);
array_push($family, ['name' => 'Caroline Cunha', 'age'  => 29]);
array_push($family, ['name' => 'Thalita Cunha', 'age'  => 29]);

$file = new FileImpl('family.csv');
$file->read();