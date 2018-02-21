<?php

namespace Natuelabs\Danphpe\Storage;

class FileSystemTest extends \PHPUnit_Framework_TestCase
{
  public function testCheckIfIsAStorageInstance()
  {
    $this->assertInstanceOf(\Natuelabs\Danphpe\Storage::class, new FileSystem('/tmp'));
  }

  public function testCheckIfSaveMethodWorks()
  {
    $storage = new FileSystem($path = '/tmp');
    $storage->save($fileName = date('y-m-d') . '.txt', 'test');

    $this->assertFileExists($path . '/' .$fileName);
  }
}
