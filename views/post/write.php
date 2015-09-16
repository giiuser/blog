<form class="form-horizontal" method="post">
	
	<label>Заголовок</label><br />
	<input type="text" class="input-field" name="title" value="" /><br /><br />
        
	<label>Текст</label><br />
	<textarea name="post" class="text-field" ></textarea><br /><br />
	
	<div class="form-actions"><button class="btn btn-primary" type="submit">Добавить</button></div>
        <span class="help-inline"><?php echo @$this->error?></span>
	
</form>