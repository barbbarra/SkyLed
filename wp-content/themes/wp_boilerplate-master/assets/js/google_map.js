//mapa//
function initMap() {
  var uluru = {
    lat: -33.430860,
    lng: -70.616648
  };
  var map = new google.maps.Map(document.getElementById('contact-map'), {
    zoom: 14,
    center: uluru,
    scrollwheel: false
  });
  var marker = new google.maps.Marker({
    position: uluru,
    map: map,
    icon: 'https://easetemplate.com/free-website-templates/life-coach/images/map_marker.png'

  });
}

initMap()