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
   
        }
    }

?>