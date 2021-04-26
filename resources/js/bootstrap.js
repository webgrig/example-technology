window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');
    window.io = require('socket.io-client');

    require('bootstrap');
} catch (e) {}

let modalConfirm = function(callback){
    let btnsDel = $(".btn-modal-confirm");
    let btnConfirm;
    btnsDel.on("click", function(){
        btnConfirm = this;
        $("#mi-modal").modal('show');
    });

    $("#modal-btn-si").on("click", function(){
        callback(true);
        $("#mi-modal").modal('hide');
        let form = $("#" + $(btnConfirm).data('formId'))
        form.submit();
    });

    $("#modal-btn-no").on("click", function(){
        callback(false);
        $("#mi-modal").modal('hide');
    });
};

modalConfirm(function(confirm){
    return confirm;
});


window.onload = function () {

    $('.button-redirect').on('click', function (){
        window.location.replace($(this).data('redirect'))
        console.log(this)
    })

    $(function () {
        $(document).on('click', 'body', function (e) {
            $('.dropdown .submenu').hide();
            e.stopPropagation();
        });

        // make it as accordion for smaller screens
        $('.dropdown a').mouseover(function (e) {
            e.preventDefault();
            if ($(this).next('.submenu').length) {
                $(this).next('.submenu').slideToggle(100);
            }
        });
    });


};

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

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });


