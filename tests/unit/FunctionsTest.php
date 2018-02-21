<?php

namespace Natuelabs\Danphpe;

class FunctionsTest extends \PHPUnit_Framework_TestCase
{
  public function testCheckIfMergeRawFunctionReturnsAnExpectedData()
  {
    $this->assertEquals([
      'type' => 'raw',
      'data' => $data = 'lunga lunga lunga'
    ], PDF\merge\raw($data));
  }

  public function testCheckIfMergeFileFunctionReturnsAnExpectedData()
  {
    $this->assertEquals([
      'type' => 'file',
      'file' => $file = 'foo.pdf'
    ], PDF\merge\file($file));
  }

  /**
  * @dataProvider mergeValidRaws
  */
  public function testCheckIfMergeFunctionWorksWithValidRaws($list = [])
  {
    $this->assertNotEmpty(PDF\merge(array_map(function ($data) {
      return PDF\merge\raw($data);
    }, $list)));
  }

  /**
  * @dataProvider mergeValidFiles
  */
  public function testCheckIfMergeFunctionWorksWithValidFiles($list = [])
  {
    $this->assertNotEmpty(PDF\merge(array_map(function ($file) {
      return PDF\merge\file($file);
    }, $list)));
  }

  /**
  * @dataProvider mergeValidFilesAndRaws
  */
  public function testCheckIfMergeFunctionWorksWithFilesAndRawsOnList($list = [])
  {
    $this->assertNotEmpty(PDF\merge($list));
  }

  public function mergeValidRaws()
  {
    $fixtures = json_decode(file_get_contents('tests/unit/fixtures/valid-pdf/raws.json'));

    return [[array_map('base64_decode', $fixtures)]];
  }

  public function mergeValidFiles()
  {
    return [
      [[
        'tests/unit/fixtures/valid-pdf/1.pdf',
        'tests/unit/fixtures/valid-pdf/3.pdf'
      ]],
      [[
        'tests/unit/fixtures/valid-pdf/3.pdf',
        'tests/unit/fixtures/valid-pdf/2.pdf'
      ]],
      [[
        'tests/unit/fixtures/valid-pdf/3.pdf',
        'tests/unit/fixtures/valid-pdf/1.pdf',
        'tests/unit/fixtures/valid-pdf/2.pdf'
      ]],
    ];
  }

  public function mergeValidFilesAndRaws()
  {
    $raws = json_decode(file_get_contents('tests/unit/fixtures/valid-pdf/raws.json'));

    return [
      [[
        PDF\merge\file('tests/unit/fixtures/valid-pdf/1.pdf'),
        PDF\merge\raw(base64_decode($raws[0]))
      ]],
      [[
        PDF\merge\raw(base64_decode($raws[2])),
        PDF\merge\file('tests/unit/fixtures/valid-pdf/3.pdf')
      ]],
      [[
        PDF\merge\file('tests/unit/fixtures/valid-pdf/3.pdf'),
        PDF\merge\raw(base64_decode($raws[1])),
        PDF\merge\file('tests/unit/fixtures/valid-pdf/2.pdf')
      ]],
    ];
  }
}
