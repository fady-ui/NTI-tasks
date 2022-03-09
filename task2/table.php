<?php
$users = [
    (object)[
        'id' => 1,
        'name' => 'ahmed',
        "gender" => (object)[
            'gender' => 'm'
        ],
        'hobbies' => [
            'football', 'swimming', 'running'
        ],
        'activities' => [
            "school" => 'drawing',
            'home' => 'painting'
        ],
    ],
    (object)[
        'id' => 2,
        'name' => 'mohamed',
        "gender" => (object)[
            'gender' => 'm'
        ],
        'hobbies' => [
            'swimming', 'running',
        ],
        'activities' => [
            "school" => 'painting',
            'home' => 'drawing'
        ],
    ],
    (object)[
        'id' => 3,
        'name' => 'menna',
        "gender" => (object)[
            'gender' => 'f'
        ],
        'hobbies' => [
            'running',
        ],
        'activities' => [
            "school" => 'painting',
            'home' => 'drawing'
        ],
    ],
];
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>table</title>
    <style>
        table {
            margin-top: 100px;
        }

        table,
        th,
        td {
            border: 2px solid black;
            border-collapse: collapse;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="container">
        <table class="w-100 ">

            <tr>
                <?php foreach ($users[0] as $key => $val) { ?>
                    <th><?= $key ?></th>
                <?php } ?>
            </tr>

            <?php foreach ($users as $user) { ?>
                <tr>
                    <?php foreach ($user as $key => $val) { ?>
                        <td>
                            <?php if (is_array($val) || is_object($val)) {
                                foreach ($val as $key2 => $val2) {
                                    if ($val2 == "m") {
                                        echo "male";
                                    } elseif ($val2 == "f") {
                                        echo "female";
                                    } else {
                                        echo $val2 . "  ";
                                    }
                                }
                            } else {
                                echo $val . " ";
                            } ?>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>

        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>