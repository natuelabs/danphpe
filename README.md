This is a simple package to read, merge and save danfes.

Actually this package only read danfes on S3 and save on FileSystem.

### How to use

```php
<?php

require 'vendor/autoload.php';

$reader = new Natuelabs\Danphpe\Reader\S3(getenv('S3_REGION'), 'development', [
  'key' => getenv('S3_ACCESS_KEY'),
  'secret' => getenv('S3_SECRET_KEY'),
]);

$storage = new Natuelabs\Danphpe\Storage\FileSystem('/tmp');

$storage->save(
  'merged.pdf',
  Natuelabs\Danphpe\PDF\merge([
    Natuelabs\Danphpe\PDF\merge\raw($reader->getContents('32180217018091000276550020000375281000000020.pdf')),
    Natuelabs\Danphpe\PDF\merge\raw($reader->getContents('32180217018091000276550020000375291000000036.pdf')),
    Natuelabs\Danphpe\PDF\merge\raw($reader->getContents('32180217018091000276550020000375301000000045.pdf'))
  ])
);

```

### How run the tests

```sh
S3_REGION=$REGION S3_ACCESS_KEY=$ACCESS S3_SECRET_KEY=$SECRET vendor/bin/phpunit
```
