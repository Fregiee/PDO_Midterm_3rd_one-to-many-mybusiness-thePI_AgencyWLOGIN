<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Deletion</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<?php $getcasebyid = getcasebyid($pdo, $_GET['case_id']); ?>
	<h1>Are you sure you want to delete this Case?</h1>
	<div class="container" style="border-style: solid; height: 400px;">
		<h2>Case Name: <?php echo $getcasebyid['case_name'] ?></h2>
		<h2>Case Owner: <?php echo $getcasebyid['case_investigator'] ?></h2>
		<h2>Date Added: <?php echo $getcasebyid['date_added'] ?></h2>

		<div class="deleteBtn" style="float: right; margin-right: 10px;">

			<form action="core/handleForms.php?case_id=<?php echo $_GET['case_id']; ?>&investigator_id=<?php echo $_GET['investigator_id']; ?>" method="POST">
				<input type="submit" name="deletecaseBtn" value="Delete">
			</form>			
			
		</div>	

	</div>
</body>
</html>