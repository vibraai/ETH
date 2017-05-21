<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <style>
       body, html {
        height: 100%;
        width: 100%;
       }
       #map {
        height: 100%;
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
    table = $('#example').DataTable( {
                "bProcessing": true,
		"bServerSide": true,
                "sAjaxSource":  "./Nice.php",
          } );

 checkKotetszam = $("#checkKötetszám").is(":checked");
if (checkKotetszam === undefined) checkKotetszam = $("#checkKötetszám").is(":checked");
         table.ajax.url('Nice.php?'+'checkKotetszam='+checkKotetszam);
      $('#example thead th').each( function () {
        var title = $(this).text();
        $(this).html( '<input id="'+title+'" type="text" placeholder="Keresés '+title+'" /><input style="display:none" type="checkbox" id="check'+title+'" value="">' );
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
    
    <h3>Találatok térképen</h3>
    <div id="map"></div>
    <script>
        function initMap() {
            var uluru = {lat: 46.274, lng: 23.069};
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 8,
                center: uluru
            });
            markers=new Array();
            lastinfowindow=-1;
        }
        
      
        function addMarker(x, y, city, data){
            x = parseFloat(x).toPrecision(5);
            y = parseFloat(y).toPrecision(5);
            for (var i = 0; i < markers.length; i++) {
                console.log("Do we have the marker at " + i + " : " + markers[i].getPosition().lat() + " == " + x + markers[i].getPosition().lng() + " == " + y);
                if ( parseFloat(markers[i].getPosition().lat()).toPrecision(5) === x && parseFloat(markers[i].getPosition().lng()).toPrecision(5) === y) {
                    console.log("Marker already exists");
                    var contentText = markers[i].infowindow.content;
                    contentText = contentText + data + "<br>";
                    markers[i].infowindow.setContent(contentText);
                    console.log(markers[i].infowindow.content);
                    return;
                }
            }
            var marker = new google.maps.Marker({
                map: map,
                position: new google.maps.LatLng(x,y)
            });

            var contentHtml = "<h5>" +"Település : "+ city +"</h5>" + data + "<br>";
            var infoWindow = new google.maps.InfoWindow({
                content: contentHtml
            });
            marker.infowindow = infoWindow;
            google.maps.event.addListener(marker, 'click', function() {
                if(lastinfowindow >=0) markers[lastinfowindow].infowindow.close();
                    marker.infowindow.open(map, marker);
                    lastinfowindow = marker.count;  		
                });
            
            markers.push(marker);
            map.setCenter(marker.getPosition());
        }
        $(document).ready(function(){

            $('#startMap').live('click', function() {
                destroy();
                var data = table.rows().data();
                for (var i = 0; i < data.length; i++) {
                    console.log(data);
                    console.log(data[i][3][6]);
                    addMarker(data[i][10], data[i][11], data[i][3], data[i][6]);
                }
            });
        });
        
        function destroy(){
            for (var i = 0; i < markers.length; i++) {
            if (markers[i] !== undefined)
                    markers[i].setMap(null);
            }
            markers=[];
            lastinfowindow=-1;
	}
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQ6ZwsrToM9FWmbAxMRSJGac88zm4xmfg&callback=initMap">
    </script>
    </body>
</html>


