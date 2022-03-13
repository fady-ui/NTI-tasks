<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userName = $_POST['name'];
    $loanAmount = $_POST['lamount'];
    $years = $_POST['lyear'];

    $errors = [];

    if (empty($userName)) {
        $errors['userName'] = '<div class="text-danger">* Please Enter Your Name </div>';
    }

    if (empty($loanAmount)) {
        $errors['loanAmount'] = '<div class="text-danger">* Please Enter Loan Amount </div>';
    }

    if (empty($years)) {
        $errors['years'] = '<div class="text-danger">* Please Enter Loan Yesrs </div>';
    }

    if(empty($errors)){
        if($years <= 3 && $years > 0){
            $interest = 0.1;
        }elseif($years > 3){
            $interest = 0.15;
        }

        $interestPerYear = $loanAmount * $interest;
        $totalInterestRate = $interestPerYear * $years;
        $loanAfterInterest = $totalInterestRate + $loanAmount;

        $monthly = $loanAfterInterest / ($years * 12);

        //echo $years . "<br>" . $interest . "<br>" . $interestPerYear . "<br>" . $totalInterestRate . "<br>" . $loanAfterInterest . "<br>" . $monthly;
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

    <style>
        body {
            height: 100vh;

            background: linear-gradient(to bottom right, #c8d6e5, #2e86de);
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;

        }

        form .in {
            background-color: #F5F5F5;
            padding: 15px;
            border-radius: 40px;
            margin-bottom: 10 !important;

        }

        form .in .form-control {
            background-color: transparent;
            border: none;
            outline: none;
            color: gray;

        }

        form .in .form-control:focus {
            background-color: transparent;
            border: none;
            outline: none;
            color: gray;
            box-shadow: none;
        }

        h1 {
            color: #fff;
        }

        form .btn {
            border-radius: 40px;
            background-color: #F5F5F5;
            height: 57px;
        }

        .err {
            margin-left: 20px;
            margin-top: -10px;
            margin-bottom: 10px;
        }
    </style>
    <title>number</title>
</head>

<body>
    <h1 class="text-center py-5 fw-bolder">Welcom To Bank</h1>

    <div class="container ">
        <div class="row ">

            <div class="col-4 mx-auto mt-5">
                <form method="POST">
                    <div class="mb-3 in">
                        <input type="text" name="name" placeholder="Enter Your Name" value="<?php if(isset($_POST['name'])){echo $_POST['name'];} ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                    <?php if (isset($errors['userName'])) { ?>
                        <div class="err">
                            <?php echo $errors['userName']; ?>
                        </div>
                    <?php  } ?>

                    <div class="mb-3 in">
                        <input type="number" name="lamount" placeholder="Enter Loan Amount" value="<?php if(isset($_POST['lamount'])){echo $_POST['lamount'];} ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                    <?php if (isset($errors['loanAmount'])) { ?>
                        <div class="err">
                            <?php echo $errors['loanAmount']; ?>
                        </div>
                    <?php  } ?>

                    <div class="mb-3 in">
                        <input type="number" name="lyear" placeholder="Enter Loan Years" value="<?php if(isset($_POST['lyear'])){echo $_POST['lyear'];} ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                    <?php if (isset($errors['years'])) { ?>
                        <div class="err">
                            <?php echo $errors['years']; ?>
                        </div>
                    <?php  } ?>

                    <button type="submit" name="loan" class="btn w-100 mt-3">Calculate Loan</button>
                </form>

            </div>

        </div>

        <!-- result table -->
        <div class="row mt-5">
            <div class="col-9 mx-auto">
                <?php 
                if(isset($_POST['loan'])){
                    if(empty($errors)){
                   ?>
                        <table class="w-100 table table-striped table-success">
                    <tr>
                        <th class="text-center">User Name</th>
                        <th class="text-center">Interest Rate</th>
                        <th class="text-center">Loan After Interest</th>
                        <th class="text-center">Monthly</th>

                    </tr>

                    <tr>
                        <td class="text-center"><?= $userName ?></td>
                        <td class="text-center"><?= $totalInterestRate ?></td>
                        <td class="text-center"><?= $loanAfterInterest ?></td>
                        <td class="text-center"><?= $monthly ?></td>

                    </tr>






                </table>
                  <?php  
                }
            }
                ?>
                
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>