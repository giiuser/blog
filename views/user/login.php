<?php if(!$this->user):?>

<h1>Форма для логина</h1>
<form class="well form-inline" method="post">
        <input type="text" name="name" class="input-small" placeholder="Name">
        <input type="password" name="pass" class="input-small" placeholder="Password">
        <button type="submit" class="btn">Войти</button>
        <span class="help-inline"><?php echo @$error?></span>
</form>

<?php else:?>

<h1>Вы уже залогинены, <?php echo $this->user;?></h1>

<?php endif; ?>
