<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function getData($sql){
    $servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password, "csv_db");
mysqli_set_charset($conn, "utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    $query = mysqli_query($conn, $sql) OR DIE ("Can't get Data from DB , check your SQL Query " );
    $data = array();
    foreach ($query as $row ) {
        $data[] = $row ;
    }
    $conn->close();
    return $data;
}




//echo "Connected successfully2";

$sql = "SELECT * from munka1";
//print_r(getData("SELECT * from munka1"));
$data = getData("SELECT * from munka1");
$response = array(
    "data" => $data
);
echo json_encode($response,JSON_UNESCAPED_UNICODE);

//$arr = array('a' => 1);
//echo "{\"draw\":0,\"recordsTotal\":57,\"recordsFiltered\":57,\"data\":[[\"ide\":2,\"gyere\":3, \"kell\":4, \"aza\":5, \"adat\":6]]}";

//echo json_encode($arr);
//$result = $conn->query($sql);
//$data_array = array();
//
//$i = 0;
//while ($row = mysqli_fetch_assoc($result)) {
//    if($i==10)
//        break;
//    $data_array[][] = $row['adat'];
//    $i++;
//}
//echo json_encode($data_array);
//
//
//if ($result->num_rows > 0) {
//    // output data of each row
//    while($row = $result->fetch_assoc()) {
//       // echo "adat: " . $row["adat"]. "<br>";
//        echo json_encode($row);
//    }
//} else {
//    echo "0 results";
//}

//echo json_encode($result);
        ?>
