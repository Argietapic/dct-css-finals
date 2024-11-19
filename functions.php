<?php    
    session_start();
    function connectDB() {
        $servername = "localhost";
        $email = "root";
        $password = "";
        $dbname = "dct-ccs-finals"; // Your database name

        $conn = new mysqli($servername, $email, $password, $dbname);


        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }    

    function guard() {  
        if (empty($_SESSION["email"])){
             header("Location:/index.php");
         }
        }
    
        function returPage(){
            if (!empty($_SESSION["email"])) {
                if (!empty($_SESSION['page'])) {  // Check if the 'page' session variable is set
                    header("Location:". $_SESSION['page']);
                    exit();
                } else {
                    // If 'page' is not set, redirect to a default page (e.g., dashboard or home)
                    header("Location: /admin/dashboard.php"); // Change to your default redirect page
                    exit();
                }
            }
        }


        function generateError($message) {
            return '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>System Error!</strong> ' . $message . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
    
        function generateError1($message) {
            return '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>System Error!</strong> ' . $message . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }
        function generateSuccess($message) {
            return '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> ' . $message . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }


        function loginUser($email, $password) {

            if (empty($email) || empty($password)) {
                return generateError("<li>Email is required </li><li>Password are required.</li>");
            } elseif (!str_ends_with($email, '@gmail.com')) {
                return generateError("<li>Invalid Email format </li>");
            }
            $conn = connectDB();
            $hashedPassword = md5($password); // Hash the password

            $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $email, $hashedPassword);
            $stmt->execute();
            $result = $stmt->get_result();
        
            if ($result->num_rows > 0) {
                $_SESSION['email'] = $email;
                return true;
            } else {
                return generateError("<li>Invalid email or password.</li>");
            }
        }

        function logoutUser() {
            session_destroy();
            header("Location:/index.php");
        }
       
        function insertSubject($subjectCode, $subjectName) {
            $conn = connectDB();
            // Validate input
            if (empty($subjectCode) || empty($subjectName)) {
                return generateError("<li>Subject Code is required</li><li>Subject Name is required.</li>");
            }
            $query = "SELECT COUNT(*) as count FROM subjects WHERE subject_code = ? OR subject_name = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ss", $subjectCode, $subjectName);  
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            
            if ($row['count'] > 0) {
                return generateError("<li>Duplicate Subject Code or  Subject Name</li>");
            } else {
                $insertQuery = "INSERT INTO subjects (subject_code, subject_name) VALUES (?, ?)";
                $insertStmt = $conn->prepare($insertQuery);
                $insertStmt->bind_param("ss", $subjectCode, $subjectName); // Bind parameters
                if ($insertStmt->execute()) {
                    return generateSuccess("<li>Subject Added Successfully!</li>");
                } else {
                    return generateError("<li>Error adding subject: " . $insertStmt->error . "</li>");
                }
            }
        }


        function fetchAndDisplaySubjects() {
            $conn = connectDB();
            // Query to fetch subjects from the database
            $result = $conn->query("SELECT * FROM subjects");
        
            if ($result->num_rows > 0) {
                while ($subject = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($subject['subject_code']) . '</td>';
                    echo '<td>' . htmlspecialchars($subject['subject_name']) . '</td>';
                    echo '<td>';
                    echo '<a href="edit.php?code=' . urlencode($subject['subject_code']) . '"><button class="btn btn-info ">Edit</button></a>';
                    echo ' ';
                    echo '<a href="delete.php?code=' . urlencode($subject['subject_code']) . '"><button class="btn btn-danger ">Delete</button></a>';
                    echo '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr>';
                echo '<td colspan="3" class="text-center">No subjects found.</td>';
                echo '</tr>';
            }
        }

        

?>