<?php
ob_start();
include 'base.php';
include 'db_connect.php';
include 'lib/User.php';
?>
<?php if (!isset($_SESSION['email'])) {
    header('location:index.php');
}
?>
<?php if (isset($_SESSION['email'])) : ?>

    <?php
    // error_reporting(0);
    $del = new User();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $parcel_id = $_POST['parcel_id'];
        $deleteData = $del->deleteParcel($parcel_id);
    }
    ?>

    <div class="container-fluid mt-5 py-5 px-sm-3 px-md-5" id="request">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="small-box user_bg shadow-sm border">
                    <div class="p-5">
                        <?php
                        $email = $_SESSION['email'];
                        $qry = $conn->query("SELECT * FROM client WHERE client.email = '$email'");
                        $result = $qry->fetch_assoc();
                        ?>
                        <h2>
                            Welcome <?php echo ($result['name']) ?> !
                        </h2>
                        <p><span class="badge badge-pill badge-success">
                                <?php echo $_SESSION['email'] ?>
                            </span></p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <?php
                if (isset($deleteData)) {
                    echo $deleteData;
                }
                ?>
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <div class="card-tools">
                            <h3>Parcel Request List</h3>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <div class="alert d-none" id="alert_box" role="alert"></div>
                        <table class="table table-bordered" id="list">
                            <thead>
                                <tr>
                                    <th class="text-center">Serial</th>
                                    <th>Reference Number</th>
                                    <th>Sender Name</th>
                                    <th>Recipient Name</th>
                                    <th>Status</th>
                                    <th>Estimated cost</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $email = $_SESSION['email'];
                                $qry = $conn->query("SELECT * FROM parcels WHERE parcels.sender_email = '$email'");
                                while ($row = $qry->fetch_assoc()) :
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i++ ?></td>
                                        <td><?php echo ($row['reference_number']) ?></td>
                                        <td><?php echo ucwords($row['sender_name']) ?></td>
                                        <td><?php echo ucwords($row['recipient_name']) ?></td>
                                        <td class="text-center">
                                            <?php
                                            switch ($row['status']) {
                                                case '1':
                                                    echo "<span class='badge badge-pill badge-info'> Collected</span>";
                                                    break;
                                                case '2':
                                                    echo "<span class='badge badge-pill badge-danger'> Shipped</span>";
                                                    break;
                                                case '3':
                                                    echo "<span class='badge badge-pill badge-secondary'> In-Transit</span>";
                                                    break;
                                                case '4':
                                                    echo "<span class='badge badge-pill badge-dark'> Arrived At Destination</span>";
                                                    break;
                                                case '5':
                                                    echo "<span class='badge badge-pill badge-primary'> Out for Delivery</span>";
                                                    break;
                                                case '6':
                                                    echo "<span class='badge badge-pill badge-warning'> Ready to Pickup</span>";
                                                    break;
                                                case '7':
                                                    echo "<span class='badge badge-pill badge-success'>Delivered</span>";
                                                    break;
                                                case '8':
                                                    echo "<span class='badge badge-pill badge-success'> Picked-up</span>";
                                                    break;
                                                case '9':
                                                    echo "<span class='badge badge-pill badge-danger'> Unsuccessfull Delivery Attempt</span>";
                                                    break;
                                                case '9':
                                                    echo "<span class='badge badge-pill badge-danger'> Unsuccessfull Delivery Attempt</span>";
                                                    break;

                                                case '10':
                                                    echo "<span class='badge badge-pill badge-danger'> Pending</span>";
                                                    break;

                                                default:
                                                    echo "<span class='badge badge-pill badge-info'> Item Accepted by Courier</span>";

                                                    break;
                                            }

                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if (ucwords($row['price']) == 0) {
                                                echo "Not assigned";
                                            } else {
                                                echo ucwords($row['price']) . "tk";
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <div>
                                                <form action="" method="POST" id="delete">
                                                    <div class="control-group">
                                                        <input type="hidden" name="parcel_id" value="<?php echo $row['id'] ?>" />
                                                    </div>
                                                    <div>
                                                        <button class="btn btn-sm btn-danger delete_parcel" name="submit" type="submit">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </form>

                                            </div>

                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>





<?php include 'base_footer.php' ?>

<style>
    table td {
        vertical-align: middle !important;
    }
</style>
<script>
    
</script>