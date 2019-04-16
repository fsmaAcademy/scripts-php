<?php

class AddressService {

  private $cep;
  private $link;

  public function __construct($cep) {
    $this->cep = $cep;
    $this->link = 'https://viacep.com.br/ws/'. $this->cep . '/json/';
  }

  public function getCep(): array {
    $ch = curl_init($this->link);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);

    return $data;
  }

}

$cep = '27943-200';
$cep = str_replace('-', '', $cep);
echo $cep;
$address = new AddressService($cep);
print_r($address->getCep());