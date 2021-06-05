<?

define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBPASS", "root");
define("DBNAME", "ikea_auction");

session_start();

include('functions.php');
connect();
include('header.php');
