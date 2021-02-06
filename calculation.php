<?php
	
	/* Подключение к БД */
	function getConnection()
	{
		$dsn = "mysql:host=127.0.0.1;dbname=slonw";
		$db = new PDO($dsn, 'root', '');
		$db->exec("set names utf8");

		return $db;

	}

	/* 
	 * Функция расчета числа Фибоначчи по порядковому номеру и занесение нового значения в БД
	 * Также проверяется наличие результата по порядковому номеру, если таковой имеется, то новый рассчет
	 * не производится
	 */
	function calculation(int $num)
	{

		$db = getConnection();

		$sql = 'SELECT number, result FROM results WHERE number = :number';

		$result = $db->prepare($sql);
		$result->bindParam(':number', $num, PDO::PARAM_INT);
		$result->execute();
		foreach ($result as $row)
		{

			$cache['number'] = $row['number'];
			$cache['result'] = $row['result'];
 
		}

		if (isset($cache))
		{

			header('Location: /?number=' . $cache['number'] . '&result=' . $cache['result']);

			return true;
			
		}

			$arr = array();
			$arr[1] = 0;
			$arr[2] = 1;
			
			for ($i = 3; $i <= $num; $i++)
			{

				$arr[$i] = $arr[$i-1] + $arr[$i-2];

			}

			$db = getConnection();

			$sql = 'INSERT INTO results (number, result) VALUES (:number, :result)';
				
				$result = $db->prepare($sql);
				$result->bindParam(':number', $num, PDO::PARAM_INT);
				$result->bindParam(':result', $arr[$num], PDO::PARAM_INT);
				
				$result->execute();

			header('Location: /?number=' . $num . '&result=' . $arr[$num]);

			return true;


	}

	/*
	 * Проверка наличия отправленного запроса по форме и подготовка данных для функции расчета
	 */

	if(isset($_POST['submit']))
	{
		$num = $_POST['num'];
		$num = htmlspecialchars($num);
		$num = urldecode($num);
		$num = trim($num);

		calculation($num);

	}