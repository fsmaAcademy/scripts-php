<?php

class GraphicDesigner {
  
  private $image;
  private $name;
  private $type;

  public function __construct(string $name = '', array $type = ['png'], $image = NULL) {
    $this->type = $type;
    $this->name = $name;
    if ($image != NULL) $this->image = $image;
  }
  
  public function __destruct() {
    echo 'Destroying ', $this->image, PHP_EOL;
  }
  
  
  public function selectHeader() {
    if (in_array($this->type, ['png'])) {
      header('Content-Type: image/png');
      echo 'pegou png';
    }
    if (in_array($this->type, ['jpg', 'jpeg'])) {
      echo 'pegou jpeg';
    }
  }
  
  public function createImage() : void {
    $this->image = imagecreate(256, 256);
    $black = imagecolorallocate($this->image, 0, 0, 0);
    $red = imagecolorallocate($this->image, 255, 0, 0);
    imagestring($this->image, 5, 60, 120, 'Thiago Cunha', $red);
    imagepng($this->image);
  }
  
  public function generatorCertified() : void {
    $this->image = imagecreatefromjpeg($this->name);
    
    $gray = imagecolorallocate($this->image, 100, 100, 100);
    $titleColor = imagecolorallocate($this->image, 0, 0, 0);
    
    imagestring($this->image, 5, 450, 150, 'CERTIFICADO', $titleColor);
    imagestring($this->image, 5, 440, 350, 'Thiago Cunha', $titleColor);
    imagestring($this->image, 3, 440, 370, utf8_decode('Concluído em: ').date('d/m/Y'), $titleColor);
    
    header('Content-Type: image/jpeg');
    imagejpeg($this->image, 'certificado-'.date('Y-m-d').'.jpg', 100);
    imagedestroy($this->image);
  }
  
  public function createThumbnail() {
    header('Content-Type: image/jpeg');
    $newWidth = 256;
    $newHeigth = 256;
    list($old_width, $old_heigth) = getimagesize($this->name);
    $newImage = imagecreatetruecolor($newWidth, $newHeigth);
    $oldImage = imagecreatefromjpeg($this->name);

    imagecopyresampled(
      $newImage,
      $oldImage,
      0,
      0,
      0,
      0,
      $newWidth,
      $newHeigth,
      $old_width,
      $old_heigth
    );

    imagejpeg($newImage);
    imagedestroy($oldImage);
    imagedestroy($newImage);
  }
  
}

$gd = new GraphicDesigner('animal.jpg');
$gd->createThumbnail();


?>