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
import dateFormat, { masks } from "dateformat";

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

window.Echo.private('newReport.1').listen('NewReportEvent', (e) => {loadToTable(e)});
window.Echo.private('newReport.2').listen('NewReportEvent', (e) => {loadToTable(e)});
window.Echo.private('newReport.3').listen('NewReportEvent', (e) => {loadToTable(e)});

window.loadToTable = function(e){
    let clone = window.$("#report_item_template").clone();
    console.log(clone.html());
    clone.removeAttr("id");
    clone.removeAttr("class");
    clone.find(".report-time").html(dateFormat(e.report.created_at,"yyyy-mm-dd HH:MM:ss"));
    clone.find(".report-type").html(e.report.type.name);
    clone.find(".report-username").html(e.report.user.name);
    clone.find(".report-title").html(e.report.title);
    clone.find(".report-location").html(e.report.location);
    clone.find(".report-status").html(e.report.status);
    switch (e.report.status){
        case 'PENDING':
            clone.find(".report-status").addClass('text-red-500');
            break;
        case 'PROCESS':
            clone.find(".report-status").addClass('text-blue-500');
            break;
        case 'DONE':
            clone.find(".report-status").addClass('text-green-600');
            break;
    }
    clone.find(".report-detail").attr('href', window.location.href + '/' + e.report.id);
    clone.addClass("report-item");
    clone.addClass("report-status-"+e.report.status);
    let lastOfClass = window.$("#report_list .report-status-"+e.report.status).children().last();
    if(lastOfClass.length > 0){
        clone.insertAfter(lastOfClass);
    }else{
        window.$("#report_body").prepend(clone);
    }
}
