<?php
session_name('report');
session_start();
if (empty($_SESSION['test'])) {
	$_SESSION['test'] = time();
}
echo $_SESSION['test'] . session_name();
session_write_close();
