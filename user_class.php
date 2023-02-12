<?php
// if (!isset($_SESSION)) {
// 	session_start();
// }

ini_set('display_errors', 1);
class Action
{
	private $db;

	public function __construct()
	{
		ob_start();
		include 'db_connect.php';

		$this->db = $conn;
	}
	function __destruct()
	{
		$this->db->close();
		ob_end_flush();
	}

	function save_parcel()
	{
		extract($_POST);
		foreach ($price as $k => $v) {
			$data = "";
			$status= 10; // pending status
			// $price= 0;
			foreach ($_POST as $key => $val) {
				if (!in_array($key, array('id', 'weight', 'height', 'width', 'length', 'price')) && !is_numeric($key)) {
					if (empty($data)) {
						$data .= " $key='$val' ";
					} else {
						$data .= ", $key='$val' ";
					}
				}
			}
			if (!isset($type)) {
				$data .= ", type='2' ";
			}
			$data .= ", height='{$height[$k]}' ";
			$data .= ", width='{$width[$k]}' ";
			$data .= ", length='{$length[$k]}' ";
			$data .= ", weight='{$weight[$k]}' ";
			$price[$k] = str_replace(',', '', $price[$k]);
			// $data .= ", price='$price' ";
			if (empty($id)) {
				$i = 0;
				while ($i == 0) {
					$ref = sprintf("%'012d", mt_rand(0, 999999999999));
					$chk = $this->db->query("SELECT * FROM parcels where reference_number = '$ref'")->num_rows;
					if ($chk <= 0) {
						$i = 1;
					}
				}
				$data .= ", reference_number='$ref' ";
				$data .= ", status='$status' ";
				if ($save[] = $this->db->query("INSERT INTO parcels set $data"))
					$ids[] = $this->db->insert_id;
			} else {
				if ($save[] = $this->db->query("UPDATE parcels set $data where id = $id"))
					$ids[] = $id;
			}
		}
		if (isset($save) && isset($ids)) {
			// return json_encode(array('ids'=>$ids,'status'=>1));
			//header('Location:index.php');
			return 1;
		}
		else {
			return 2;
		}
	}

}
