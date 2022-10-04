<html>
    <head>
        <link rel="icon" href="pmbok.png">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>結果発表</title>
        <style>
            body {
              text-align: center;
            }
        </style>
    </head>
    <body>
        <?php  
//        class Question {
//            public $quiz;
//            public $answer;
//            public $score;
//            public function __construct($quiz, $answer) {
//                $this->quiz = $quiz;
//                $this->answer = $answer;
//                $this->score = check($_POST[$quiz], $answer);
//            }
//        
//            public function message() {
//                return "My car is a " . $this->quiz . " " . $this->answer . "!";
//            }
//        }
// refer to https://www.w3schools.com/php/php_oop_classes_objects.asp ?
        
        //$q1 = new Question("q1", 1);
        //echo $myQuestion -> message();
        //$myQuestion = new Question("red", "Toyota");
        //echo $myQuestion -> message();

        function check($input, $ans){
            if($input == $ans){
                return 10;
            } else {
                return 0;
            }
        }

        $quiz="q1";
        $q1answer=1;
        $q1score=check($_POST[$quiz], $q1answer);

        echo '<h1>正解発表</h1>
        <h2>' . strtoupper($quiz) . '</h2>';
        if($q1score == 10){
            echo '<h3 style="color:DodgerBlue">正解！</h3>';
        } else {
            echo '<h3 style="color:red">不正解</h3>';
        }

        echo '
        <h3>あなたの回答：' . $_POST[$quiz] . '</h3>
        <h3>正解：' . $q1answer . '</h3>

        <center><div style="white-space:pre">
        <b>解説</b><br>
        浜松キャンパスの住所は浜松市中区城北3-5-1です。
        詳しくは下のページを参考にしてください。
        <a href="https://www.shizuoka.ac.jp/access/#h2%20under">交通アクセス｜静岡大学</a>
        </div></center><br style="line-height:100px;">';


        $quiz="q2";
        $q2answer="wait";
        $q2score=check($_POST["q2"], $q2answer);

        echo '<h2>'. strtoupper($quiz) . '</h2>';
        if($q2score == 10){
            echo '<h3 style="color:DodgerBlue">正解！</h3>';
        } else {
            echo '<h3 style="color:red">不正解</h3>';
        }

        echo '
        <h3>あなたの回答：' . $_POST[$quiz] . '</h3>
        <h3>正解：' . $q2answer . '</h3>

        <center><div style="white-space:pre">
        <b>解説</b><br>
        w8はwaitのことです。
        スラングではwaitのaitを8と表記します。
        </div></center>';
        
        $conn = mysqli_connect("localhost", "", "", "quiz");
        mysqli_set_charset($conn, "utf8");
        $sql = 'INSERT INTO quiz(q1,q2) VALUES (?, ?)';  
        $stmt = $conn->prepare($sql);
        echo $scores[0];
        $stmt->bind_param("is", $q1score, $q2score);
        $stmt->execute();

        $stmt->close();
        $conn->close();
        ?>  
    </body>
</html>
