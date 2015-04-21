<!DOCTYPE html>
<html>
  <head>
    <title>SP | <?=$this->e($title)?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
  </head>
  <body>
    <div class="container">
    	<nav class="navbar navbar-default">
    		<div class="container-fluid">
    			<a class="navbar-brand" href="/">Playgroung</a>
				<ul class="nav navbar-nav">
					<li><a href="/push">Push</a></li>
     				<li><a href="/email">Email</a></li>
				</ul>
    		</div>
     	</nav>
    </div>
    <section class="container"><?=$this->section('content')?></section>
  </body>
</html>
