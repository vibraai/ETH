
            
            function initMap() {
                var uluru = {lat: 46.274, lng: 23.069};
                map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 8,
                    center: uluru
                });
                markers = new Array();
                lastinfowindow = -1;
            }


            function addMarker(x, y, city, data) {
                x = parseFloat(x).toPrecision(5);
                y = parseFloat(y).toPrecision(5);
                for (var i = 0; i < markers.length; i++) {
                    //   console.log("Do we have the marker at " + i + " : " + markers[i].getPosition().lat() + " == " + x + markers[i].getPosition().lng() + " == " + y);
                    if (parseFloat(markers[i].getPosition().lat()).toPrecision(5) === x && parseFloat(markers[i].getPosition().lng()).toPrecision(5) === y) {
                        //    console.log("Marker already exists");
                        var contentText = markers[i].infowindow.content;
                        contentText = contentText + data + "<br>";
                        markers[i].infowindow.setContent(contentText);
                        //   console.log(markers[i].infowindow.content);
                        return;
                    }
                }

                var marker = new google.maps.Marker({
                    map: map,
                    position: new google.maps.LatLng(x, y)
                });

                var contentHtml = "<h5>" + "Település : " + city + "</h5>" + data + "<br>";
                var infoWindow = new google.maps.InfoWindow({
                    content: contentHtml
                });
                marker.infowindow = infoWindow;
                google.maps.event.addListener(marker, 'click', function () {
                    if (lastinfowindow >= 0)
                        markers[lastinfowindow].infowindow.close();
                    marker.infowindow.open(map, marker);
                    lastinfowindow = marker.count;
                });

                markers.push(marker);
                map.setCenter(marker.getPosition());
            }
//            $(document).ready(function () {
//                //ide click felülírás, tömb összeállítás serlializálás
////
////                $("#example tbody td").live('click',function(){
////var aPos = $('#example').dataTable().fnGetPosition(this);
////var aData = $('#example').dataTable().fnGetData(aPos[0]);
////console.log(aData);
////});
//              
//            });

            function destroy() {
                for (var i = 0; i < markers.length; i++) {
                    if (markers[i] !== undefined)
                        markers[i].setMap(null);
                }
                markers = [];
                lastinfowindow = -1;
            }
     




    