<?php
include "layout/header.php";
if(!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin'){
    header('location: login.php');
    exit;
}?>
<div class="container p-4 mb-5">
<table class="table mb-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Role</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
<?php
include "tools/db.php";

$dbConnection = getDatabaseConnection();

$result = $dbConnection->query("
    SELECT id, first_name, last_name, phone, address, role, created_at
    FROM users
");

while($user = $result->fetch_assoc()){
    echo "
    <tr>
        <td>{$user['id']}</td>
        <td>{$user['first_name']}</td>
        <td>{$user['last_name']}</td>
        <td>{$user['phone']}</td>
        <td>{$user['address']}</td>
        <td>{$user['role']}</td>
        <td>{$user['created_at']}</td>
    </tr>
    ";
}
?>
</tbody>
</table>
</div>


<?php
include "layout/footer.php"
?>