<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Operator</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
<h1>RTCO Records. Welcome Operator:  <?php echo $_SESSION['username']; ?></h1>
	<form action="core/handleForms.php" method="POST">
		<p>
			<label for="firstname">First Name</label> 
			<input type="text" name="firstname">
		</p>
		<p>
			<label for="lastname">Last Name</label> 
			<input type="text" name="lastname">
            <input type="submit" name="inserinvestigatorBtn">
		</p>
	</form>
    <?php $getallinvestigator = getallinvestigator($pdo); ?>
    <?php foreach( $getallinvestigator as $row) {?>
        <div class="container" style="border-style: solid; width: 50%; height: 300px; margin-top:20px;">
            <h3>First Name:<?php echo $row['first_name']; ?></h3>
            <h3>Last Name:<?php echo $row['last_name']; ?></h3>
            <h3>Date Added: <?php echo $row['date_added']; ?></h3>
            <h3>Added by: <?php echo $row['added_by']; ?></h3>
            <h3 style="text-align:center">Updated details</h3>
            <h3>Updated by: <?php echo $row['updated_by']; ?></h3>
            <h3>Update timestamp: <?php echo $row['update_timestamp']; ?></h3>

            <div class="editAndDelete" style="float: right; margin-right: 20px;">
			<a href="viewcases.php?investigator_id=<?php echo $row['investigator_id']; ?>">View Cases</a>
			<a href="editinvestigator.php?investigator_id=<?php echo $row['investigator_id']; ?>">Edit</a>
			<a href="deleteinvestigator.php?investigator_id=<?php echo $row['investigator_id']; ?>">Delete</a>
		</div>
        </div>
    <?php } ?>
    <a href="core/handleForms.php?logoutAUser=1">Logout</a>
</body>
</html>