<!DOCTYPE html>
<html>
<head>
	<title><?=@$title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	
	<!-- JS -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script src="/js/script.js"></script>	
				
	<link href="/views/style.css" rel="stylesheet" type="text/css">
	
</head>

<body>	

<h1>My News</h1>

	<div class="maintext">
	<div id='menu'>
	
		<!-- Menu for users who are logged in -->
		<? if($user): ?>
			
			<a href='/users/logout'>Logout</a>
			<a href='/news/createnew/'>Create a new news</a>
			<a href='/news/'>View news pages</a>
		
		<!-- Menu options for users who are not logged in -->	
		<? else: ?>
		
			<a href='/users/signup'>Sign up</a>
			<a href='/users/login'>Log in</a>
		
		<? endif; ?>
	
	</div>
	
	<br>

	<?=$content;?> 
	</div>
</body>