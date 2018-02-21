This is a simple package to read, merge and save danfes.

Actually this package only read danfes on S3 and save on FileSystem.

### How to use

```php
<?php

require 'vendor/autoload.php';

$region = 'us-east-1';
$environment = 'development';
$credentials = [
  'key' => '',
  'secret' => '',
];
$bucket = 'your.bucket';

$reader = new Natuelabs\Danphpe\Reader\S3($region, $environment, $credentials, $bucket);

$storage = new Natuelabs\Danphpe\Storage\FileSystem('/tmp');

$storage->save(
  'merged.pdf',
  Natuelabs\Danphpe\PDF\merge([
    Natuelabs\Danphpe\PDF\merge\raw($reader->getContents('3218021701809100027655020000375281000000020.pdf')),
    Natuelabs\Danphpe\PDF\merge\raw($reader->getContents('3218021701809100027655020000375291000000036.pdf')),
    Natuelabs\Danphpe\PDF\merge\raw($reader->getContents('3218021701809100027655020000375301000000045.pdf'))
  ])
);

```

### How run the tests

```sh
vendor/bin/phpunit
```
