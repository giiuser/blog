<h1><?php echo $post['title']?></h1>
<div><?php echo nl2br($post['post'])?></div>
<span class="right">Написал <?php echo $post['author'];?> от <?php echo date('d.m.Y', strtotime($post['created']));?> </span>
<hr>
<h2>Комментарии:</h2>
<?php if(!empty($comments)):
      foreach ($comments as $key => $value):?>
<div class="comment">
    <h3>Комментарий от <?php echo $value['name'];?></h3>
    <p><?php echo nl2br($value['post']);?></p>
</div>
<?php endforeach;
      else:?>
<hr>
<h3>Пока никто ничего не написал. Вы можете быть первым!</h3>
<?php endif; ?>
<form class="form-horizontal" method="post">
	
	<label>Ваше имя</label><br />
	<input type="text" class="input-field" name="name" value="" /><br /><br />
        
	<label>Ваш комментарий</label><br />
	<textarea name="post" class="text-field" ></textarea><br /><br />
	
	<div><button  type="submit">Добавить комментарий</button></div>
	
</form>

