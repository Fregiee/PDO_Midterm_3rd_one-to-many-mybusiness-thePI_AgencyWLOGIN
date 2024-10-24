<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>View</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<a href="operatorHome.php">Return to home</a>
	<?php $getinvestigatorbyid = getinvestigatorbyid($pdo,$_GET['investigator_id']); ?>
	<h1>Name: <?php echo $getinvestigatorbyid['first_name']; ?></h1>
	<h1>Add New Case</h1>
	<form action="core/handleForms.php?investigator_id=<?php echo $_GET['investigator_id']; ?>" method="POST">
		<p>
			<label for="casename">Case Name</label> 
			<input type="text" name="case_name">
            <input type="submit" name="insertnewcaseBtn">
		</p>
		
	</form>

	<table style="width:100%; margin-top: 50px;">
	  <tr>
	    <th>Case ID</th>
		<th>Added by</th>
	    <th>Case Name</th>
	    <th>Case Investigator</th>
	    <th>Date Added</th>
		<th>Updated by</th>
		<th>Update timestamp</th>
	  </tr>
	  <?php $getcasesbyinvestigator = getcasesbyinvestigator($pdo, $_GET['investigator_id']); ?>
	  <?php foreach ($getcasesbyinvestigator as $row) { ?>
	  <tr>
	  	<td><?php echo $row['case_id']; ?></td>
		<td><?php echo $row['added_by']; ?></td>	  	
	  	<td><?php echo $row['case_name']; ?></td>	  	  	
	  	<td><?php echo $row['case_investigator']; ?></td>	  	
	  	<td><?php echo $row['date_added']; ?></td>
		<td><?php echo $row['updated_by']; ?></td>
		<td><?php echo $row['update_timestamp']; ?></td>
	  	<td>
	  		<a href="editcase.php?case_id=<?php echo $row['case_id']; ?>&investigator_id=<?php echo $_GET['investigator_id']; ?>">Edit</a>

	  		<a href="deletecase.php?case_id=<?php echo $row['case_id']; ?>&investigator_id=<?php echo $_GET['investigator_id']; ?>">Delete</a>
	  	</td>	  	
	  </tr>
	<?php } ?>
	</table>

	
</body>
</html>