var app = app || {};
app.services = app.services || {};
app.services.map = {};

app.services.map.render = function(data) {
  const options = {
    zoom: 8,
    center: {
      lat: 53.424622,
      lng: 14.561325
    },
  };
  const map = new google.maps.Map(document.getElementById('map'), options);
  const markers = data;

  markers.forEach((marker) => {
    addMarker(marker);
  });

  function addMarker(props) {
    const marker = new google.maps.Marker({
      position: props.coords,
      map: map,
    });

    if (props.content) {
      const infoWindow = new google.maps.InfoWindow({
        content: props.content,
      });

      marker.addListener('mouseover', function () {
        infoWindow.open(map, marker);
      });

      marker.addListener('mouseout', function () {
        infoWindow.close(map, marker);
      });
    }
  }
}