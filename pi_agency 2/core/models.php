    <?php
    
    require_once 'dbConfig.php';


    function insertNewUser($pdo, $username, $password) {

        $checkUserSql = "SELECT * FROM user_passwords WHERE username = ?";
        $checkUserSqlStmt = $pdo->prepare($checkUserSql);
        $checkUserSqlStmt->execute([$username]);
    
        if ($checkUserSqlStmt->rowCount() == 0) {
    
            $sql = "INSERT INTO user_passwords (username,password) VALUES(?,?)";
            $stmt = $pdo->prepare($sql);
            $executeQuery = $stmt->execute([$username, $password]);
    
            if ($executeQuery) {
                $_SESSION['message'] = "User successfully inserted";
                return true;
            }
    
            else {
                $_SESSION['message'] = "An error occured from the query";
            }
    
        }
        else {
            $_SESSION['message'] = "User already exists";
        }
    
        
    }
    
    
    
    function loginUser($pdo, $username, $password) {
        $sql = "SELECT * FROM user_passwords WHERE username=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username]); 
    
        if ($stmt->rowCount() == 1) {
            $userInfoRow = $stmt->fetch();
            $usernameFromDB = $userInfoRow['username']; 
            $passwordFromDB = $userInfoRow['password'];
    
            if ($password == $passwordFromDB) {
                $_SESSION['username'] = $usernameFromDB;
                $_SESSION['message'] = "Login successful!";
                return true;
            }
    
            else {
                $_SESSION['message'] = "Password is invalid, but user exists";
            }
        }
    
        
        if ($stmt->rowCount() == 0) {
            $_SESSION['message'] = "Username doesn't exist from the database. You may consider registration first";
        }
    
    }
    
    function getAllUsers($pdo) {
        $sql = "SELECT * FROM user_passwords";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute();
    
        if ($executeQuery) {
            return $stmt->fetchAll();
        }
    
    }
    
    function getUserByID($pdo, $user_id) {
        $sql = "SELECT * FROM user_passwords WHERE user_id = ?";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$user_id]);
        if ($executeQuery) {
            return $stmt->fetch();
        }
    }
    




    function insertinvestigator($pdo, $added_by, $first_name, $last_name,$updated_by){
        $sql = "INSERT INTO investigators(added_by,first_name,last_name,updated_by) VALUES(?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$added_by,$first_name, $last_name,$updated_by]);
        if($executeQuery){
            return true;
        }
    }

    function getallinvestigator($pdo){
        $sql = "SELECT * FROM investigators";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute();
        if($executeQuery){
            return $stmt->fetchAll();
        }
    }

    function getinvestigatorbyid($pdo, $investigator_id){
        $sql = "SELECT * FROM investigators WHERE investigator_id = ?";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$investigator_id]);
        if($executeQuery){
            return $stmt->fetch();
        }
    }

    function updateinvestigator($pdo, $first_name, $last_name, $investigator_id, $updated_by){
        $sql = "UPDATE investigators
                        SET first_name = ?,
                            last_name = ?,
                            updated_by = ?,
                            update_timestamp = CURRENT_TIMESTAMP
                        WHERE investigator_id = ?
                ";

        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$first_name, $last_name, $updated_by, $investigator_id]);
        if($executeQuery){
            return true;
        }
    }

    function deleteinvestigator($pdo, $investigator_id){
        $deleteinvestigatorcase = "DELETE FROM cases WHERE investigator_id = ?";
        $deletesmt = $pdo->prepare($deleteinvestigatorcase);
        $executedeletequery = $deletesmt->execute([$investigator_id]);
        if($executedeletequery){
            $sql = "DELETE FROM investigators WHERE investigator_id = ?";
            $stmt = $pdo->prepare($sql);
            $executeQuery = $stmt->execute([$investigator_id]);
            if($executeQuery){
                return true;
            }
        }
    }

    function getcasesbyinvestigator($pdo, $investigator_id){
        $sql =" SELECT
                    cases.case_id AS case_id,
                    cases.added_by AS added_by,
                    cases.case_name AS case_name,
                    cases.date_added AS date_added,
                    cases.updated_by AS updated_by,
                    cases.update_timestamp AS update_timestamp,
                    CONCAT(investigators.first_name,'',investigators.last_name)AS case_investigator
                FROM cases
                JOIN investigators ON cases.investigator_id = investigators.investigator_id
                WHERE cases.investigator_id = ?
                GROUP BY cases.case_name;
                ";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$investigator_id]);
        if($executeQuery){
            return $stmt->fetchAll();
        }
    }
    function insertcase($pdo,$added_by, $case_name, $investigator_id,$updated_by){
        $sql = "INSERT INTO cases(added_by,case_name,investigator_id,updated_by) VALUES (?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $executecasequery = $stmt->execute([$added_by,$case_name,$investigator_id,$updated_by]);
        if($executecasequery){
            return true;
        }
    }

    function getcasebyid($pdo, $case_id){
        $sql =  "SELECT
                    cases.case_id AS case_id,
                    cases.case_name AS case_name,
                    cases.date_added AS date_added,
                    CONCAT(investigators.first_name,'',investigators.last_name)AS case_investigator
                FROM cases
                JOIN investigators ON cases.investigator_id = investigators.investigator_id
                WHERE cases.case_id = ?
                GROUP BY cases.case_name;
                ";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$case_id]);
        if($executeQuery){
            return $stmt->fetch();
        }
    }

    function updatecase($pdo, $case_name, $case_id,$updated_by){
        $sql = "UPDATE cases
                        SET case_name = ?, updated_by = ?, update_timestamp = CURRENT_TIMESTAMP
                        WHERE case_id = ?
                ";

        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$case_name,$updated_by, $case_id]);
        if($executeQuery){
            return true;
        }
    }
    function deletecase($pdo,$case_id){
        $sql = "DELETE FROM cases WHERE case_id = ?";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$case_id]);
        if($executeQuery){
            return true;
        }
    }
?>