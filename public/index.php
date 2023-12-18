<?php

use Calculation\FindByConsistent;
use Calculation\FindByIndex;
use Calculation\GenerateDocumentFieldIndex;

require '../vendor/autoload.php';

$errorText = null;
$resultGenerateText = null;

$resultListByIndex = null;
$findOperationCountByIndex = 0;
$resultListByConsistent = null;
$findOperationCountByConsistent = 0;

if (!empty($_GET['calculate'])) {
	if (empty($_GET['name'])) {
		$errorText = 'please insert name';
	}

	if (is_null($errorText)) {
		$insertToIndex = new GenerateDocumentFieldIndex();
		$insertToIndex->generate($_GET['name']);

		$resultGenerateText = 'Index generated successfully';
	}
}

if (isset($_GET['find'])) {
	if (empty($_GET['name']) || empty($_GET['value'])) {
		$errorText = 'please insert name and value';
	}

	if (is_null($errorText)) {
		$findByIndex = new FindByIndex();
		$resultListByIndex = $findByIndex->find($_GET['name'], $_GET['value']);
		$findOperationCountByIndex = $findByIndex->getCount();

		$findByConsistent = new FindByConsistent();
		$resultListByConsistent = $findByConsistent->find($_GET['name'], $_GET['value']);
		$findOperationCountByConsistent = $findByConsistent->getCount();
	}
}

?>

<!DOCTYPE html>
<html lang="EN">

<head>
	<title>Styled Form</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f4f4f4;
			text-align: center;
		}

		form {
			max-width: 300px;
			margin: 0 auto;
			background-color: #ffffff;
			padding: 20px;
			border-radius: 5px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
		}

		.result-block {
			display: flex;
			justify-content: center;
		}
		.result {
			max-width: 300px;
			background-color: #ffffff;
			margin: 20px;
			border-radius: 5px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
			text-align: left;
		}

		#calculate_form {
			margin-top: 10px;
		}

		label {
			display: block;
			font-weight: bold;
			margin-top: 10px;
		}

		input[type="text"] {
			width: 80%;
			padding: 10px;
			margin-top: 5px;
			margin-bottom: 10px;
			border: 1px solid #ccc;
			border-radius: 3px;
		}

		button {
			width: 49%;
			padding: 10px;
			background-color: #007bff;
			color: #fff;
			border: none;
			border-radius: 3px;
			cursor: pointer;
			font-weight: bold;
		}

		button:hover {
			background-color: #0056b3;
		}

		.button-container {
			display: flex;
			justify-content: center;
		}
	</style>
</head>

<body>

<span style="color: red"><?= $errorText; ?></span>

<div>
	<form method="GET">
		<label for="name">Name:</label>
		<input type="text" id="name" name="name" placeholder="Enter name">

		<label for="value">Value:</label>
		<input type="text" id="value" name="value" placeholder="Enter value">

		<div class="button-container">
			<button name="find" type="submit" id="findButton" value="1">Find</button>
		</div>
	</form>
</div>

<div>
	<form id="calculate_form" method="GET">
		<span><?= !is_null($resultGenerateText) ? $resultGenerateText : "" ?></span>

		<label for="name">Name:</label>
		<input type="text" id="name" name="name" placeholder="Enter name">

		<div class="button-container">
			<button name="calculate" type="submit" id="calculateButton" value="1">Generate Index</button>
		</div>
	</form>
</div>

<?php
if (isset($_GET['find']) && !empty(is_null($errorText))) {
	?>
	<div class="result-block">
		<div class="result">
			<label for="name">Operation Count By Index: <?= $findOperationCountByIndex; ?></label>

			<pre>
			<?php
			var_dump($resultListByIndex);
			?>
			</pre>
		</div>

		<div class="result">
			<label for="name">Operation Count By Consistent: <?= $findOperationCountByConsistent; ?></label>

			<pre>
			<?php
			var_dump($resultListByConsistent);
			?>
			</pre>
		</div>
	</div>
<?php } ?>
</body>

</html>
