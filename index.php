<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
<!--        <script src="./ext_js/jquery-3.2.0.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.7/dt-1.10.13/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.7/dt-1.10.13/datatables.min.js"></script>-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css"/>
<script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    </head>
    <body>
        <table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>First name</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>First name</th>
            </tr>
        </tfoot>
    </table>
        <script>
$(document).ready(function() {
    $('#example').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": {url: './GetData.php',   type: 'POST'},
          "columns": [
            {"data": "adat"}
          ]} );
} );
</script>
        <?php
        echo "haha2";
        
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password, "csv_db");
mysqli_set_charset($conn, "utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$sql = "SELECT * from munka1";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "adat: " . $row["adat"]. "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
        ?>
    </body>
</html>


