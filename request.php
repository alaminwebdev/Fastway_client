<?php
ob_start();
include 'base.php';
?>
<?php if (!isset($_SESSION['email'])) {
    header('location:index.php');
}
?>

<?php if (isset($_SESSION['email'])) : ?>
    <?php include 'base_footer.php' ?>
    <div class="container py-5 px-sm-3 px-md-5" id="request">
        <div class="row align-items-center">
            <?php include 'new_parcel.php'; ?>
        </div>
    </div>
<?php endif ?>




