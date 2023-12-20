<?php
error_reporting(E_ALL & ~E_NOTICE);
$mas1_9 = [
    'un' => 1,
    'et-un' => 1,
    'deux' => 2,
    'trois' => 3,
    'quatre' => 4,
    'cinq' => 5,
    'six' => 6,
    'sept' => 7,
    'huit' => 8,
    'neuf' => 9
];
$mas11_19 = [
    'onze' => 11,
    'douze' => 12,
    'treize' => 13,
    'quatorze' => 14,
    'quinze' => 15,
    'seize' => 16,
    'dix-sept' => 17,
    'dix-huit' => 18,
    'dix-neuf' => 19
];
$mas10_60 = [
    'dix' => 10,
    'vingt' => 20,
    'trente' => 30,
    'quarante' => 40,
    'cinquante' => 50,
    'soixante' => 60,
];
$mas100_999 = [
    'cents' => 100,
    'cent' => 100
];
$mas70_99 = [
        'quatre-vingt-dix' => 90,
    'quatre-vingt-onze' => 91,
    'quatre-vingt-douze' => 92,
    'quatre-vingt-treize' => 93,
    'quatre-vingt-quatorze' => 94,
    'quatre-vingt-quinze' => 95,
    'quatre-vingt-seize' => 96,
    'quatre-vingt-dix-sept' => 97,
    'quatre-vingt-dix-huit' => 98,
    'quatre-vingt-dix-neuf' => 99,
    'soixante-dix' => 70,
    'soixante-onze' => 71,
    'soixante-douze' => 72,
    'soixante-treize' => 73,
    'soixante-quatorze' => 74,
    'soixante-quinze' => 75,
    'soixante-seize' => 76,
    'soixante-dix-sept' => 77,
    'soixante-dix-huit' => 78,
    'soixante-dix-neuf' => 79,
    'quatre-vingts' => 80,
    'quatre-vingt' => 80,
    'quatre-vingt-un' => 81,
    'quatre-vingt-deux' => 82,
    'quatre-vingt-trois' => 83,
    'quatre-vingt-quatre' => 84,
    'quatre-vingt-cinq' => 85,
    'quatre-vingt-six' => 86,
    'quatre-vingt-sept' => 87,
    'quatre-vingt-huit' => 88,
    'quatre-vingt-neuf' => 89,
];
$accept = $_POST['input'];
$accept = preg_replace('/\s+/', ' ', $accept);
$accept = trim($accept);
$res = explode(" ", $accept);
foreach ($res as $num) {
    $num = trim($num); // Удаляем пробелы в начале и конце строки

    // Проверяем наличие дефиса в числе
    if (strpos($num, '-') !== false) {
        // Если есть дефис, разделяем число на части
        $parts = explode('-', $num);

        foreach ($parts as $part) {
            $part = trim($part); // Удаляем пробелы в начале и конце строки

            $number[] = $part;
        }
    } else {
        // Если нет дефиса, просто добавляем число в массив
        $number[] = $num;
        $number = array_filter($number);
        $number = array_values($number);
    }
}
$newmas70_99 = array_combine(
    array_map(function($key) {
        return str_replace('-', ' ', $key);
    }, array_keys($mas70_99)),
    $mas70_99
);
foreach($newmas70_99 as $key=>$value){

    for ($i = 0;$i<count($number);$i++){
        if ($key === $number[$i]." ".$number[$i+1]." ".$number[$i+2]." ".$number[$i+3]){
            $number[$i] = $number[$i]."-".$number[$i+1]."-".$number[$i+2]."-".$number[$i+3];
            unset($number[$i+1]);
            unset($number[$i+2]);
            unset($number[$i+3]);
            $number = array_filter($number);
            $number = array_values($number);
            break;
        }
        if ($key === $number[$i]." ".$number[$i+1]." ".$number[$i+2]){
            $number[$i] = $number[$i]."-".$number[$i+1]."-".$number[$i+2];
            unset($number[$i+1]);
            unset($number[$i+2]);
            $number = array_filter($number);
            $number = array_values($number);
            break;
        }
        if ($key === $number[$i]." ".$number[$i+1]){
            $number[$i] = $number[$i]."-".$number[$i+1];
            unset($number[$i+1]);
            $number = array_filter($number);
            $number = array_values($number);
            break;
        }
    }
}

$err = '';
for ($i = 0, $b = 1; $i < count($number); $i++, $b++) {

//---------------------------------------------------------------------------------
    for ($j = 0;$j<count($number);$j++){
    if (!array_key_exists($number[$j], $mas1_9) &&
        !array_key_exists($number[$j], $mas10_60) &&
        !array_key_exists($number[$j], $mas11_19) &&
        !array_key_exists($number[$j], $mas70_99) &&
        !array_key_exists($number[$j], $mas100_999)
    )
    {
        $err = "Нераспознанное слово {$number[$j]}";
        break;
        }
    }
    if (isset($mas1_9[$number[$i]]) && isset($mas1_9[$number[$i + 1]]) && !$err) {
        $err = "После чисел единичного формата не могут идти числа единичного формата";
        break;
    }
    if (isset($mas1_9[$number[$i]]) && isset($mas11_19[$number[$i + 1]]) && !$err) {
        $err = "После чисел единичного формата не могут идти числа формата 11-19";
        break;
    }
    if (isset($mas1_9[$number[$i]]) && isset($mas10_60[$number[$i + 1]]) && !$err) {
        $err = "После чисел единичного формата не могут идти числа десятичного формата";
        break;
    }
    if (isset($mas1_9[$number[$i]]) && isset($mas70_99[$number[$i + 1]]) && !$err) {
        $err = "После чисел единичного формата не могут идти числа десятичного формата)";
        break;
    }
//---------------------------------------------------------------------------------
    if (isset($mas11_19[$number[$i]]) && isset($mas11_19[$number[$i + 1]]) && !$err) {
        $err = "После чисел формата 11-19 не могут идти числа формата 11-19";
        break;
    }
    if (isset($mas11_19[$number[$i]]) && isset($mas1_9[$number[$i + 1]]) && !$err) {
        $err = "После чисел формата 11-19 не могут идти числа единичного формата";
        break;
    }
    if (isset($mas11_19[$number[$i]]) && isset($mas10_60[$number[$i + 1]]) && !$err) {
        $err = "После чисел формата 11-19 не могут идти числа десятичного формата";
        break;
    }
    if (isset($mas11_19[$number[$i]]) && isset($mas70_99[$number[$i + 1]])&& !$err) {
        $err = "После чисел формата 11-19 не могут идти числа десятичного формата";
        break;
    }
    if (isset($mas11_19[$number[$i]]) && isset($mas100_999[$number[$i + 1]]) && !$err) {
        $err = "После чисел формата 11-19 не могут идти сотни";
        break;
    }
//---------------------------------------------------------------------------------
    if (isset($mas10_60[$number[$i]]) && isset($mas11_19[$number[$i + 1]]) && !$err) {
        $err = "После чисел десятичного формата не могут идти числа формата 11-19";
        break;
    }
    if (isset($mas10_60[$number[$i]]) && isset($mas100_999[$number[$i + 1]]) && !$err) {
        $err = "После чисел десятичного формата не могут идти сотни";
        break;
    }
    if (isset($mas10_60[$number[$i]]) && isset($mas10_60[$number[$i + 1]]) && !$err) {
        $err = "После чисел десятичного формата не могут идти числа десятичного формата";
        break;
    }
    if (isset($mas10_60[$number[$i]]) && isset($mas70_99[$number[$i + 1]]) && !$err) {
        $err = "После чисел десятичного формата не могут идти числа десятичного формата";
        break;
    }
//---------------------------------------------------------------------------------
    if (isset($mas70_99[$number[$i]]) && isset($mas70_99[$number[$i + 1]]) && !$err) {
        $err = "После чисел десятичного формата не могут идти числа десятичного формата";
        break;
    }
    if (isset($mas70_99[$number[$i]]) && isset($mas10_60[$number[$i + 1]]) && !$err) {
        $err = "После чисел десятичного формата не могут идти числа десятичного формата";
        break;
    }
    if (isset($mas70_99[$number[$i]]) && isset($mas11_19[$number[$i + 1]]) && !$err) {
        $err = "После чисел десятичного формата не могут идти числа формата 11-19";
        break;
    }
    if (isset($mas70_99[$number[$i]]) && isset($mas100_999[$number[$i + 1]]) && !$err) {
        $err = "После чисел десятичного формата не могут идти сотни";
        break;
    }
//---------------------------------------------------------------------------------
    if (isset($mas100_999[$number[$i]]) && isset($mas100_999[$number[$i + 1]]) && !$err) {
        $err = "После сотен не могут сотни";
        break;
    }
}
$newNum = null;
if (!$err) {
    for ($i = 0; $i < count($number); $i++) {
        if ($number[$i] === 'cent') {
            $newNum += $mas100_999[$number[$i]];
        }
        if (isset($mas10_60[$number[$i]])) {
            $newNum += $mas10_60[$number[$i]];
        }
        if (isset($mas70_99[$number[$i]])) {
            $newNum += $mas70_99[$number[$i]];
        }
        if (isset($mas11_19[$number[$i]])) {
            $newNum += $mas11_19[$number[$i]];
        }
        if (isset($mas1_9[$number[$i]]) && $mas100_999[$number[$i + 1]]) {
            $newNum = $mas1_9[$number[$i]] * 100 - 100;
        } else {
            $newNum += $mas1_9[$number[$i]];
        }
    }
}
?>
<!DOCTYPE html>
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
        <form action="/dz1.php" method="POST">
            <label for="input">Введите текст:</label>
            <input type="text" id="input" name="input"
                   value="<?php echo isset($_POST['input']) ? $_POST['input'] : ''; ?>"/>
            <button type="submit">Отправить</button>
        </form>
    </div>
    <?php if ($err): ?>
        <p style="color: red;"><?php echo $err; ?></p>
    <?php elseif ($newNum != null): ?>
        <h1 style="text-align: center;"><?php echo $newNum; ?></h1>
    <?php endif; ?>
</div>
</body>

</html>
