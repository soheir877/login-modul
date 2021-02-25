<?php
SESSION_start();

$users = [
    0=>[
        'id'=>1,
        'name'=>'ahmed',
        'email'=>'ahmed@gmail.com',
        'password'=>'123456',
        'image'=>'1.jpg',
        'gender'=>'m'
    ],
    1=>[
        'id'=>2,
        'name'=>'esraa',
        'email'=>'esraa@gmail.com',
        'password'=>'123456',
        'image'=>'2.jpg',
        'gender'=>'f'
    ],
    2=>[
        'id'=>3,
        'name'=>'galal',
        'email'=>'galal@gmail.com',
        'password'=>'123456',
        'image'=>'3.jpg',
        'gender'=>'m'
    ]
];

if(!empty($_SESSION)){
    header('location:home.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap Site</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</head>
<body>

<div class="container my-5">
        <div class="row">
            <div class="col-12">
                <form method="POST">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php
if(!empty($_POST)&&$_POST["email"]&&$_POST["password"]){
    $email=$_POST["email"];
    $password=$_POST["password"];

    function login($user){
        global $email,$password;
        return $email==$user['email'] &&$password==$user['password'];
    }
$user=array_filter($users,'login');
if(empty($user)){
    echo "<p>pleace enter your email and password</p>";
}else{
    $_SESSION['user']= array_values($user) ;
    header('location:home.php');
}
}

?>
