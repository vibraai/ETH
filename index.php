<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <style>
       #map {
        height: 400px;
        width: 100%;
       }
    </style>
        <meta charset="UTF-8">
        <title></title>
        <script src="./ext_js/jquery-3.2.0.min.js"></script>
        <script src="./ext_js/jquery-ui.min.js"></script>
        <script src="./ext_js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
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
                <th>Egyéb megjegyzés</th>
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
                <th>Egyéb megjegyzés</th>
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
    var checkKotetszam = $("#checkKötetszám").is(":checked");
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
            
            
          } );
//          table.ajax.url('nice.php?'+cucc=fos).load();
 checkKotetszam = $("#checkKötetszám").is(":checked");
if (checkKotetszam === undefined) checkKotetszam = $("#checkKötetszám").is(":checked");
         table.ajax.url('Nice.php?'+'checkKotetszam='+checkKotetszam);
      $('#example thead th').each( function () {
        var title = $(this).text();
        $(this).html( '<input id="'+title+'" type="text" placeholder="Keresés '+title+'" /><input type="checkbox" id="check'+title+'" value=""> És kapcsolat' );
    } );
     table.columns().every( function () {
        var that = this;
        if (checkKotetszam === undefined) checkKotetszam = $("#checkKötetszám").is(":checked");
 table.ajax.url('Nice.php?'+'checkKotetszam='+checkKotetszam);
        $( 'input', this.header() ).on( 'keyup change', function () {
            if (checkKotetszam === undefined) checkKotetszam = $("#checkKötetszám").is(":checked");
            table.ajax.url('Nice.php?'+'checkKotetszam='+checkKotetszam);
            if (this.id=="checkKötetszám"){
                
            var checkKotetszam = $("#checkKötetszám").is(":checked");
            var kotetszam = $("#Kötetszám").val();
            console.debug(checkKotetszam);
            console.debug(kotetszam.value);
            if (checkKotetszam === undefined) checkKotetszam = $("#checkKötetszám").is(":checked");
          table.ajax.url('Nice.php?'+'checkKotetszam='+checkKotetszam);
            if ( that.search() !== kotetszam.value ) {
              
                that
                    .search( kotetszam )
                    .draw();
            }
        }
        else {
             if ( that.search() !== this.value ) {
              
                that
                    .search( this.value )
                    .draw();
            }
        } });
    } );
    
  
} );

</script>


    <input type="button" id="startMap" name="getAllPlace" value="Találatok megjelenítése"></input>
    
    <h3>My Google Maps Demo</h3>
    <div id="map"></div>
    <script>
        function initMap() {
            var uluru = {lat: -25.363, lng: 131.044};
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 4,
                center: uluru
            });
            markers=new Array();
        }
        
      
        function addMarker(x,y){
            x = parseFloat(x).toPrecision(5);
            y = parseFloat(y).toPrecision(5);
            for (var i = 0; i < markers.length; i++) {
                console.log("Do we have the marker at " + i + " : " + markers[i].getPosition().lat() + " == " + x + markers[i].getPosition().lng() + " == " + y);
                if ( parseFloat(markers[i].getPosition().lat()).toPrecision(5) === x && parseFloat(markers[i].getPosition().lng()).toPrecision(5) === y) {
                    console.log("Marker already exists");
                    return;
                }
            }
            var marker = new google.maps.Marker({
                map: map,
                position: new google.maps.LatLng(x,y)
            });

            markers.push(marker);
            map.setCenter(marker.getPosition());
        }
    
        function drawEvents(json){
            for(var i=0; i<json.length;++i){
                if(json[i]['x']!=0 || json[i]['y']!=0){
                    addMarker(i,json[i]['x'],json[i]['y']);
                    $('#'+i).click(function(e){
                        var marker = markers[$(e.target).attr('id')];
                        var myLatLng = marker.getPosition();
                        map.setCenter(myLatLng);
                        $("html, body").animate({ scrollTop: '0px' }, 500);
                        return false;
                    });
                }else{

                }
            }
        }
        $(document).ready(function(){

            $('#startMap').live('click', function() {
                var table = $('#example').DataTable();
                var data = table.rows().data();
                for (var i = 0; i < 70; i++) {
                    addMarker(data[i]["szélesség"], data[i]["hosszúság"]);
                }
            });
        });
    
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQ6ZwsrToM9FWmbAxMRSJGac88zm4xmfg&callback=initMap">
    </script>
    </body>
</html>


