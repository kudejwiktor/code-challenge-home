var app = app || {};
app.services = app.services || {};
app.services.notification = {};

app.services.notification.show = (message) => {
  const notificationElement = document.getElementsByClassName('notification')[0];
  notificationElement.classList.remove('is-hidden');
  const p = notificationElement.getElementsByTagName('p')[0];
  p.innerHTML = message;
}

/**
 * Close notification event
 */
document.addEventListener('DOMContentLoaded', () => {
  (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
    $notification = $delete.parentNode;
    $delete.addEventListener('click', () => {
      $notification.parentNode.removeChild($notification);
    });
  });
});