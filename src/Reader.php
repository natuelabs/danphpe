<?php

namespace Natuelabs\Danphpe;

use Aws\S3\S3Client;

interface Reader
{
  /**
  * @return string
  */
  public function getContents($file);
}
