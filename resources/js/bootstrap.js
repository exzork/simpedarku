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
    let clone = window.$("#report_item_template > tr").clone();
    clone(".report-time").html(e.report.created_at);
    clone(".report-type").html(e.report.type.name);
    clone(".report-username").html(e.report.user.name);
    clone(".report-title").html(e.report.title);
    clone(".report-location").html(e.report.location);
    clone(".report-status").html(e.report.status);
    switch (e.report.status){
        case 'PENDING':
            clone(".report-status").addClass('text-red-500');
            break;
        case 'PROCESS':
            clone(".report-status").addClass('text-blue-500');
            break;
        case 'DONE':
            clone(".report-status").addClass('text-green-600');
            break;
    }
    clone(".report-detail").attr('href', window.location.href + '/' + e.report.id);
    window.$("#report_body").prepend(clone);
}
