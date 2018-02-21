<?php

namespace Natuelabs\Danphpe\Reader;

use Aws\S3\S3Client;

class S3 implements \Natuelabs\Danphpe\Reader
{
  const BUCKET = 'natuelabs.taxman';
  const S3_CLIENT_VERSION = '2006-03-01';

  private $S3Client;
  private $env;

  public function __construct($region, $env = null, $credentials = null)
  {
    $this->env = $env;
    $this->client = $this->createS3Client($region, $credentials);
  }

  private function createS3Client($region, $credentials = null)
  {
    return S3Client::factory([
      'credentials' => $credentials,
      'region' => $region,
      'version' => self::S3_CLIENT_VERSION
    ]);
  }

  protected function get($file)
  {
    $path = sprintf('%s/danfe/%s', $this->env, $file);

    return $this->client->getObject([
      'Bucket' => self::BUCKET,
      'Key' => $path
    ]);
  }

  public function getContents($file)
  {
    try {
      return $this->get($file)->get('Body')->getContents();
    } catch (\Aws\S3\Exception\S3Exception $exception) {
      throw new Exceptions\DanfeNotFoundException(
        sprintf('Danfe %s not found on S3::%s', $file, $this->env),
        $exception->getCode(),
        $exception
      );
    }
  }
}
