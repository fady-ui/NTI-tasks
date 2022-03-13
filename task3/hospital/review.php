<?php
session_start();
// if(!isset($_SESSION)){
//  header('location:number.php');
  
// }
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  // $errors=[];
  // if(isset($res1) || isset($res2) || isset($res3) || isset($res4) || isset($res5)  ){
  //   $res1 = $_POST['q1'];
  //   $res2 = $_POST['q2'];
  //   $res3 = $_POST['q3'];
  //   $res4 = $_POST['q4'];
  //   $res5 = $_POST['q5'];

  //   $_SESSION['results']['res1'] = $res1;
  //   $_SESSION['results']['res2'] = $res2;
  //   $_SESSION['results']['res3'] = $res3;
  //   $_SESSION['results']['res4'] = $res4;
  //   $_SESSION['results']['res5'] = $res5;
  
  //   header("location:result.php");
  
  
  // }else{
  //   $errors['questions'] = '<div class="alert alert-danger"> Please Fill All Questions</div>';
  // }



 $res1 = $_POST['q1'];
    $res2 = $_POST['q2'];
    $res3 = $_POST['q3'];
    $res4 = $_POST['q4'];
    $res5 = $_POST['q5'];

    $_SESSION['results']['res1'] = $res1;
    $_SESSION['results']['res2'] = $res2;
    $_SESSION['results']['res3'] = $res3;
    $_SESSION['results']['res4'] = $res4;
    $_SESSION['results']['res5'] = $res5;
  
    header("location:result.php");


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
                overflow-x: hidden;

            }
            h1 {
                color: #fff;
            }

    </style>

    <title>Review</title>
  </head>
  <body>
  <h1 class="text-center py-5 fw-bolder">Please Make This Review</h1>

  <div class="contaoner">
    <div class="row">
      <div class="col-9 mx-auto">
        <?php 
          if(isset($errors['questions'])){
            echo $errors['questions'];
          }
        ?>
      <form  method="POST">
        <table class="w-100 table table-striped table-success">
          <tr>
            <th>Questions</th>
            <th class="text-center">Bad</th>
            <th class="text-center">Good</th>
            <th class="text-center">Very Good</th>
            <th class="text-center">Excellent</th>
          </tr>

          <tr>
            <th>Are you satisfied with the level of cleanliness?</th>
            <td class="text-center"><input type="radio" name="q1" value="0" ></td>
            <td class="text-center"><input type="radio" name="q1" value="3" ></td>
            <td class="text-center"><input type="radio" name="q1" value="5" ></td>
            <td class="text-center"><input type="radio" name="q1" value="10" ></td>
          </tr>

          <tr>
          <th>Are you satisfied with the service prices?</th>
          <td class="text-center"><input type="radio" name="q2" value="0" ></td>
            <td class="text-center"><input type="radio" name="q2" value="3" ></td>
            <td class="text-center"><input type="radio" name="q2" value="5" ></td>
            <td class="text-center"><input type="radio" name="q2" value="10" ></td>
          </tr>

          <tr>
          <th>Are you satisfied with the nursing service</th>
          <td class="text-center"><input type="radio" name="q3" value="0" ></td>
            <td class="text-center"><input type="radio" name="q3" value="3" ></td>
            <td class="text-center"><input type="radio" name="q3" value="5" ></td>
            <td class="text-center"><input type="radio" name="q3" value="10" ></td>
          </tr>

          <tr>
          <th>Are you satisfied with the level of the doctor?</th>
          <td class="text-center"><input type="radio" name="q4" value="0" ></td>
            <td class="text-center"><input type="radio" name="q4" value="3" ></td>
            <td class="text-center"><input type="radio" name="q4" value="5" ></td>
            <td class="text-center"><input type="radio" name="q4" value="10" ></td>
          </tr>

          <tr>
          <th>Are you satisfied with the calmness in the hospital?</th>
          <td class="text-center"><input type="radio" name="q5" value="0" ></td>
            <td class="text-center"><input type="radio" name="q5" value="3" ></td>
            <td class="text-center"><input type="radio" name="q5" value="5" ></td>
            <td class="text-center"><input type="radio" name="q5" value="10" ></td>
          </tr>
        </table>
 

        <button type="submit" class="btn btn-success w-100 rounded-pill">SUBMIT</button>
      </form> 


      </div>
    </div>
  </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>