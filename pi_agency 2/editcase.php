<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>edit</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>

	<a href="viewcases.php?investigator_id=<?php echo $_GET['investigator_id']; ?>">View The Case</a>

	<h1>Edit the Case</h1>

	<?php
		// Check if the required GET parameters are set
		if (isset($_GET['case_id']) && isset($_GET['investigator_id'])) {
			$case_id = $_GET['case_id'];
			$investigator_id = $_GET['investigator_id'];
		} else {
			echo "Invalid access. Case ID or Investigator ID is missing.";
			exit;
		}

		// Fetch the case details by case ID
		$getcasebyid = getcasebyid($pdo, $case_id);
		if ($getcasebyid) {
			$caseName = $getcasebyid['case_name'];
		} else {
			echo "Case not found.";
			exit;
		}
	?>

	<form action="core/handleForms.php?case_id=<?php echo $case_id; ?>&investigator_id=<?php echo $investigator_id; ?>" method="POST">
		<p>
			<label for="casename">Case Name</label>
			<input type="text" name="casename" value="<?php echo $caseName; ?>">
			<input type="submit" name="editcasebtn">
		</p>
	</form>

</body>
</html>
