<!DOCTYPE html>
<html>
  <head>
    <title><?=$this->e($title)?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
  </head>
  <body>
    <nav class="container">
      <a href="/">Push</a>
      <a href="/email">Email</a>
    </nav>
    <section class="container"><?=$this->section('content')?></section>
  </body>
</html>
