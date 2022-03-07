<?php

if ($_POST) {
    $Physics = $_POST['ph'];
    $Chemistry = $_POST['ch'];
    $Biology = $_POST['bi'];
    $Math = $_POST['ma'];
    $Computer = $_POST['co'];

    define("maxGrade", 50);

    if ($Physics > maxGrade || $Chemistry > maxGrade || $Biology > maxGrade || $Math > maxGrade || $Computer > maxGrade) {
        $Errormessage = "Please Enter Your Real Grades";
    } elseif ($Physics < 0 || $Chemistry < 0 || $Biology < 0 || $Math < 0 || $Computer < 0) {
        $Errormessage =  "Please Enter Your Real Grades";
    } else {

        $score = ($Physics + $Chemistry + $Biology + $Math + $Computer);
        $gradePercentage =  ($score / (maxGrade * 5)) * 100;

        if ($gradePercentage >= 90) {
            $grade = "A";
        } elseif ($gradePercentage >= 80 && $gradePercentage < 90) {
            $grade = "B";
        } elseif ($gradePercentage >= 70 && $gradePercentage < 80) {
            $grade = "C";
        } elseif ($gradePercentage >= 60 && $gradePercentage < 70) {
            $grade = "D";
        } elseif ($gradePercentage >= 40 && $gradePercentage < 60) {
            $grade = "E";
        } else {
            $grade = "F";
        }

        $message = "Your Score = " . $score . " / " . maxGrade * 5 . "<br> Your Grade In Percentage = " . $gradePercentage . "% <br>
                Your Grade Is " . $grade;
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Calculate Your Grade</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-6 mx-auto text-center mt-5 h1 fw-bolder text-primary">
                Calculate Your Grade
            </div>
        </div>
        <div class="row">

            <div class="col-4 mx-auto mt-5">
                <form method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Enter your Grade of Physics [Out Of 50]</label>
                        <input type="number" name="ph" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Enter your Grade of Chemistry [Out Of 50]</label>
                        <input type="number" name="ch" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Enter your Grade of Biology [Out Of 50]</label>
                        <input type="number" name="bi" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Enter your Grade of Mathematics [Out Of 50]</label>
                        <input type="number" name="ma" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Enter your Grade of Computer [Out Of 50]</label>
                        <input type="number" name="co" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>


                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>
        </div>
        <div class="row">

            <div class="col-4  mx-auto mt-5">

                <?php if (isset($message)) {
                ?>
                    <div class="alert <?php if ($grade == "F") {
                                            echo "alert-danger";
                                        } else {
                                            echo "alert-success";
                                        } ?>  ">
                        <?php
                        echo  $message;
                        ?>
                    </div>
                <?php
                } elseif (isset($Errormessage)) {
                ?>
                    <div class="alert alert-danger text-center">
                        <?php
                        echo  $Errormessage;
                        ?>
                    </div>
                <?php
                }
                ?>

            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>