<!DOCTYPE html>
 <html>
 <head>
     <title>Рандомоугадайка</title>
 </head><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
 <body>

<?php

(int) $_POST['number_from_user'];
$user_num = (int)$_POST['number_from_use'];
$isVisi = $user_num < 101 && $user_num > 0;
$counter_factor = 0;
$counter = 0;
$rand = 0;
while ($isVisi && (($rand = (int)rand(1, 100)) !== $user_num)) {
    $counter_fact++;
    if (strpos($arr, (string)$rand) === false) {
            $counter++;
            $arr .= ' ' . $rand;
    }
}

 echo '<div class="container">
    <h1>Введите число от 1 до 100</h1>
    <form action="Rand.php?" method="POST" class="form-group">
        <input type="number" name="number_from_use"  placeholder="1 - 100" min ="1" max="100" value="' . ($isVisi ? $user_num : '') . '" class="form-control">
        <input type="submit" class="btn btn-success"></form><br>
        <div ' . ($isVisi ? '' : 'hidden') . '>
    <p> И вот с <strong>'
    .   ($is ? (($counter + 1) . ' (or ' . ($counter_factor + 1) . ' in fact)') : $counter_factor + 1)
    . '</strong> попытки мы угадали ваше число <strong>' . $user_num . ' </strong></p>'
    . (strlen($arr) > 1 ? '<p> По подробнее)' . $arr . '</p>' : '')
    . '</div></div>';
?>
</body>
    </html>
