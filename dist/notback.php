<?php
if (isset($_SESSION['uname'])) {
	header("location: admin/logout.php");
}
