<?
	$title = 'Note';
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
		
		<table border="1" cellspacing="0" cellpadding="3">
			<thead>
				<tr>
					<th width="50">Nota</th>
					<th width="100">Data</th>
					<th width="350">Descriere</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<? if (isset($model) && !empty($model)) : ?>
					<? foreach ($model as $nota) : ?>
						<tr>
							<td align="center"><?=$nota['nota']?></td>
							<td><?=$nota['data']?></td>
							<td><?=$nota['descriere'] == null ? '<i>Fara descriere</i>' : $nota['descriere']?></td>
							<td>
								<a href="sterge_nota.php?user=<?=$selectedUser['id']?>&nota=<?=$nota['id']?>">Sterge nota</a>
							</td>
						</tr>
					<? endforeach ?>
				<? else : ?>
					<tr>
						<td colspan="4" align="center">Studentul nu are note !</td>
					</tr>
				<? endif ?>
			</tbody>
    </table>
 <? include App.'views/shared/footer.php' ?>
	</body>
</html>
