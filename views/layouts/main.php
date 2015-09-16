<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="ru" />
	<link rel="stylesheet" type="text/css" href="/css/style.css" />
	<title>Блог</title>
</head>

<body>
	<div class="main_conteiner">
		<div class="menu">
			<ul>
				<li><a href="/">Главная</a></li>
                                <?php if(!$this->user):?>
                                <li><a href="/user/login">Войти</a></li>
                                <?php else:?>
                                <li><a href="/post/write">Добавить пост</a></li>
                                <li><a href="/user/logout">Выйти (<?php echo $this->user;?>)</a></li>
                                <?php endif;?>
			</ul>
		</div>
		
		<?php include ($content);?>
	</div>
</body>
</html>