<!-- ============================== -->
<!-- PART 1 PROCESS BID PLACEHOLDER -->
<!-- ============================== -->
<?php 
	require('includes/db.php');

	$name = $_POST['name'];
	$value = $_POST['value'];
	$car_id = $_POST['car_id'];

	$success = TRUE;

	try {
		if (!isset($name) || empty($name))
			throw new Exception('A name must be specified in order to place a bid. Please go back and try again.');
		
		if (!isset($value) || empty($value) || !is_numeric($value) || $value <= 0)
			throw new Exception('Invalid bid amount. Please go back and try again.');

		if (!isset($car_id) || empty($car_id) || !is_numeric($car_id) || $car_id < 0)
			throw new Exception('The car ID must be specified in order to place a bid. Please go back and try again.');
	} catch (Exception $e) {
		$success = FALSE;
		echo "An Error Occured <br /><br />";
		echo $e->getMessage();
	}

	if ($success) {
		$bid = $db->query("INSERT INTO bid (car_id, name, value, datetime) VALUES ('$car_id', '$name', '$value', NOW())");
		echo "Success! Your bid has been added";
		header("Location: success.php/?id=$car_id");
	}
?>