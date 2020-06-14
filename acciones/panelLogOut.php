<?php
require('../config/config.php');

$_SESSION['usuario']['panel'] = 0;
header("Location:../index.php");