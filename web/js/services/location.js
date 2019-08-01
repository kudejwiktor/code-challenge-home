var app = app || {}
app.services = app.services || {};
app.services.location = {};

app.services.location.fetch = (query = "") => {
  fetch('http://localhost:8080/rest/locations' + query)
    .then((resp) => {
      if (resp.status === 404) {
        app.services.notification.show("Results not found")
        throw Error("Not found");
      }
      return resp.json();
    }).then((data) => {
    let markers = [];
    data.forEach((location) => {
      markers.push({
        content: '<h1>' + location.name + '</h1>',
        coords: {
          lat: location.latitude,
          lng: location.longitude
        }
      })
    });

    app.services.map.render(markers);
  }).catch((error) => {
    app.services.map.render([]);//reset markers
  });
}

app.services.location.filter = () => {
  let query = {};
  const distance = document.getElementById('distance');
  const text = document.getElementById('text');

  if (distance.value) {
    query.distance = distance.value;
  }
  if (text.value) {
    query.text = text.value;
  }
  app.services.location.fetch(app.services.query.build(query));
}

app.services.location.create = (data) => {
  fetch('http://localhost:8080/rest/add', {
    method: 'POST', // *GET, POST, PUT, DELETE, etc.
    mode: 'cors', // no-cors, cors, *same-origin
    cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(data)
  }).then(res => res.json())
    .then((res) => {
      const error = res.error || null;
      if (error) {
        if (error.code === 400) {
          app.services.errorMessage.show(error);
        }
      }
    });
}