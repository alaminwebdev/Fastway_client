<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/Database.php');
// Starting the session, necessary
// for using session variables
//session_start();
?>

<?php
if (!isset($_SESSION)) {
	session_start();
}
?>

<?php
ob_start();

class User
{
	private $db;


	public function __construct()
	{
		$this->db = new Database();
	}

	public function insertUser($name, $email, $password)
	{

		$name = mysqli_real_escape_string($this->db->link, $name);
		$email = mysqli_real_escape_string($this->db->link, $email);
		$password = mysqli_real_escape_string($this->db->link, $password);

		if (empty($name) || empty($email) || empty($password)) {
			$msg = "<div class='alert alert-danger alert-dismissible fade show'> Error! Field Must not be empty</div>";
			return $msg;
		} else {
			$sql = "SELECT *FROM client WHERE email = '$email'";
			$result = mysqli_query($this->db->link, $sql);
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$count = mysqli_num_rows($result);

			if ($count == 1) {
				$msg = "<div class='alert alert-danger'>Error! Email are already exist.</div>";
				return $msg;
			} else {
				$usr_query = "INSERT INTO client(name,email,password) VALUES ('$name','$email','$password')";
				$usr_insert = $this->db->insert($usr_query);

				// Storing username of the logged in user,
				// in the session variable
				$_SESSION['email'] = $email;

				// Welcome message
				$_SESSION['success'] = "Sign in successfully !";

				header('Location:index.php');

				if ($usr_insert) {
					$msg = "<div class='alert alert-success m-0'> Success! Data inserted </div>";
					return $msg;
				} else {
					$msg = "<div class='alert alert-danger m-0'> Error! Data not inserted</div>";
					return $msg;
				}
			}
		}
	}

	public function selectUser($email, $password)
	{
		error_reporting(0);
		$email = mysqli_real_escape_string($this->db->link, $email);
		$password = mysqli_real_escape_string($this->db->link, $password);


		$sql = "SELECT *FROM client WHERE email = '$email' AND password = '$password'";
		$result = mysqli_query($this->db->link, $sql);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$count = mysqli_num_rows($result);

		if ($count == 1) {

			// Storing username in session variable
			$_SESSION['email'] = $email;

			// Welcome message
			$_SESSION['success'] = "You have logged in!";

			// Page on which the user is sent
			// to after logging in
			header('Location:index.php');
		} else {
			$msg = "<div class='alert alert-danger'> Error! Username And password not matched </div>";
			return $msg;
		}
	}

	public function trackParcel($tracking_number)
	{
		error_reporting(0);
		$tracking_number = mysqli_real_escape_string($this->db->link, $tracking_number);


		$sql = "SELECT *FROM parcels WHERE reference_number = '$tracking_number'";
		$result = mysqli_query($this->db->link, $sql);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$count = mysqli_num_rows($result);

		if ($count == 1) {

			switch ($row['status']) {
				case '1':
					$msg = "<div class='alert alert-info '>Your parcel is  <span class='badge badge-pill badge-info'> Collected</span></div>";
					break;
				case '2':
					$msg = "<div class='alert alert-primary'>Your parcel is <span class='badge badge-pill badge-primary'> Shipped</span></div>";
					break;
				case '3':
					$msg = "<div class='alert alert-secondary'>Your parcel is <span class='badge badge-pill badge-secondary'> In-Transit</span></div>";
					break;
				case '4':
					$msg = "<div class='alert alert-danger'> Your parcel is <span class='badge badge-pill badge-dark'> Arrived At Destination</span></div>";
					break;
				case '5':
					$msg = "<div class='alert alert-primary'>Your parcel is <span class='badge badge-pill badge-primary'> Out for Delivery</span></div>";
					break;
				case '6':
					$msg = "<div class='alert alert-warning'>Your parcel is <span class='badge badge-pill badge-warning'> Ready to Pickup</span></div>";
					break;
				case '7':
					$msg = "<div class='alert alert-success'>Your parcel is <span class='badge badge-pill badge-success'>Delivered</span></div>";
					break;
				case '8':
					$msg = "<div class='alert alert-success '>Your parcel is <span class='badge badge-pill badge-success'> Picked-up</span></div>";
					break;
				case '9':
					$msg = "<div class='alert alert-danger'>Your parcel is <span class='badge badge-pill badge-danger'> Unsuccessfull Delivery Attempt</span></div>";
					break;

				case '10':
					$msg = "<div class='alert alert-danger'>Your parcel is <span class='badge badge-pill badge-danger'> Pending</span></div>";
					break;

				default:
					$msg =  "<div class='alert alert-secondary'>Your parcel is <span class='badge badge-pill badge-info'> Accepted by Courier</span></div>";
					break;
			}

			return $msg;
		} else {
			$msg = "<div class='alert alert-danger'> Error! Tracking Number are not match ! </div>";
			return $msg;
		}
	}

	public function deleteParcel($parcel_id)
	{
		// error_reporting(0);
		$parcel_id = mysqli_real_escape_string($this->db->link, $parcel_id);

		$sql = "SELECT *FROM parcels WHERE parcels.id = '$parcel_id'";
		$result = mysqli_query($this->db->link, $sql);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

		if ($row["status"] == 10) {
			$query = "DELETE FROM parcels WHERE parcels.id = '$parcel_id' ";
			$result = $this->db->delete($query);
			if ($result) {
				$msg = "<div class='alert alert-success'>Success ! Parcel Deleted </div>";
				return $msg;
				header('Location:index.php');
			}
		} else {
			$msg = "<div class='alert alert-danger'> Your Parcel can't be deleted. </div>";
			return $msg;
		}
	}

	public function insertMessage($email, $message)
	{
		// error_reporting(0);
		$email = mysqli_real_escape_string($this->db->link, $email);
		$message = mysqli_real_escape_string($this->db->link, $message);

		$cont_query = "INSERT INTO contact(email,message) VALUES ('$email','$message')";
		$cont_insert = $this->db->insert($cont_query);

		if ($cont_insert) {
			$msg = "<div class='alert alert-success mb-4'> Message sent </div>";
			return $msg;
		} else {
			$msg = "<div class='alert alert-danger mb-4'> Error ! Something went wrong.</div>";
			return $msg;
		}
	}
}
?>






















