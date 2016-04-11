//Zmienne globalne
var mapa;
var dymek;
//Funkcja do wyświetlania mapy, ładuje się podczas uruchamiania strony
window.onload = function mapaStart()
{
    var wspolrzedne = new google.maps.LatLng(53.429805, 14.537883);
    var customMapType = new google.maps.StyledMapType(
        [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"lightness":21},{"saturation":"-100"},{"gamma":"1.02"},{"visibility":"on"},{"color":"#424242"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"saturation":"0"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ff6900"},{"lightness":"-3"},{"saturation":"100"}]},{"featureType":"road.arterial","elementType":"labels.text","stylers":[{"visibility":"simplified"},{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16},{"saturation":"-100"},{"gamma":"1"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#00a3ff"},{"lightness":17}]}
        ],{
            name: 'Dark'
        });
    var customMapTypeId = 'custom_style';

    var opcjeMapy = {
        zoom: 4,
        center: wspolrzedne,
        mapTypeControlOptions: {
            mapTypeIds: [customMapTypeId],
        }
    };
    dymek  = new google.maps.InfoWindow();
    mapa = new google.maps.Map(document.getElementById("map"), opcjeMapy);
    getData();
    mapa.mapTypes.set(customMapTypeId, customMapType);
    mapa.setMapTypeId(customMapTypeId);
    google.maps.event.trigger('click');
};
//Funkcja do parsowania danych w postaci JSON otrzymanych postem od Bundla do tablic zmiennych
function getData() {
    var marker;
    var idd = [];
    var laa = [];
    var loo = [];
    var ico = [];
    var naa = [];
    var op = [];
    $.ajax({
        type: 'POST',
        url: 'app_dev.php/pointa/{{ id }}',
        dataType: 'text',
        success: function(data) {
            console.log(data+'dupa3');
        }
    });
    $.ajax({
        type: "POST",
        url: 'app_dev.php/pointa/2',
        dataType: 'json',
        success: function(data) {
            var i=0;
            idd[i] = data.id;
            laa[i] = data.lat;
            loo[i] = data.lon;
            ico[i] = data.ikona;
            naa[i] = data.nazwa;
            op[i] = data.danesm;
            marker = dodajMarker(laa[i],loo[i],ico[i],naa[i],op[i],idd[i]);
            console.log('dupa2');
        },
        error: function(data) {
            for(var i=0; i<data.length; i++) {
                idd[i] = data[i].id;
                laa[i] = data[i].lat;
                loo[i] = data[i].lon;
                ico[i] = data[i].ikona;
                naa[i] = data[i].nazwa;
                op[i] = data[i].danesm;
                marker = dodajMarker(laa[i],loo[i],ico[i],naa[i],op[i],idd[i]);
                console.log('dupa');
            }
        }
    });
    //$.ajax({
    //    type: 'POST',
    //    url: '/google_maps/web/app_dev.php',
    //    dataType: 'json',
    //    success: function(data) {
    //        console.log(data.id);
    //    }
    //});
}
//Funkcja do dodawania markerów na mapę
function dodajMarker(lat, lon, ikona_url, nazwa, opis, id)
{
    var rozmiar = new google.maps.Size(30,23);
    var punkt_startowy = new google.maps.Point(0,0);
    var punkt_zaczepienia = new google.maps.Point(15,12);

    var ikona = new google.maps.MarkerImage(ikona_url, rozmiar, punkt_startowy, punkt_zaczepienia);

    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(lat,lon),
        title: nazwa,
        icon: ikona,
        map: mapa
    });

    marker.txt = opis+'<br><a class="btn btn-sm btn-danger" href="point/'+id+'">Zobacz</a>';

    google.maps.event.addListener(marker,"click",function(zdarzenie) {
        if(zdarzenie) {
            dymek.setContent(marker.txt);
            dymek.open(mapa, marker);
        }
    });
    return marker;
}