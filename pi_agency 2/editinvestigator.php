<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>edit</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php $getinvestigatorbyid = getinvestigatorbyid($pdo, $_GET['investigator_id']);?>
    <h1>Edit Investigator</h1>
    <form action="core/handleForms.php?investigator_id=<?php echo $_GET['investigator_id'];?>" method="POST">
        <p>
            <label for="firstname">First name</label>
            <input type="text" name="firstname" value="<?php echo $getinvestigatorbyid['first_name'];?>">
        </p>
        <p>
            <label for="lastname">Last name</label>
            <input type="text" name="lastname" value="<?php echo $getinvestigatorbyid['last_name'];?>">
            <input type="submit" name="editinvestigatorbtn">
        </p>
    </form>
</body>
</html>