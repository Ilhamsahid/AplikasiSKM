<?php

include __DIR__ . '/../configs/database.php';
require_once __DIR__ . '/../data/Faskes.php';

$faskes = new Faskes($conn);

$explode = explode('/', $path);
$getId = $explode[4] ?? null;
$getMode = $explode[2];

if ($getMode === "delete") {
  echo "ini delete";
} else if ($getMode === "tambah") {
  echo "ini tambah";
} else {
  echo "ini update";
}
