<?php
include 'base.php';
include 'lib/User.php';
?>


<!-- Contact Start -->
<?php
error_reporting(0);
$contact = new User();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $message = $_POST['message'];
    $inserttdata = $contact->insertMessage($email, $message);
}
?>

<div class="container-fluid mt-5 py-5 px-sm-3 px-md-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 m-auto">

                <div class="card">
                    <h3 class="card-header">Contact For Any Queries</h3>
                    <div class="card-body">
                        <?php
                        if (isset($inserttdata)) {
                            echo $inserttdata;
                        }
                        ?>
                        <form action="" method="POST" name="contact" id="contact">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control p-4 mb-4" id="email" placeholder="Your Email" required="required" />
                            </div>
                            <div class="form-group">
                                <textarea class="form-control " id="exampleFormControlTextarea1" rows="3" placeholder="Write Your Message" name="message"></textarea>
                            </div>

                            <div>
                                <button class="btn btn-success py-2 px-4" name="submit" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
    <?php include 'base_footer.php' ?>