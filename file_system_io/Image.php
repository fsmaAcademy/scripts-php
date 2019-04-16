<?php

class ImageImpl {

  private $name;

  public function __construct($name) {
    $this->name = $name;
  }

  public function toBase64() : string {
    $info = new finfo(FILEINFO_MIME_TYPE);
    $encodeExtension = 'data:image/'.$info->file($this->name).';base64,';
    return $encodeExtension.base64_encode(file_get_contents($this->name));
  }

}

$image = new ImageImpl('dado.png');
echo $image->toBase64();

?>

<img src="<?= $image->toBase64() ?>"/>
