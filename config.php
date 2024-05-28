<?php
const SLASH = DIRECTORY_SEPARATOR;
const VIEW_FOLDER = __DIR__ . SLASH . 'view' . SLASH;

// CONN
$servername = "gateway01.us-west-2.prod.aws.tidbcloud.com";
$username = "4TgPi4JhJhMYFBE.root";
$password = "SFs6hKVBgjcKdhMs";
$database = "OBT2024";
$port = 4000;
$ca_root = 'certificates/isrgrootx1.pem';

// Cria conexão
define("CONN", mysqli_init());
mysqli_ssl_set(CONN, NULL, NULL, $ca_root, NULL, NULL);

// Estabelece conexão
if (!CONN->real_connect($servername, $username, $password, $database, $port)) {
    die("Conexão falhou: " . CONN->connect_error);
}
//----