<?php

function arrayToJson($attr) {
  return json_encode($attr);
}

function jsonToArray($attr) {
  return json_decode($attr);
}