<?php
error_reporting(E_ALL & ~E_NOTICE);
    $string1 = $_POST['id1'];
    $string2 = $_POST['id2'];

    $string1 = trim($string1);
    $string2 = trim($string2);
    $string1Arr = explode(' ',$string1);
    $string2Arr = explode(' ',$string2);
    $string1Arr = array_filter($string1Arr);
    $string2Arr = array_filter($string2Arr);
    $string1Arr = array_values($string1Arr);
    $string2Arr = array_values($string2Arr);
    $maxLenStrings = max(count($string2Arr),count($string1Arr));

    $newmas = array();
    for($i = 0; $i<$maxLenStrings;$i++) {
//        if ($i > count($string1Arr)) {
//            for ($j = $maxLenStrings - $i+1; $j < $maxLenStrings; $j++) {
//                $newmas[] = $string2Arr[$j];
//            }
//            break;
//        }
//        if ($i > count($string2Arr)) {
//            for ($j = $maxLenStrings - $i+1; $j < $maxLenStrings; $j++) {
//                $newmas[] = $string1Arr[$j];
//            }
//            break;
//        }
            $newmas[] = $string1Arr[$i];
            $newmas[] = $string2Arr[$i];
    }
    $newpole = null;
    $newpole = implode(" ",$newmas);

    $newmas = array_filter($newmas);
    $newmas = array_values($newmas);
?>
<html lang="ru">
<head>
    <meta charset="utf8">
    <title>Страничка с полем ввода и полем вывода</title>
    <style>
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 100px;
        }

        .input-field {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="input-field">
        <form action="dz2.php" method="POST">
            <input type="text" id="id1" name="id1"
                   value="<?php echo isset($_POST['id1']) ? $_POST['id1'] : ''; ?>"/>
            <input type="text" id="id2" name="id2"
                   value="<?php echo isset($_POST['id2']) ? $_POST['id2'] : ''; ?>"/>
            <button>Submit</button>
        </form>
    </div>
</div>
<h1 style="text-align: center;"><?php echo $newpole; ?></h1>
</body>
</html>

