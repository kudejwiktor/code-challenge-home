document.getElementById('add-location').addEventListener('click', () => {
  const name = document.getElementById('name').value;
  const street = document.getElementById('street').value;
  const suiteNumber = document.getElementById('suit_number').value;
  const postalCode = document.getElementById('postal_code').value;
  const city = document.getElementById('city').value;
  const latitude = document.getElementById('latitude').value;
  const longitude = document.getElementById('longitude').value;

  app.services.location.create({
    name: name,
    street: street,
    suite_number: suiteNumber,
    postal_code: postalCode,
    city: city,
    latitude: latitude,
    longitude: longitude,
  })
});