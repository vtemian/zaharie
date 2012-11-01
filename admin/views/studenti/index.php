<?
	$title = 'Studenti';
?>
<!doctype html>
<html>
	<head>
		<? include App.'views/shared/head.php' ?>
	</head>
	<body>
		<? include App.'views/shared/menu.php' ?>
		<? include 'shared/menu.php' ?>

		<? if (isset($flash)) : ?>
			<font color="<?=$flash['error'] ? 'red' : 'green'?>"><?=$flash['message']?></font>

			<br /><br />
		<? endif ?>
    <div class="container">
		<table border="1" cellspacing="0" cellpadding="3">
			<thead>
				<tr>
					<th width="300">CNP</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<? if (isset($model) && !empty($model)) : ?>
					<? foreach ($model as $user) : ?>
						<tr>
							<td><?=$user['username']?></td>
							<td>
								<a href="note.php?user=<?=$user['id']?>">Note</a> | 
								<a href="add_nota.php?user=<?=$user['id']?>">Adauga nota</a> |
								<a href="sterge_student.php?user=<?=$user['id']?>">Sterge student</a>
							</td>
						</tr>
					<? endforeach ?>
				<? else : ?>
					<tr>
						<td colspan="2" align="center">Nu exista studenti adaugati !</td>
					</tr>
				<? endif ?>
			</tbody>
    </table>
    <? include App.'views/shared/footer.php' ?>
  </div>
	</body>
</html>
