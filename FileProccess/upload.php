<form method="post" enctype="multipart/form-data">

  <input type="file" name="fileUpload">

  <button type="submit">Send</button>

</form>


<?php
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $file = $_FILES['fileUpload'];

  echo json_encode($file);

  if($file['error']) {
    echo 'entrou no erro';
    throw new Exception('Error: '.$file['error'], 1);
  }

  $dirUploads = 'uploads';
  if (!is_dir($dirUploads)) {
    mkdir($dirUploads);
  }

  if (move_uploaded_file($file['tmp_name'], $dirUploads . DIRECTORY_SEPARATOR . $file['name'])) {
    echo 'Upload realizado com sucesso!';
  } else {
    throw new Exception('Não foi possível realizar o upload', 403);
  }

}
?>
