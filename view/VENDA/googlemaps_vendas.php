<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <style>
            /* Always set the map height explicitly to define the size of the div
             * element that contains the map. */
            #map {
                height: 65%;
                width: 70%; 
            }
            /* Optional: Makes the sample page fill the window. */
            html, body {
                height: 65%;
                margin: 0;
                padding: 0;
            }
        </style>
    </head>   

    <body>
        <h3>Ajuste o zoom para ver os pontos</h3>
         <div id="map"></div>

        <script>
            var customLabel = {
                restaurant: {
                    label: 'R'
                },
                bar: {
                    label: 'B'
                }
            };

            function initMap() {
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: new google.maps.LatLng(-20.549948, -48.038969),
                    zoom: 2
                });
                var infoWindow = new google.maps.InfoWindow;

                // Change this depending on the name of your PHP or XML file
                downloadUrl('http://www.centralmetadevendas.com.br/SistemaCMDV/view/VENDA/maps.php', function (data) {
                    var xml = data.responseXML;
                    var markers = xml.documentElement.getElementsByTagName('marker');
                    Array.prototype.forEach.call(markers, function (markerElem) {
                        var name = markerElem.getAttribute('name');
                        var address = markerElem.getAttribute('address');
                        // var type = markerElem.getAttribute('type');

                        var point = new google.maps.LatLng(
                                parseFloat(markerElem.getAttribute('lat')),
                                parseFloat(markerElem.getAttribute('lng')));

                        var infowincontent = document.createElement('div');
                        var strong = document.createElement('strong');
                        strong.textContent = name
                        infowincontent.appendChild(strong);
                        infowincontent.appendChild(document.createElement('br'));

                        var text = document.createElement('text');
                        text.textContent = address
                        infowincontent.appendChild(text);
                        var icon = customLabel[name] || {};

                        var image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';
                        var marker = new google.maps.Marker({
                            map: map,
                            position: point,
                            label: icon.label,
                            icon: image
                        });

                        marker.addListener('click', function () {
                            infoWindow.setContent(infowincontent);
                            infoWindow.open(map, marker);
                        });
                    });
                });
            }



            function downloadUrl(url, callback) {
                var request = window.ActiveXObject ?
                        new ActiveXObject('Microsoft.XMLHTTP') :
                        new XMLHttpRequest;

                request.onreadystatechange = function () {
                    if (request.readyState == 4) {
                        request.onreadystatechange = doNothing;
                        callback(request, request.status);
                    }
                };

                request.open('GET', url, true);
                request.send(null);
            }

            function doNothing() {}
        </script>
        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh_Sue500g4M3kMtw-5zG02vp_gnY8Y30&callback=initMap">
        </script>
    </body>
</html>