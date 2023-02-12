<?php
include 'lib/User.php';
include 'base.php';
?>



<!-- Register Start -->
<?php
error_reporting(0);
$usr = new User();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $_SESSION['success'] = "";
    $selectdata = $usr->selectUser($email, $password);
}
?>


<div class="container-fluid mt-5 py-5 px-sm-3 px-md-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 m-auto">
                <?php
                if (isset($selectdata)) {
                    echo $selectdata;
                }
                ?>
                <div class="card">
                    <h3 class="card-header">Login</h3>
                    <div class="card-body">
                        <form action="" method="POST" id="signup">
                            <div class="control-group">
                                <input type="email" name="email" class="form-control p-4 mb-4" id="email" placeholder="Your Email" required="required" />
                            </div>

                            <div class="control-group">
                                <input type="password" name="password" class="form-control p-4 mb-4" id="password" placeholder="Password" required="required" />
                            </div>

                            <div>
                                <button class="btn btn-success py-2 px-4" name="submit" type="submit">Login</button>
                                <span class="mx-2">Don't have any account ?
                                    <a href="register.php" class="btn btn-success py-2 px-4 mx-2">Signup</a>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Register End -->
<?php include 'base_footer.php' ?>