    <?php
    require_once 'dbConfig.php';
    require_once 'models.php';

    if (isset($_POST['registerUserBtn'])) {

        $username = $_POST['username'];
        $password = sha1($_POST['password']);
    
        if (!empty($username) && !empty($password)) {
    
            $insertQuery = insertNewUser($pdo, $username, $password);
    
            if ($insertQuery) {
                header("Location: ../login.php");
            }
            else {
                header("Location: ../register.php");
            }
        }
    
        else {
            $_SESSION['message'] = "Please make sure the input fields 
            are not empty for registration!";
    
            header("Location: ../login.php");
        }
    
    }
    
    
    
    
    if (isset($_POST['loginUserBtn'])) {
    
        $username = $_POST['username'];
        $password = sha1($_POST['password']);
    
        if (!empty($username) && !empty($password)) {
    
            $loginQuery = loginUser($pdo, $username, $password);
        
            if ($loginQuery) {
                header("Location: ../operatorHome.php");
            }
            else {
                header("Location: ../login.php");
            }
    
        }
    
        else {
            $_SESSION['message'] = "Please make sure the input fields 
            are not empty for the login!";
            header("Location: ../login.php");
        }
     
    }
    
    
    
    if (isset($_GET['logoutAUser'])) {
        unset($_SESSION['username']);
        header('Location: ../login.php');
    }
    





    if(isset($_POST['inserinvestigatorBtn'])){
        $query = insertinvestigator($pdo, $_SESSION['username'],$_POST['firstname'], $_POST['lastname'], $_SESSION['username']);
        if($query){
            header("Location: ../operatorHome.php");
        }else{
            echo "Insertion failed";
        }
    }

    if(isset($_POST['editinvestigatorbtn'])){
        $investigator_id = $_GET['investigator_id'];
        $query = updateinvestigator ($pdo, $_POST['firstname'], $_POST['lastname'], $investigator_id, $_SESSION['username']);
        if($query){
            header("Location: ../operatorHome.php");
        }else{
            echo "Insertion failed";
        }
    }
    
    if(isset($_POST['deleteinvestigatorBtn'])){
        $query = deleteinvestigator($pdo, $_GET['investigator_id']);
        if($query){
            header("Location: ../operatorHome.php");
        }else{
            echo "Insertion failed";
        }
    }

    if(isset($_POST['insertnewcaseBtn'])){
        $query = insertcase($pdo, $_SESSION['username'], $_POST['case_name'], $_GET['investigator_id'], $_SESSION['username']);
        if($query){
            header("Location: ../operatorHome.php");
        }else{
            echo "Insertion failed";
        }
    }

    if (isset($_POST['editcasebtn'])) {
        // Ensure the variables match the form input names
        $case_name = $_POST['casename'];  // This should match the form input name "casename"
        $case_id = $_GET['case_id'];  // Since we are getting the case_id from the URL
        
        // Call the update function with correct parameters
        $query = updatecase($pdo, $case_name, $case_id, $_SESSION['username']);

        if ($query) {
            // Corrected header location with proper concatenation
            header("Location: ../viewcases.php?investigator_id=" . $_GET['investigator_id']);
            exit; // Always use exit after header redirection to stop further execution
        } else {
            echo "Update failed";
        }
    }

    if (isset($_POST["deletecaseBtn"])) {
            $query = deletecase($pdo, $_GET["case_id"]);
            if($query){
                header("Location: ../viewcases.php?investigator_id=".$_GET['investigator_id']);
            }
            else{
                echo "Deletion field";
            }
    }

?>