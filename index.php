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
       <script src="./ext_js/jquery-3.2.0.min.js"></script>
       <script src="./ext_js/jquery-ui.min.js"></script>
       <script src="./ext_js/jquery-ui.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.7/dt-1.10.13/datatables.min.css"/>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css"/>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

<style>
.label {
  padding: 0px 10px 0px 10px;
	border: 1px solid #ccc;
	-moz-border-radius: 1em; /* for mozilla-based browsers */
	-webkit-border-radius: 1em; /* for webkit-based browsers */
	border-radius: 1em; /* theoretically for *all* browsers*/
}

.label.lightblue {
	background-color: #99CCFF;
}

#external_filter_container_wrapper {
  margin-bottom: 20px;
}

#external_filter_container {
  display: inline-block;
}
</style>  

    </head>
    <body>
        <table id="example" class="display" cellspacing="0" width="100%">
            
        <thead>
            <tr>
                <th>Sorszám</th>
                <th>Kötetszám</th>
                <th>Megye</th>
                <th>Település SZTA</th>
                <th>Évszám</th>
                <th>Hivatkozás</th>
                <th>Adat</th>
                <th>Helyfajta</th>
                <th>SZTA megjegyzés</th>
                <th>Szélesség</th>
                <th>Hosszúság</th>
                <th>1913-as név</th>
                <th>Mai településnév</th>
                <th>Nem magyar névváltozat</th>
                <th>Nem magyar név SZTA</th>
                
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Sorszám</th>
                <th>Kötetszám</th>
                <th>Megye</th>
                <th>Település SZTA</th>
                <th>Évszám</th>
                <th>Hivatkozás</th>
                <th>Adat</th>
                <th>Helyfajta</th>
                <th>SZTA megjegyzés</th>
                <th>Szélesség</th>
                <th>Hosszúság</th>
                <th>1913-as név</th>
                <th>Mai településnév</th>
                <th>Nem magyar névváltozat</th>
                <th>Nem magyar név SZTA</th>
            </tr>
        </tfoot>
    </table>
        <script>
$(document).ready(function() {
    var table = $('#example').DataTable( {
//        "processing": true,
//        "serverSide": true,
        "ajax": {url: './GetData.php',   type: 'POST'},
          "columns": [
            {"data": "Sorszám"},
            {"data": "kötetszám"},
            {"data": "megye"},
            {"data": "település SZTA"},
            {"data": "évszám"},
            {"data": "hivatkozás"},
            {"data": "adat",text_data_delimiter: ",", enable_auto_complete: true},
            {"data": "helyfajta"},
            {"data": "SZTA megjegyzés"},
             {"data": "szélesség"},
            {"data": "hosszúság"},
            {"data": "1913-as név"},
            {"data": "mai településnév"},
            {"data": "nem magyar névváltozat"},
            {"data": "nem magyar név SZTA"}
            
            
          ]} );
      $('#example thead th').each( function () {
        var title = $(this).text();
        $(this).html( '<input id="'+title+'" type="text" placeholder="Keresés '+title+'" />' );
    } );
     table.columns().every( function () {
        var that = this;
 
        $( 'input', this.header() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
    
  
} );

</script>

        <?php
//        echo "haha2";
//        
//$servername = "localhost";
//$username = "root";
//$password = "";
//
//$conn = new mysqli($servername, $username, $password, "csv_db");
//mysqli_set_charset($conn, "utf8");
//// Check connection
//if ($conn->connect_error) {
//    die("Connection failed: " . $conn->connect_error);
//}
//echo "Connected successfully";
//
//$sql = "SELECT * from munka1";
//
//$result = $conn->query($sql);
//if ($result->num_rows > 0) {
//    // output data of each row
//    while($row = $result->fetch_assoc()) {
//        echo "adat: " . $row["adat"]. "<br>";
//    }
//} else {
//    echo "0 results";
//}
//
//$conn->close();
        ?>
    </body>
</html>


