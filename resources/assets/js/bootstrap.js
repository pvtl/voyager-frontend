// We'll load jQuery and the Foundation plugin/s which provides support
// for JavaScript based Foundation features such as modals and tabs. This
// code may be modified to fit the specific needs of your application.

//import Echo from 'laravel-echo'
//import Pusher from 'pusher-js';

require('./vendor/modernizr.min');
require('foundation-sites');
window.$ = window.jQuery = require('jquery');
window.ScrollReveal = require('scrollreveal').default;
window.axios = require('axios');

// We'll load the axios HTTP library which allows us to easily issue requests
// to our Laravel back-end. This library automatically handles sending the
// CSRF token as a header based on the value of the "XSRF" token cookie.
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Next we will register the CSRF Token as a common header with Axios so that
// all outgoing HTTP requests automatically have it attached. This is just
// a simple convenience so we don't have to attach every token manually.
const token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

// Echo exposes an expressive API for subscribing to channels and listening
// for events that are broadcast by Laravel. Echo and event broadcasting
// allows your team to easily build robust real-time web applications.
/*
window.Echo = new Echo({
  broadcaster: 'pusher',
  key: 'your-pusher-key',
  cluster: 'mt1',
  encrypted: true
});
*/
