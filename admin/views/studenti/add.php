<?
	$title = 'Adauga student - Studenti';
?>
<!doctype html>
<html>
	<head>
		<? include App.'views/shared/head.php' ?>
	</head>
	<body>
		<? include App.'views/shared/menu.php' ?>
		<? include 'shared/menu.php' ?>
    
    <div class="container">
		  <form class="form-signin" method="POST">
        <h2 class="form-signin-heading">Adauga student</h2>
        <? if (isset($flash)) : ?>
          <span class="label label-<?=$flash['error'] ? 'important' : 'success'?>"><?=$flash['message']?></span>
        <? endif ?>
					<tr>
						<td>CNP</td>
						<td><input type="text" name="username" value="<?=@$_POST['username']?>" /></td>
					</tr>
					<tr>
						<td>Parola</td>
						<td><input type="text" name="password" /></td>
					</tr>
					<tr>
						<td colspan="2" align="right">
							<input type="submit" value="Adauga" />
						</td>
					</tr>
				</tbody>
			</table>
    </form>
    <? include App.'views/shared/footer.php' ?>
    </div>
	</body>
</html>
