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
        class Question {
            public $quiz;
            public $answer;
            public $score;

            public function __construct($quiz, $answer) {
                $this->quiz = $quiz;
                $this->answer = $answer;
            }
        
            function set_score() {
                if($_POST[$this->quiz] == $this->answer){
                    $this->score = 10;
                } else {
                    $this->score = 0;
                }
            }

            function get_score() {
                return $this->score;
            }

            function print_explanation($text) {
                echo '<h2>' . strtoupper($this->quiz) . '</h2>';
                if($this->score == 10){
                    echo '<h3 style="color:DodgerBlue">正解！</h3>';
                } else {
                    echo '<h3 style="color:red">不正解</h3>';
                }
        
                echo '
                <h3>あなたの回答：' . $_POST[$this->quiz] . '</h3>
                <h3>正解：' . $this->answer . '</h3>
        
                <center><div style="white-space:pre"><b>解説</b><br>' . $text . '
                </div></center><br style="line-height:100px;">';
            }
        }
        
        echo '<h1>正解発表</h1>';

        $q1 = new Question("q1", 1);
        $q1->set_score();
        $q1->print_explanation('浜松キャンパスの住所は浜松市中区城北3-5-1です。
詳しくは下のページを参考にしてください。
<a href="https://www.shizuoka.ac.jp/access/#h2%20under">交通アクセス｜静岡大学</a>');

        $q2 = new Question("q2", "wait");
        $q2->set_score();
        $q2->print_explanation('w8はwaitのことです。
スラングではwaitのaitを8と表記します。');

        $conn = mysqli_connect("localhost", "", "", "quiz");
        mysqli_set_charset($conn, "utf8");
        $sql = 'INSERT INTO quiz(q1,q2) VALUES (?, ?)';  
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $q1->get_score(), $q2->get_score());
        $stmt->execute();

        $stmt->close();
        $conn->close();
        ?>  
    </body>
</html>
