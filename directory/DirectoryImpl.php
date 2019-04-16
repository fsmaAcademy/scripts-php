<?php


class DirectoryImpl {

  private $name;

  public function __construct($name) {
    $this->name = $name;
  }
  
  public function create() : array {
    if (!is_dir($this->name)) {
      mkdir($this->name);
      return [
        'status' => true,
        'message' => 'Diretório criado com sucesso'
      ];
    } else {
      return [
        'status' => false,
        'message' => 'Diretório Já existe'
      ];
    }
  }

  public function readFiles() : array {
    $datas = array();
    $images = scandir($this->name);
    foreach ($images as $img) {
      if (!in_array($img, array('.', '..'))) {
        $fileName = 'images' . DIRECTORY_SEPARATOR . $img;
        $info = pathinfo($fileName);
        $info['size'] = filesize($fileName);
        $info['modified'] = date('d/m/Y H:i:s', filemtime($fileName));
        $info['url'] = 'http://localhost:8888/'.str_replace('\\', '/', $fileName);
        array_push($datas, $info);
      }
    }
    return [
      'images' => $datas
    ];
  }

  public function remove($name) : void {
    rmdir($name);
  }

}
  
$diretory = new DirectoryImpl('images');
echo json_encode($diretory->readFiles());
