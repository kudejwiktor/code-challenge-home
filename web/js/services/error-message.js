var app = app || {};
app.services = app.services || {};

app.services.errorMessage = {};

app.services.errorMessage.show = (aError) => {
  const error = aError;
  Object.entries(error.message).forEach((key) => {
    const selector = key[0];
    const field = document.getElementById(selector);
    const messageElement = field.nextElementSibling;
    messageElement.classList.remove('is-hidden');
    messageElement.innerHTML = key[1];
  });
}

app.services.errorMessage.hide = () => {
  const errorFields = document.querySelectorAll('.is-danger');
  errorFields.forEach(field => {
    field.classList.add('is-hidden');
  });
}