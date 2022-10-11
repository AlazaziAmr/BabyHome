<link
    rel="stylesheet"
    href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
    crossorigin=""
/>

<script
    src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
    integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
    crossorigin=""
></script>
<script>

    var lat = {{ isset($data['lat']) ? $data['lat']  : 24.466667 }};
    var lng = {{ isset($data['log']) ? $data['log']  : 54.366669 }};
    var map = L.map('map',{
        center: [lat, lng],
        zoom: 15
    });

    var marker = L.marker([0,0]).addTo(map);

    marker.setLatLng([lat,lng]);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    map.on('click', function(e) {
        latlng = e.latlng;
        $('#lat').val(latlng.lat);
        $('#log').val(latlng.lng);
        marker.setLatLng([latlng.lat,latlng.lng]);

    });

</script>
