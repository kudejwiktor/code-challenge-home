document.getElementById('filter').addEventListener('click', () => {
  app.services.location.filter();
});

function renderMap() {
  app.services.location.fetch();
}