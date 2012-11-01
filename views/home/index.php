<?
	$title = 'Acasa';
?>
<!doctype html>
<html>
	<head>
		<? include App.'views/shared/head.php' ?>
	</head>
	<body>
		<? include App.'views/shared/menu.php' ?>
	  <div class="container">	
		<table border="1" cellspacing="0" cellpadding="3">
			<thead>
				<caption>Note</caption>
				<tr>
					<th width="50">Nota</th>
					<th width="100">Data</th>
					<th width="350">Descriere</th>
				</tr>
			</thead>
			<tbody>
				<? if (isset($model) && !empty($model)) : ?>
					<? foreach ($model as $nota) : ?>
						<tr>
							<td align="center"><?=$nota['nota']?></td>
							<td><?=$nota['data']?></td>
							<td><?=$nota['descriere'] == null ? '<i>Fara descriere</i>' : $nota['descriere']?></td>
						</tr>
					<? endforeach ?>
				<? else : ?>
					<tr>
						<td colspan="3" align="center">Nu aveti nici o nota !</td>
					</tr>
				<? endif ?>
			</tbody>
    </table>
  </div>
	</body>
</html>
