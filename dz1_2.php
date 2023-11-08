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
$err = null;
$accept = $_POST['input'];
$accept = preg_replace('/\s+/', ' ', $accept);
$accept = trim($accept);
$res = explode(" ", $accept);
foreach ($res as $num) {
    $num = preg_replace('/\s+/', ' ', $num); // Удаляем лишние пробелы
    $num = trim($num); // Удаляем пробелы в начале и конце строки

    // Проверяем наличие дефиса в числе
    if (strpos($num, '-') !== false) {
        // Если есть дефис, разделяем число на две части
        list($part1, $part2) = explode('-', $num);

        $part1 = preg_replace('/\s+/', ' ', $part1); // Удаляем лишние пробелы
        $part2 = preg_replace('/\s+/', ' ', $part2); // Удаляем лишние пробелы

        $part1 = trim($part1); // Удаляем пробелы в начале и конце строки
        $part2 = trim($part2); // Удаляем пробелы в начале и конце строки

        $number[] = $part1;
        $number[] = $part2;
    } else {
        // Если нет дефиса, просто добавляем число в массив
        $number[] = $num;
    }
}
for($i = 0; $i<count($number);$i++){
    if (isset($mas1_9[$number[$i]]) && isset($mas1_9[$number[$i + 1]])) {
        $err = "После цифр не могут идти цифры (После цифры {$mas1_9[$number[$i]]} не может идти цифра {$mas1_9[$number[$i+1]]})";
        break;
    }
    if (isset($mas1_9[$number[$i]]) && isset($mas11_19[$number[$i + 1]])) {
        $err = "После единиц не могут идти числа 11-19 (После цифры {$mas1_9[$number[$i]]} не может идти число {$mas11_19[$number[$i+1]]})";
        break;
    }
    if (isset($mas1_9[$number[$i]]) && isset($mas10_60[$number[$i + 1]])) {
        $err = "После единицы не могут идти десятки (После цифры {$mas1_9[$number[$i]]} не может идти число {$mas10_60[$number[$i+1]]})";
        break;
    }
    if($number[$i] === 'quatre' &&
        $number[$i+1] === 'vingt' &&
        isset($mas11_19[$number[$i+2]])
    ){
        continue;
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
        <form action="dz1_2.php" method="POST">
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