<?php session_start();
if (empty($_SESSION)) {
    header('Location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap Site</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  
    <form method="POST" enctype="multipart/form-data" class="bg-info col-6 offset-3">

        <div class="container my-5">
            <div class="row">
                <div class="offset-3 col-8 ">
                    <?php
                    if (!empty($_POST) ) {
                       
                        $errors = [];
                        if($_POST['email']){
                            $_SESSION['user'][0]['email'] = $_POST['email'];
                        }else{
                            $errors['email'] =  "<div class='alert alert-danger'> Email is required </div>";
                        }

                        if($_POST['name']){
                            $_SESSION['user'][0]['name'] = $_POST['name'];
                        }else{
                            $errors['name'] =  "<div class='alert alert-danger'> Name is required </div>";
                        }

                        if($_POST['gender'] == 'm' || $_POST['gender'] == 'f'){
                            $_SESSION['user'][0]['gender'] = $_POST['gender'];
                        }else{
                            $errors['gender'] = "<div class='alert alert-danger'> You must select male or female only </div>";
                        }

                        if($_FILES['image']['error'] == "0"){
                            
                            if($_FILES['image']['size'] > 1000000){
                                $errors['size'] = "<div class='alert alert-danger'> You must UPLOAD image less than 1 megabyte </div>";
                            }

                            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                            $allowedExt = ['png','jpg','jpeg'];
                            if(!in_array($ext,$allowedExt)){
                                $errors["ext"] = "<div class='alert alert-danger'> You must upload image with this extensions png,jpg,jpeg </div>";
                            }

                            if(! (isset($errors['ext']) || isset($errors['size'])) ){
                               
                                $photoPath = "image/";
                                $photoName = time(). '.' . $ext; 
                                $fullPath = $photoPath . $photoName;
                                move_uploaded_file($_FILES['image']['tmp_name'],$fullPath);
                                $_SESSION['user'][0]['image'] = $photoName;

                            }



                        }





                    }
                    ?>
                    <div class="form-row">
                        <div class="form-group col-md-8 mx-5">
                            <label for="inputEmail4">Email</label>
                            <input type="email" class="form-control" id="inputEmail4" name="email" value="<?php echo $_SESSION['user'][0]['email'] ?>">
                            <?php echo(isset($errors['email']) ? $errors['email'] : "") ?>

                        </div>
                 
                        <div class="form-group col-md-8 mx-5">
                            <label for="inputPassword4">Name</label>
                            <input type="text" class="form-control" id="inputPassword4" name="name" value="<?php echo $_SESSION['user'][0]['name'] ?>">
                            <?php echo(isset($errors['name']) ? $errors['name'] : '') ?>
                        </div>
                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-8 mx-5">
                            <label for="inputState">Gender</label>
                            <select id="inputState" class="form-control" name="gender">
                               
                                <option value="m" <?php if ($_SESSION['user'][0]['gender'] == 'm') {
                                            echo 'selected';
                                        } ?>>Male</option>
                                <option value="f" <?php echo ($_SESSION['user'][0]['gender'] == 'f' ? 'selected' : '') ?>>Female</option>

                            </select>
                            <?php echo(isset($errors['gender']) ? $errors['gender'] :'') ?>
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-7 offset-1">
                            <div class="form-group ">
                                <label for="inputCity">Photo</label>

                                <img src="image/<?php echo $_SESSION['user'][0]['image'] ?>" alt="" style="width:100%">
                                <input type="file" name="image" class="form-control" id="inputCity">
                                

                            </div>

                        </div>
                        <div class="col-12">
                        <?php echo(isset($errors['size']) ? $errors['size'] :'') ?>
                                <?php echo(isset($errors['ext']) ? $errors['ext'] :'') ?>
                        </div>


                    </div>


                </div>
                <div class="offset-3 col-6">
                    <div class="row">

                        <div class=" col-3">
                            <button type="submit" name="update" class="btn btn-dark">Update</button>
                        </div>
                        <div class="offset-6 col-3">
                            <a href="logout.php" class="btn btn-dark">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</head>
<body>

</html>