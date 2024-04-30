<?php
include 'base.php';
include 'lib/User.php';
?>

<?php
// If the session variable is empty, this 
// means the user is yet to login
// User will be sent to 'login.php' page
// to allow the user to login
if (isset($_SESSION['name'])) {
}

?>
<!-- Accessible only to the users that have logged in already -->
<?php if (isset($_SESSION['success'])) : ?>
    <div class=" alert alert-success text-center">
        <h3>
            <?php
            echo $_SESSION['success'];
            unset($_SESSION['success']);
            ?>
        </h3>
    </div>
<?php endif ?>

<?php
// error_reporting(0);
$track = new User();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tracking_number = $_POST['tracking_number'];
    $selectdata = $track->trackParcel($tracking_number);
}
?>


<!-- Header Start -->
<div class="jumbotron jumbotron-fluid mb-5">
    <div class="container py-5">
        <h1 class="display-4 font-weight-bold">Reliable Service</h1>
        <h1 class="display-4 font-weight-bold">Every Time</h1>
        <p class="lead text-justify " style="padding-right:15% ;">Take advantage of this new opportunity to grow your business.We balance all the clients in a democratic manner and therefore there is no bias and that has itself encouraged repeat clients with similar wants for services.</p>
        <hr class="my-4">
        <p>Track Your Parcel - Now you can track your Parcel easily</p>
        <div class="mt-4" style="width: 100%; max-width: 600px;">

            <?php
            if (isset($selectdata)) {
                echo $selectdata;
            }
            ?>
            <form action="" method="POST" id="track">
                <div class="input-group">
                    <input type="number" class="form-control border-light" style="padding: 30px;" placeholder="Reference Number" name="tracking_number">
                    <div class="input-group-append">
                        <!-- <a class="btn btn-success px-3 align-middle" style="line-height: 45px;" role="button" href="#" name="submit" type="submit">Track </a> -->

                        <button class="btn btn-success py-2 px-4" name="submit" type="submit">Track</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

</div>
<!-- Header End -->


<!--  Service - Parcel Request Start -->
<div class="container-fluid  my-5" id="service">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 py-5 py-lg-0">
                <h6 class="text-success text-uppercase font-weight-bold">Get A Service</h6>
                <h1 class="mb-4">Request to Get Parcel Service</h1>
                <p class="mb-4">It is reliable and the label is a trustworthy name to all who have taken, taking and will take the services of this Company. The many years of service to the mass and to the corporates have made it the service for all to take.</p>
                <div class="row">
                    <div class="col-sm-4">
                        <h1 class="text-success mb-2" data-toggle="counter-up">225</h1>
                        <h6 class="font-weight-bold mb-4">SKilled Staff</h6>
                    </div>
                    <div class="col-sm-4">
                        <h1 class="text-success mb-2" data-toggle="counter-up">1050</h1>
                        <h6 class="font-weight-bold mb-4">Happy Clients</h6>
                    </div>
                    <div class="col-sm-4">
                        <h1 class="text-success mb-2" data-toggle="counter-up">2500</h1>
                        <h6 class="font-weight-bold mb-4">Complete Delivery</h6>
                    </div>
                </div>

                <a href="request.php" class="btn btn-success py-2 px-4 font-weight-bold">Get Parcel
                    request form</a>
            </div>
            <div class="col-lg-5 pb-4 pb-lg-0">
                <img class="img-fluid w-100" src="img/feature.jpg" alt="">

            </div>
        </div>
    </div>
</div>
<!-- Service - Parcel Request End -->

<!-- Price Start -->
<div class="container-fluid my-5" id="price" style="background-color: #e9ecef;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <img class="img-fluid w-100" src="img/feature.jpg" alt="">
            </div>
            <div class="col-lg-7 py-5 py-lg-0">
                <h6 class="text-success text-uppercase font-weight-bold">Why Choose Us</h6>
                <h1 class="mb-4">Faster, Safe and Trusted Courier Services</h1>
                <p class="mb-4">Shipping costs are calculated based on the distance your package needs to travel and the volumetric weight. Using this feature an user can calculate the total amount of cost.</p>
                <ul class="list-inline">
                    <li>
                        <h6><i class="far fa-dot-circle text-success mr-3"></i>Best In Industry</h6>
                    <li>
                        <h6><i class="far fa-dot-circle text-success mr-3"></i>Emergency Services</h6>
                    </li>
                    <li>
                        <h6><i class="far fa-dot-circle text-success mr-3"></i>24/7 Customer Support</h6>
                    </li>
                </ul>
                <a href="#" class="btn btn-success mt-3 py-2 px-4 font-weight-bold" data-toggle="modal" data-target="#exampleModalCenter">Know Price</a>

                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered " role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Parcel Calculator</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="parcel_cal">
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label for="weight">Weight</label>
                                            <input type="number" class="form-control" placeholder="Parcel weight - KG" name="weight">
                                        </div>

                                        <div class="form-group col">
                                            <label for="height">Height </label>
                                            <input type="number" class="form-control" placeholder="Parcel height - CM" name="height">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="p_length">Length </label>
                                        <input type="number" class="form-control" placeholder="Parcel Length - CM" name="p_length">
                                    </div>


                                    <div class="form-group">
                                        <label for="width">Width</label>
                                        <input type="number" class="form-control" placeholder="Parcel Width - CM" name="width">
                                    </div>

                                    <div class="form-group">
                                        <label for="location_from">From :</label>
                                        <select class="form-control" id="from_location" name="location_from">
                                            <option value="0">Dhaka</option>
                                            <option value="50">Barishal</option>
                                            <option value="40">Chattogram</option>
                                            <option value="35">Khulna</option>
                                            <option value="28">Rangpur</option>
                                            <option value="25">Mymensingh </option>
                                            <option value="30">Sylhet </option>

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="location_to">To :</label>
                                        <select class="form-control" id="location_to" name="location_to">
                                            <option value="0">Dhaka</option>
                                            <option value="50">Barishal</option>
                                            <option value="40">Chattogram</option>
                                            <option value="35">Khulna</option>
                                            <option value="28">Rangpur</option>
                                            <option value="25">Mymensingh </option>
                                            <option value="30">Sylhet </option>
                                        </select>
                                    </div>
                                    <div class="form-row text-center">
                                        <div class="form-group col">
                                            <input type="checkbox" class="" id="exampleCheck1" name="type">
                                            <label class="form-check-label" for="exampleCheck1">Pickup</label>
                                        </div>
                                        <div class="form-group col">
                                            <input type="checkbox" class="" id="exampleCheck2" name="express">
                                            <label class="form-check-label" for="exampleCheck2">Express delivery</label>
                                        </div>
                                        <div class="form-group col">
                                            <input type="checkbox" class="" id="exampleCheck3" name="confidential">
                                            <label class="form-check-label" for="exampleCheck3">Confidential</label>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success btn-block btn-lg mt-3" id="cal_result">Total Estimate Cost</button>
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Price End -->

<!-- About Start -->
<div class="container-fluid py-5" id="about">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h6 class="text-success text-uppercase font-weight-bold">About Us</h6>
                <h1 class="mb-4">Trusted Service Provider</h1>
                <p class="mb-4">Dolores lorem lorem ipsum sit et ipsum. Sadip sea amet diam dolore sed et. Sit rebum
                    labore sit sit ut vero no sit. Et elitr stet dolor sed sit et sed ipsum et kasd ut. Erat duo eos
                    et erat sed diam duo</p>

            </div>
            <div class="col-lg-5 pb-4 pb-lg-0">
                <img class="img-fluid w-100" src="img/about.jpg" alt="">
                <div class="bg-success  text-center p-4">
                    <h3 class="m-0 text-white">5 Years Experience</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->

<!-- Footer Start -->
<div class="container-fluid bg-light mt-5 py-5 px-sm-3 px-md-5">
    <div class="container">
        <div class="row pt-5 align-items-center">
            <div class="col-md-6 mb-5">
                <h3 class="text-success mb-4">Get In Touch</h3>
                <p><i class="fa fa-map-marker-alt mr-2"></i>123 Street, Dhanmondi , Dhaka </p>
                <p><i class="fa fa-phone-alt mr-2"></i>+8801580336034</p>
                <p><i class="fa fa-envelope mr-2"></i>alamiin.bd@gmail.com</p>
                <div class="d-flex justify-content-start mt-4">
                    <a class="btn btn-outline-dark btn-social mr-2" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-dark btn-social mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-dark btn-social mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-outline-dark btn-social" href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="col-md-6 mb-5">
                <h3 class="text-success text-right mb-4">Quick Links</h3>
                <div class="d-flex flex-column align-items-end">
                    <a class="mb-2 text-dark" href="#">Home<i class="fa fa-angle-left ml-2"></i></a>
                    <a class=" mb-2 text-dark" href="index.php#about">About Us<i class="fa fa-angle-left ml-2"></i></a>
                    <a class=" mb-2 text-dark" href="index.php#service">Our Services<i class="fa fa-angle-left ml-2"></i></a>
                    <a class=" mb-2 text-dark" href="index.php#price">Pricing Plan<i class="fa fa-angle-left ml-2"></i></a>
                    <a class="text-dark" href="contact.php">Contact Us<i class="fa fa-angle-left ml-2"></i></a>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="container-fluid  py-4 px-sm-3 px-md-5" style="background: #e9ecef;">
    <div class="container">
        <div class="row" style="align-items:center !important ;">
            <div class="col-lg-6 text-center text-md-left">
                <span><a href="#" class="text-success">&copy;fastway</a> All Rights Reserved.</span>
            </div>
            <div class="col-lg-6 text-center text-md-right">
                <ul class="nav d-inline-flex">
                    <li class="nav-item">
                        <a class="nav-link  text-dark py-0" href="">Privacy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  text-dark py-0" href="">Terms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark  py-0" href="">FAQs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark py-0" href="">Help</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>
<!-- Footer End -->

<?php include 'base_footer.php' ?>
<script>
    const form = document.getElementById('parcel_cal');

    form.addEventListener('submit', event => {
        event.preventDefault();
        // getting the element's value
        let weight = form.elements['weight'].value;
        let height = form.elements['height'].value;
        let p_length = form.elements['p_length'].value;
        let width = form.elements['width'].value;

        let location_from = parseInt(form.elements['location_from'].value);
        let location_to = parseInt(form.elements['location_to'].value);
        let type = form.elements['type'].checked ? 0 : 20;
        let express = form.elements['express'].checked ? 50 : 0;
        let confidential = form.elements['confidential'].checked ? 50 : 0;

        //defalult cost

        let per_kg = 10;
        let per_height = 1;
        let per_length = 1;
        let per_width = 2;


        let cal_result = (per_kg * weight) + (per_height * height) + (per_length * p_length) + (per_width * width) + location_from + location_to + type + express + confidential;



        console.log(weight, height, p_length, width, location_from, location_to, type, express, confidential)

        document.getElementById('cal_result').innerHTML = `Total Estimate Cost ${cal_result} tk`
    });
</script>


</body>

</html>