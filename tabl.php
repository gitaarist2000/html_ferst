<?php  
$name = $_POST['name'];
$tel = $_POST['tel'];

$users = [];

if (file_exists('telb.json')) {
    $users = json_decode(file_get_contents('telb.json') ,true);
}


$users[] = [

    'Имя' => $name,
    'Телефон'=>$tel
  
];

file_put_contents('telb.json', json_encode($users));

$json = file_get_contents('telb.json');
$array = json_decode($json, true);

$headers = array_keys($array[0]);

$html = '<!DOCTYPE html>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>DZ</title>
 </head>
 <body bgcolor="#00ff00">

  
        </td>
   </tr> 
   <tr>
     <td valign="top" align="center" ><div align="center">
    
        
     <form action="/tabl.php" method="post" enctype="multipart/form-data" align="left">
        <input type="text" name="name" placeholder="введите Имя"><br>
        <input type="tel" name="tel" placeholder="введите телефон"><br>
        <input type="submit" value="Отправить">
     </div></td>
     <td width="98%"> <table border="1">
        <thead></thead>
        <th>Табличка</h1>

  <table border="1" bgcolor="waite"width="100%" cellpadding="50" align="center" >
    <thead>
  
    
  
</html>
';

foreach ($headers as $key) {
    $html .= "<th>$key</th>";
}

$html .= '</head><body>';

foreach ($array as $row) {
    $html .= '<tr>';
    foreach ($headers as $key) {
        $html .= '<td>' . $row[$key] . '</td>';
    }
    $html .= '</tr>';
}

$html .= '</body></table>';


echo $html;







?>