<?php

$data = [
  'user' => [
    'name' => 'thiago',
    'nick' => 'codenome',
    'email' => 'thiago@gmail.com'
  ]
];

setcookie('NOME_DO_COOKIE', json_encode($data), time() + 3600);

echo 'ok';
?>