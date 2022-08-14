<?php


// Connection info
$host='127.0.0.1';
$dbname='greatproducts';
$user='root';
$pass='';
$charset='utf8mb4';


//sys_temp_dir = "${WINDIR}"

//--- ${WINDIR} will be replaced by $_ENV['WINDIR'] at runtime


//--- FcgidInitialEnv AUTHOR "NRGESTIEHR"
//--- error_log = "${AUTHOR}.log"

//error_log = "${sys_temp_dir}"

//--- ${sys_temp_dir} will be replace by the value of sys_temp_dir


//error_log = "/data/"PHP_VERSION"/"

//---  it works like this php code:

//$error_log =  "/data/" . PHP_VERSION . "/";

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";


$options=[
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
	PDO::ATTR_EMULATE_PREPARES=>false,
];

$db = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset='.$charset,$user,$pass,$options);
?>
