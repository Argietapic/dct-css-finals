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
                $_SESSION['password'] = $password;
                return true;
            } else {

            }
        }
?>