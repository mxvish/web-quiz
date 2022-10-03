<html>
    <head>
        <link rel="icon" href="pmbok.png">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>集計結果</title>
        <style>
            table {
                font-size: 200%;
                margin-left: auto; 
                margin-right: auto;
            }
            td {
                text-align: right;
            }
        </style>
    </head>
    <body>
        <table>
            <tr>
                <th>Q1</th>
                <th>Q2</th>
                <th>合計点</th>
                <th>順位</th>
            </tr>
            <?php
            $conn = mysqli_connect("localhost", "", "", "quiz");
            //$sql = 'INSERT INTO quiz(q1,q2) VALUES (2, "three")';
            $sql = 'DELETE FROM quiz WHERE q1=1';
            if(!mysqli_query($conn, $sql)){  
                echo "Could not update record: ". mysqli_error($conn);  
            }  
              
            $sql = "SELECT q1, q2, q1+q2 AS total, RANK()OVER(ORDER BY total DESC) AS rank FROM quiz ORDER BY total DESC";
            $table = $conn->query($sql);

            while ($row = $table-> fetch_assoc()) {
                echo "<tr><td>" . $row["q1"] . "</td><td>" . $row["q2"] . "</td><td>" . $row["total"] . "</td><td>" . $row["rank"] ."</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </body>
</html>
