<?php

namespace Natuelabs\Danphpe\Reader;

class S3Test extends \PHPUnit_Framework_TestCase
{
  public function testCheckIfIsAReaderInstance()
  {
    $this->assertInstanceOf(
      \Natuelabs\Danphpe\Reader::class,
      $this->createReader()
    );
  }

  public function testCheckIfGetContentsWorksWithValidFile()
  {
    $reader = $this->createReader();

    $this->assertNotEmpty(
      $reader->getContents('test.pdf')
    );
  }

  /**
  * @expectedException \Natuelabs\Danphpe\Reader\Exceptions\DanfeNotFoundException
  */
  public function testCheckIfGetContentsOfUnexistentDanfe()
  {
    $reader = $this->createReader();
    $reader->getContents('lunga.pdf');
  }

  private function createReader()
  {
    return new S3(getenv('S3_REGION'), 'development_test', [
      'key' => getenv('S3_ACCESS_KEY'),
      'secret' => getenv('S3_SECRET_KEY')
    ]);
  }
}
