<?
	$title = 'Login';
?>
<!doctype html>
<html>
	<head>
		<? include App.'views/shared/head.php' ?>
	</head>
  <body>
    <div class="container">
      <? if (isset($flash)) : ?>
        <span class="label label-<?=$flash['error'] ? 'important' : 'success'?>"><?=$flash['message']?></span>
			<? endif ?>

      <form class="form-signin" method="POST">
        <h2 class="form-signin-heading">Login</h2>
        <input type="text" class="input-block-level" name="username" placeholder="CNP">
        <input type="password" class="input-block-level" name="password" placeholder="Parola">
        <button class="btn btn-large btn-primary" type="submit">Intra</button>
      </form>
    </div>
    <? include App.'views/shared/footer.php' ?>
</body>
</html>
