<?php
include "layout/header.php";
if(isset($_SESSION['email'])){
    header('location: index.php');
    exit;
}

$firstName='';
$lastName='';
$email='';
$phone='';
$address='';

$first_name_error='';
$last_name_error='';
$email_error='';
$phone_error='';
$address_error='';
$password_error='';
$confirm_password_error='';
$error =false;

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $firstName= $_POST['first_name'];
    $lastName= $_POST['last_name'];
    $email= $_POST['email'];
    $phone= $_POST['phone'];
    $address= $_POST['address'];
    $password= $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($firstName)){
        $first_name_error='First Name is required';
        $error=true;
    }
    if (empty($lastName)){
        $last_name_error='last Name is required';
        $error=true;
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $email_error='Email Format is not valid';
        $error=true;
    }
    include "tools/db.php";
    $dbConnection=getDatabaseConnection();
    $statement= $dbConnection->prepare("SELECT id FROM users WHERE email = ?");
    $statement->bind_param('s',$email);
    $statement->execute();
    $statement->store_result();
    if($statement->num_rows>0){
        $email_error="Email is already used";
        $error=true;
    }
    $statement->close();
    if(!preg_match("/^(\+|00\d{1,3})?[- ]?\d{7,12}$/",$phone)){
        $phone_error='Phone format is not valid';
        $error=true;
    }
    if(strlen($password)<6){
        $password_error="Password must have At least 6 caracters";
        $error=true;
    }
    if($password != $confirm_password){
        $confirm_password_error='Password and confirme password do not match';
        $error=true;
    }
    if(!$error){
        $password= password_hash($password, PASSWORD_DEFAULT);
        $created_at= date('Y-m-d H:i:s');
        $statement= $dbConnection->prepare("INSERT INTO users(first_name,last_name,email,phone,address,password,created_at) VALUES ".
        "(?,?,?,?,?,?,?)");
        $statement->bind_param("sssssss",$firstName,$lastName,$email,$phone,$address,$password,$created_at);
        $statement->execute();
        $insert_id= $statement->insert_id;
        $statement->close();

        // Save information of user in sessions for using his information in his profile
        $_SESSION['id']= $insert_id;
        $_SESSION['firstName']=$firstName;
        $_SESSION['lastName']=$lastName;
        $_SESSION['email']=$email;
        $_SESSION['phone']=$phone;
        $_SESSION['address']=$address;
        $_SESSION['created_at']=$created_at;
        header('location: index.php');
        exit;
    }
}
?>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-6 mx-auto border shadow p-4">
            <h2 class="text-center mb-4">Register</h2>
            <hr>
            <form method="post">
                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">First Name*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="first_name" value="<?= $firstName ?>">
                        <span class="text-danger"><?= $first_name_error ?></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Last Name*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="last_name" value="<?= $lastName ?>">
                        <span class="text-danger"><?= $last_name_error ?></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Email*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="email" value="<?= $email ?>">
                        <span class="text-danger"><?= $email_error ?></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Phone*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="phone" value="<?= $phone ?>">
                        <span class="text-danger"><?= $phone_error ?></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Address</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="address" value="<?= $address ?>">
                        <span class="text-danger"><?= $address_error ?></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Password*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="password" type="password">
                        <span class="text-danger"><?= $password_error ?></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-4 col-form-label">Confirm Password*</label>
                    <div class="col-sm-8">
                        <input class="form-control" name="confirm_password" type="password">
                        <span class="text-danger"><?= $confirm_password_error ?></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="offset-sm-4 col-sm-4 d-grid">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                    <div class="col-sm-4 d-grid">
                        <a href="/index.php" class="btn btn-outline-primary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<?php
include "layout/footer.php";
?>