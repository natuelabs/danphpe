<?php

namespace Natuelabs\Danphpe\Storage;

class FileSystem implements \Natuelabs\Danphpe\Storage
{
  private $path;

  public function __construct($path)
  {
    $this->path = $path;
  }

  public function save($file, $data)
  {
    $filePath = sprintf('%s/%s', $this->path, $file);
    file_put_contents($filePath, $data);
  }
}
