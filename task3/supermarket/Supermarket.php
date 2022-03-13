<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['userInfo'])) {
        $userName = $_POST['username'];
        $city = $_POST['city'];
        $productNumber = $_POST['numofproducts'];

        $errors = [];

        if (empty($userName)) {
            $errors['userName'] = '<div class="text-danger">* Please Enter Your Name </div>';
        }
        if (empty($city)) {
            $errors['city'] = '<div class="text-danger">* Please Enter Your City </div>';
        }
        if (empty($productNumber)) {
            $errors['productNumber'] = '<div class="text-danger">* Please Enter The Number Of Products </div>';
        }

        if (empty($errors)) {
            $_SESSION['userName'] = $userName;
            $_SESSION['city'] = $city;
            $_SESSION['productNumber'] = $productNumber;

            $products = '
                        <div class="col-9 mx-auto mt-5 products">
                            <form method="POST">
                                <table class="w-100 table table-striped table-success ">';

            for ($i = 1; $i <= $_SESSION['productNumber']; $i++) {

                $products .= '
                                    <tr>
                                        <td>product ' . $i . '</td>
                                        <td>
                                            <input type="text" name="productName[' . $i . ']" placeholder="Enter Your Product Name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">';

                $products .= '
                                        </td>

                                        <td>
                                            <input type="number" name="productPrice[' . $i . ']" placeholder="Enter Your Product Price" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        </td>
                            
                                        <td>
                                            <input type="number" name="productQuantiti[' . $i . ']" placeholder="Enter Your Product Quantiti" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        </td>
                                     </tr>';
            }

            $products .= '
                                </table>
                                <button type="submit" name="productsInfo" class="btn btn-outline-success w-100 rounded-pill mb-5">SUBMIT</button>
                            </form>
                        </div>';
        }
    }

    if (isset($_POST['productsInfo'])) {

        for ($i = 1; $i <= $_SESSION['productNumber']; $i++) {
            $productName[$i] = $_POST['productName'][$i];
            $productPrice[$i] = $_POST['productPrice'][$i];
            $productQuantiti[$i] = $_POST['productQuantiti'][$i];

            $totalPriceProduct[$i] = $productPrice[$i] * $productQuantiti[$i];
        }

        $total = 0;
        foreach ($totalPriceProduct as $key => $value) {
            $total += $value;
        }

        //discount
        if ($total < 1000) {
            $discount = 0;
        } elseif ($total >= 1000 && $total < 3000) {
            $discount = 0.1;
        } elseif ($total >= 3000 && $total < 4500) {
            $discount = 0.15;
        } elseif ($total >= 4500) {
            $discount = 0.20;
        }

        $userName = $_SESSION['userName'];
        $city = $_SESSION['city'];
        $totalDiscount = $total * $discount;
        $totalAfterDiscount = $total - $totalDiscount;



        //delivery
        $delivery = 0;
        if ($city == "cairo") {
            $delivery = 0;
        } elseif ($city == "giza") {
            $delivery = 30;
        } elseif ($city == "alex") {
            $delivery = 50;
        } elseif ($city == "others") {
            $delivery = 100;
        }

        $totalPriceAfterDelivery = $totalAfterDiscount + $delivery;
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
            height: 100%;

            background: linear-gradient(to bottom right, #c8d6e5, #2e86de);
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;

        }

        form .in {
            background-color: #F5F5F5;
            padding: 15px;
            border-radius: 40px;
            margin-bottom: 15px !important;
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
            margin-top: -10px !important;
            margin-bottom: 5px;
        }

        .test {
            height: 10px;
            width: 100%;
            background-color: transparent;
            margin-top: 230px;
        }
    </style>
    <title>SuperMarket</title>
</head>

<body>
    <h1 class="text-center py-5 fw-bolder">Welcom To Super Market</h1>

    <div class="container ">
        <div class="row ">

            <div class="col-4 mx-auto mt-5">
                <form method="POST">
                    <div class="mb-3 in">
                        <input type="text" name="username" placeholder="Enter Your Name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                    <?php if (isset($errors['userName'])) { ?>
                        <div class="err ">
                            <?php echo $errors['userName']; ?>
                        </div>
                    <?php } ?>

                    <div class="mb-3 in">
                        <select name="city" class="form-control">
                            <option value="cairo">Cairo</option>
                            <option value="giza">Giza</option>
                            <option value="alex">Alex</option>
                            <option value="others">Others</option>
                        </select>
                    </div>

                    <?php if (isset($errors['city'])) { ?>
                        <div class="err ">
                            <?php echo $errors['city']; ?>
                        </div>
                    <?php } ?>

                    <div class="mb-3 in">
                        <input type="number" name="numofproducts" placeholder="Enter Quantiti" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                    <?php if (isset($errors['productNumber'])) { ?>
                        <div class="err ">
                            <?php echo $errors['productNumber']; ?>
                        </div>
                    <?php } ?>

                    <button type="submit" name="userInfo" class="btn w-100 mt-3">Submit</button>
                </form>
            </div>

            <?php
            if (isset($products)) {
                echo  $products;
            }
            if (isset($_POST['productsInfo'])) { ?>
                <div class="col-9 mx-auto mt-5 products">
                    <table class="w-100 table table-striped table-success">
                        <tr>
                            <th>Client Name</th>
                            <td class="text-center"><?= $userName ?></td>
                        </tr>

                        <tr>
                            <th>City</th>
                            <td class="text-center"><?= $city ?></td>

                        </tr>

                        <tr>
                            <th>total</th>
                            <td class="text-center"><?= $total ?></td>

                        </tr>

                        <tr>
                            <th>Discount</th>
                            <td class="text-center"><?= $totalDiscount ?></td>

                        </tr>

                        <tr>
                            <th>Total After Discount</th>
                            <td class="text-center"><?= $totalAfterDiscount ?></td>

                        </tr>

                        <tr>
                            <th>Delivery</th>
                            <td class="text-center"><?= $delivery ?></td>
                        </tr>

                        <tr>
                            <th>Total Cost</th>
                            <th class="text-center"><?= $totalPriceAfterDelivery ?></th>
                        </tr>
                    </table>
                </div>
            <?php }
            ?>

        </div>
    </div>
    <div class="test"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>