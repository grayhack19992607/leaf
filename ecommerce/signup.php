<?php
include 'includes/session.php'; 
?>

<?php include 'includes/header.php'; ?>

<body class="hold-transition register-page">
    <div class="register-box">
        <?php
        if (isset($_SESSION['error'])) {
            echo "
              <div class='callout callout-danger text-center'>
                <p>" . $_SESSION['error'] . "</p> 
              </div>
            ";
            unset($_SESSION['error']);
        }

        if (isset($_SESSION['success'])) {
            echo "
              <div class='callout callout-success text-center'>
                <p>" . $_SESSION['success'] . "</p> 
              </div>
            ";
            unset($_SESSION['success']);
        }
        ?>
        <div class="register-box-body">
            <p class="login-box-msg">Register a new membership</p>
            <form action="register.php" method="POST">
                <!-- Add your form fields here -->
                <div class="form-group">
                    <input type="text" name="firstname" class="form-control" placeholder="First Name" required>
                </div>
                <div class="form-group">
                    <input type="text" name="lastname" class="form-control" placeholder="Last Name" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <input type="password" name="repassword" class="form-control" placeholder="Confirm Password" required>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat" name="signup"><i class="fa fa-pencil"></i> Sign Up</button>
                    </div>
                </div>
            </form>
            <br>
            <a href="login.php">I already have a membership</a><br>
            <a href="index.php"><i class="fa fa-home"></i> Home</a>
        </div>
    </div>

    <?php include 'includes/scripts.php' ?>
</body>
</html>
