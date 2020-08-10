<!DOCTYPE html>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>DZ</title>
 </head>
 <body bgcolor="#00ff00">

  <table border="1" cellpadding="100" cellspacing="15">
   <tr>
     <td  colspan="2" bgcolor="#D3EDF6" align="left" >SITE BRENDING
        <div align="right">LOGIN<input type="text" name="email"
            placeholder="Enter email"></div>
            <div align="right">PASSWORD<input type="password" name="password"
            placeholder="Enter password">
        </div><div align="right"><input type="submit" name="DOO IT"></div>

        </td>
   </tr> 
   <tr>
     <td valign="top" align="center" ><div align="center">
    <h3>регистация</h3>
    <form action="/Form.php" method="POST">
        <input type="text" name="email" placeholder="examle@email.com"><br>
        <input type="password" name="password" placeholder="my password"><br>
        <input type="submit" value="Register">
        
    </form>
     </div></td>
     <td width="98%"> <table border="1">
        <thead></thead>
        <th>Табличка</h1>
    <?php
     
$aryy=[
    [ 'name'=>'Alex',

        'age'=>31,
        'long'=>175,
        'kg'=>75,


    ],
    [ 'name'=>'Den',
        'age'=>33,
        'long'=>175,
        'kg'=>75,


    ],
];
bildTABle($aryy);

function bildTABle(array $users)
{

    $himl='<table border="1" bgcolor="waite"width="100%" cellpadding="50" >';
    $himl .='<thead>';
    $himl.='<th>Имя</th>';
    $himl.= '<th>Возраст</th>';
     $himl.= '<th>Рост</th>';
      $himl.= '<th>Вес</th>';
    $himl.='</thead>';
    $himl.='<tbody>';

    foreach ($users as $user) {
        $himl.="<tr><td>{$user['name']}</td><td>{$user['age']}</td><td>{$user['long']}</td><td>{$user['kg']}</td></tr>";

        # code...
    }


    $himl.='</tbody>';
    $himl.='</table>';

    echo $himl;
}
?>
  </table> 

 </body>
</html>

	
