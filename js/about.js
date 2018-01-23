var map;

function initMap() {
    var myLatLng = {lat: 53.83, lng: 10.69};
    map = new google.maps.Map(document.getElementById('map'), {

        center: myLatLng,
        zoom: 15
    });

    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: 'Acute Software!'
    });
};