window._ = require('lodash');

try {
    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.$ = window.jQuery = require('jquery');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    wsHost: process.env.MIX_PUSHER_HOST,
    wsPort: process.env.MIX_PUSHER_PORT,
    wssPort: process.env.MIX_PUSHER_PORT,
    forceTLS: true,
    encrypted: true,
    disableStats: true,
    enabledTransports: ['ws', 'wss'],
});

window.Echo.private('newReport.1').listen('NewReportEvent', (e) => loadToTable(e));
window.Echo.private('newReport.2').listen('NewReportEvent', (e) => loadToTable(e));
window.Echo.private('newReport.3').listen('NewReportEvent', (e) => loadToTable(e));

window.loadToTable = function (e){
    let template = window.$("#report_item_template").children()[0];
    let clone = template.cloneNode(true);
    clone.querySelector(".report-time").innerHTML = e.report.created_at;
    clone.querySelector(".report-type").innerHTML = e.report.type.name;
    clone.querySelector(".report-username").innerHTML = e.report.user.name;
    clone.querySelector(".report-title").innerHTML = e.report.title;
    clone.querySelector(".report-location").innerHTML = e.report.location;
    clone.querySelector(".report-status").innerHTML = e.report.status;
    switch (e.report.status){
        case 'PENDING':
            clone.querySelector(".report-status").classList.add('text-red-500');
            break;
        case 'PROCESS':
            clone.querySelector(".report-status").classList.add('text-blue-500');
            break;
        case 'DONE':
            clone.querySelector(".report-status").classList.add(' ext-green-600');
            break;
    }
    clone.querySelector(".report-detail").attr('href', window.location.href + '/' + e.report.id);
    window.$("#report_body").prepend(clone);
}
