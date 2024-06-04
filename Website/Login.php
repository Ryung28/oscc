<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login Confirmation</title>
<link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
    .modal-dialog {
        margin-top: 50px; 
        width: 300px; 
    }

    .modal-content {
        padding: 15px; 
    }

    .modal-header, .modal-body, .modal-footer {
        padding: 10px; 
    }
</style>
</head>
<body>
<?php
include 'db.php';
$loginSuccess = false; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['email'];
    $password = $_POST['password']; 

    /*-------sql to check user -------*/ 
    $sql = "SELECT * FROM registration WHERE email = ? AND passwords = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $loginSuccess = true;
    } else {
        $loginSuccess = false;
    }
    $stmt->close();
}
$conn->close();
?>

<!-- Modal HTML -->
<div id="loginModal" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="material-icons">&#xE876;</i>
                </div>
                <h4 class="modal-title"><?php echo $loginSuccess ? 'Login Successful!' : 'Login Failed'; ?></h4>
            </div>
            <div class="modal-body">
                <p class="text-center"><?php echo $loginSuccess ? 'You have successfully logged in.' : 'Invalid username or password.'; ?></p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $("#loginModal").modal('show');
});
</script>
</body>
</html>
