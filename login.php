<?php
include "layout/header.php";
if(isset($_SESSION['email'])){
    header('location: index.php');
    exit;
}
$error='';
$email='';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email= $_POST['email'];
    $password= $_POST['password'];
    if(empty($email) || empty($password)){
        $error = "Email and Password are required!";
    }else{
        include "tools/db.php";
        $dbConnection = getDatabaseConnection();
        $statement = $dbConnection->prepare("SELECT id, first_name, last_name, phone,address, password,role, created_at FROM users WHERE email = ?");
        $statement->bind_param('s',$email);
        $statement->execute();
        $result = $statement->get_result();
        $user = $result->fetch_assoc();

        if($user && (password_verify($password, $user['password']) || $user['password'] == $password)){
            $_SESSION['id'] = $user['id'];
            $_SESSION['firstName'] = $user['first_name'];
            $_SESSION['lastName'] = $user['last_name'];
            $_SESSION['email'] = $email;
            $_SESSION['phone'] = $user['phone'];
            $_SESSION['address'] = $user['address'];
            $_SESSION['created_at'] = $user['created_at'];
            $_SESSION['role'] = $user['role'];
        }
        if($user && password_verify($password, $user['password']) && $user['role'] == 'client'){
        header('location: index.php');
        exit;
        }elseif($user && $user['password'] == $password && $user['role'] == 'admin'){
            header('location: admin.php');
            exit;
        }
        $statement->close();
        $error = 'Email or password invalid';
    }
}
?>

<div class="container py-5">
    <div class="mx-auto border shadow p-4" style="width: 400px;">
        <h2 class="text-center mb-4">Login</h2>
        <hr>
        <?php 
        if(!empty($error)){?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?= $error ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php }?>
        <form method="post" >
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?= $email  ?>">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" >
            </div>

            <div class="row mb-3">
                <div class="col d-grid">
                    <button type="submit" class="btn btn-primary">Log in</button>
                </div>
                <div class="col d-grid">
                    <a href="/index.php" class="btn btn-outline-primary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include "layout/footer.php" ?>