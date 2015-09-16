<?php if (empty($posts)):?>

<h1>У вас пока нет ни одного поста</h1>

<?php else:?>

<h1>Ваши записи:</h1>

<?php foreach ($posts as $key => $value) :?>

<h2><a href="/post/view/<?php echo $value['id'];?>"><?php echo $value['title'];?></a></h2>
	 
<?php endforeach;?>
<?php endif;?>