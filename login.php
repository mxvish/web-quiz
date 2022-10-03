<html>
    <head>
            <link rel="icon" href="pmbok.png">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>結果発表</title>
    </head>
    <body>
        <?php  
        function check($input, $ans){
            if($input == $ans){
                return 10;
            } else {
                return 0;
            }
        }
        
        $q1=check($_POST["q1"], 1);
        $q2=check($_POST["q2"], "wait");
          
        echo 'Welcome: ' . $q1 . ', your password is: ' . $q2 . '<br>
        正解発表<br>
        解説<br>';
        
        /*
        $handle = fopen("counter.txt", "r"); 
        if(!$handle){
            echo "Could not open the file" ;
        } else {
            $counter = ( int ) fread ($handle,20) ;
            fclose ($handle) ;
            $counter++ ; 
            echo "<p>Visitor Count: ". $counter . "</p>";
        
            $conn = mysqli_connect("localhost", "", "", "quiz");
            mysqli_set_charset($conn, "utf8");
            $sql = 'INSERT INTO quiz(user,q1,q2) VALUES (?, ?, ?)';  
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iis", $counter, $q1, $q2);
            $stmt->execute();
            
            $handle = fopen("counter.txt", "w" ) ; 
            fwrite($handle,$counter) ; 
            fclose ($handle) ;
            
        }*/
        
        $conn = mysqli_connect("localhost", "", "", "quiz");
        mysqli_set_charset($conn, "utf8");
        $sql = 'INSERT INTO quiz(q1,q2) VALUES (?, ?)';  
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $q1, $q2);
        $stmt->execute();

        $stmt->close();
        $conn->close();
        ?>  
    </body>
</html>
