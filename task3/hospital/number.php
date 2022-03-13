

<?php
session_start();
// if(isset($_SESSION)){
//     header('location: review.php');
//    }

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $phone = $_POST['phone'];
   $errors = [];

    if(empty($phone) ){
        $errors['phone']['em']='<div class="text-danger">* Please Enter Your Number Phone </div>';
      
    }
    if( strlen($phone) < 11){
        $errors['phone']['ln']='<div class="text-danger">* Please Enter 11 digits</div>';

    }

    if(empty($errors)){
        $_SESSION['phone'] = $phone;
        header('location:review.php');
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

            form  .in {
                background-color: #F5F5F5;
                padding: 15px;
                border-radius: 40px 40px 0px 0px;
                margin-bottom: 0 !important;
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
                border-radius: 0px 0px 40px 40px;
                background-color: #F5F5F5;
                height: 57px;
            }
        </style>
        <title>number</title>
    </head>

    <body>
        <h1 class="text-center py-5 fw-bolder">Welcom To Hospital</h1>

        <div class="container ">
            <div class="row ">

                <div class="col-4 mx-auto mt-5">
                    <form method="POST">
                        <div class="mb-3 in">
                            <input type="number" name="phone" placeholder="Enter Your Phone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                     
                        </div>
                        <div class="err">       <?php if(isset($errors['phone']['em'])){
                                    echo $errors['phone']['em'];
                                }

                                 if(isset($errors['phone']['ln'])){
                                    echo $errors['phone']['ln'];
                                }
                             ?></div>
                        <button type="submit" class="btn w-100 mt-3">Submit</button>
                    </form>

                </div>

            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>

    </html>