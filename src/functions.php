<?php

namespace Natuelabs\Danphpe\PDF;

use iio\libmergepdf\Merger;

function merge($list = []) {
  $merger = new Merger;

  $addRaw = function ($data) use ($merger) {
    $merger->addRaw($data);
  };

  $addFile = function ($file) use ($merger) {
    $merger->addFile($file);
  };

  array_walk($list, function ($row) use ($addFile, $addRaw) {
    if ($row['type'] === 'file') {
      $addFile($row['file']);
      return ;
    }
    $addRaw($row['data']);
  });

  return $merger->merge();
};

namespace Natuelabs\Danphpe\PDF\merge;

function raw($data)
{
  return [
    'type' => 'raw',
    'data' => $data
  ];
}

function file($file)
{
  return [
    'type' => 'file',
    'file' => $file
  ];
}
