var app = app || {};
app.services = app.services || {};
app.services.query = {};

app.services.query.build = (params) => {
  let esc = encodeURIComponent;
  let query = Object.keys(params)
    .map(function (k) {
        if (params[k]) {
          return esc(k) + '=' + esc(params[k])
        }
      }
    )
    .join('&');
  return '?' + query;
};