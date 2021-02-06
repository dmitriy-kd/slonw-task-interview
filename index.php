<!DOCTYPE html>
<html>
<head>
	<title>Расчет порядка числа Фибоначчи</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<span class="popup-btn" onclick="myFunction()">Открыть окно</span>

	<?php if(isset($_GET['result'])): ?>
		<p>F(<?= $_GET['number']; ?>)=<?= $_GET['result']; ?></p>
	<?php endif; ?>

	<div class="popup-container" id="popup-container">
		<div class="popup-content">
			<form method="post" action="calculation.php">
				<p>Введите порядок числа Фибоначчи</p>
				<input type="text" name="num">
				<input type="submit" name="submit">
			</form>
		</div>
	</div>

<script src="popup.js"></script>

</body>
</html>