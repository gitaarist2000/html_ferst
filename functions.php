<?php

function loginEndpoint()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        makeLogin($_POST['email'], $_POST['password']);
      
        die();
    }

    showLoginForm();
}

function showLoginForm()
{

    $form = '';

    $email = $_GET['email'] ?? '';

    if ($error = ($_GET['error'] ?? null)) {
        $form .= '<br><div class="alert alert-danger" role="alert">
                ' . $error . '
            </div>';
    }


    $form .= '<h2>Login</h2><form action="/?action=login" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="' . $email . '">
    <small id="emailHelp" class="form-text text-muted">We\'ll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-primary">Login</button>
</form>';

    echo sprintf(getSiteTemplate(), $form);
}

function logoutEndpoint()
{
    session_destroy();
    header("Location: /");
}

function registerEndpoint()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        makeRegistration($_POST['email'], $_POST['password']);
     
        die();
    }

    showRegisterForm();
}

function makeLogin(string $email, string $password)
{
    $users = [];

    if (strlen($password) < 4) {
        header("Location: /?action=login&email=$email&error=Password should be at least 4 symbols!");
        return;
    }

    if (file_exists('users.json')) {
        $users = json_decode(file_get_contents('users.json') ,true);
    }

    foreach ($users as $user) {
        if ($email === $user['email'] && md5($user['salt'] . $password . $user['salt']) === $user['password']) {
            $_SESSION['user'] = $user;
            header("Location: /");
            return;
        }
    }

    header("Location: /?action=login&email=$email&error=Credentials you entered were incorrect!");
}

function makeRegistration(string $email, string $password)
{
    $users = [];

    if (file_exists('users.json')) {
        $users = json_decode(file_get_contents('users.json') ,true);
    }

    foreach ($users as $user) {
        if ($user['email'] === $email) {
            header("Location: /?action=register&error=Email has been already taken!");
            return;
        }
    }

    $salt = getRandomSalt();

    $users[] = $user = [
        'email' => $email,
        'salt' => $salt,
        'password' => md5($salt . $password . $salt)
    ];


    file_put_contents('users.json', json_encode($users));

    header("Location: /?action=login&email=$email");
}

function showRegisterForm()
{

    $form = '';

    if ($error = ($_GET['error'] ?? null)) {
        $form .= '<br><div class="alert alert-danger" role="alert">
                ' . $error . '
            </div>';
    }

    $form .= '<h2>Register</h2><form action="/?action=register" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We\'ll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-primary">Register</button>
</form>';

    echo sprintf(getSiteTemplate(), $form);
}

function getSiteTemplate(): string
{
    $html = '<html>';
    $html .= '<head>';
    $html .= getBootstrapHead();
    $html .= '</head>';
    $html .= '<body>';



    $html .= '
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/">TaBl and Go</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">';

    if ($user = getAuthUser()) {
        $html .= '
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          ' .$user. '
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/?action=logout">Logout</a>
        </div>
      </li>
      ';
       if ($user = getAuthUser()) {
            SowTABL();
        
       }
     
    } 
       
    else {
        $html .= '
      <li class="nav-item">
        <a class="nav-link" href="/?action=login">LOGIN <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/?action=register">REGISTER</a>
      </li>';

    }






    $html .= '
    </ul>
  </div>
</nav>
    
    ';
    $html .= '<div style=“display:none” class="container">';
    $html .= '%s';
   
       $html .= '</body>';
  
    $html .= '</div>';
    
  $html .='<div id="footer">  
  </div>';
    $html .= '</html>';




    return $html;
}

function mainEndpoint()
{
    $template =  '';

  $html = sprintf($template, getAuthUser() ?? "unauthorized user!");

    echo sprintf(getSiteTemplate(), $html) ;
}


function getBootstrapHead()
{
    return '
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    ';
   
}


function getRandomSalt(int $length = 32)
{
    $abc = array_merge(
        range('a', 'z'),
        range('A', 'Z'),
        [0,1,2,3,4,5,6,7,8,9,'!','^','$','#','*']
    );

    $hash = '';

    $absLen = count($abc);

    for ($i = 0; $i < $length; $i++) {
        $index = rand(0, $absLen - 1);
        $hash .= $abc[$index];
    }

    return $hash;
}

function getAuthUser()

{
   


    return $_SESSION['user']['email'] ?? null;


}




function SowTABL()
{

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

$html1 = '<!DOCTYPE html>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>DZ</title>
 </head>
 <body bgcolor="#00ff00">

  
        </td>
   </tr> 
   <tr>
     <td style=“display:none” valign="top" align="center" ><div align="center">
    
        
     <form action="/" method="post" enctype="multipart/form-data" align="left">
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
    $html1 .= "<th>$key</th>";
}

$html1 .= '</head><body>';

foreach ($array as $row) {
    $html1 .= '<tr>';
    foreach ($headers as $key) {
        $html1 .= '<td>' . $row[$key] . '</td>';
    }
    $html1 .= '</tr>';
}

$html1 .= '</body></table>';


echo  $html1;


}