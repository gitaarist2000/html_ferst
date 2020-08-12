<?php
function showTable()
{
    $html = '<html>
 <head>
     <title>Рандомоугадайка</title>
 </head><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
 <body><div class="container">
    <h1>Введите число от 1 до 100</h1>
    <form action="Rand.php" method="POST" class="form-group">
        <input type="number" name="number_from_use"  placeholder="1 - 100" min ="1" max="100" class="form-control">
        <input type="submit" class="btn btn-success"></form><br>
     

</body>
    </html>';
    echo $html;
}

function ShowRand()
{
    $number = (int) $_POST['number_from_use'];

    if ($number < 1 || $number > 100 || !is_numeric($_POST['number_from_use'])) {
        die("Вы ввели не те данние ,пожалуйста введите число с 1 до 100");
    }

    $counter = 0;

    do {
        $rand = rand(1,100);
        $counter++;
    } while ($number !== $rand);

    echo "<h3>Я угадал ваше число<Strong> $number </Strong> </br> c<Strong> $counter</Strong> Попитки,попробуйте еще)))</h3>";
}
showTable();

if (!is_null($_POST['number_from_use'] ?? null)) {
    ShowRand();
}
?>
