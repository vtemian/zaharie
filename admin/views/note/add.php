<?
	$title = 'Adauga nota - Studenti';
?>
<!doctype html>
<html>
	<head>
		<? include App.'views/shared/head.php' ?>
	</head>
	<body>
		<? include App.'views/shared/menu.php' ?>
		<? include 'shared/menu.php' ?>
		
		<form method="POST">
			<table>
				<thead>
					<caption>Adauga nota</caption>
				</thead>
				<tbody>
					<? if (isset($flash)) : ?>
						<tr>
							<td colspan="2">
								<font color="<?=$flash['error'] ? 'red' : 'green'?>"><?=$flash['message']?></font>
							</td>
						</tr>
					<? endif ?>

					<tr>
						<td>Nota</td>
						<td><input type="text" name="nota" value="<?=@$_POST['nota']?>" /></td>
					</tr>
					<tr>
						<td>Data</td>
						<td><input type="text" name="data" value="<?=@$_POST['data']?>" /></td>
						<td>(luna/ziua/anul)</td>
					</tr>
					<tr>
						<td>Descriere</td>
						<td><input type="text" name="descriere" value="<?=@$_POST['descriere']?>" /></td>
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
	</body>
</html>
