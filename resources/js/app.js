// /**
//  * First we will load all of this project's JavaScript dependencies which
//  * includes Vue and other libraries. It is a great starting point when
//  * building robust, powerful web applications using Vue and Laravel.
//  */

// require('./bootstrap');

// window.Vue = require('vue').default;

// /**
//  * The following block of code may be used to automatically register your
//  * Vue components. It will recursively scan this directory for the Vue
//  * components and automatically register them with their "basename".
//  *
//  * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
//  */

// // const files = require.context('./', true, /\.vue$/i)
// // files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
//  */

// const app = new Vue({
//     el: '#app',
// });


require('./bootstrap');

const new_msg = document.getElementById("new_msg");
const message_input = document.getElementById("message_input");
const message_form = document.getElementById("message_form");

if (message_form != null) {
    message_form.addEventListener('submit', function (e) {
        e.preventDefault();

        let has_errors = false;

        if (message_input.value == '') {
            alert("Please enter a message!");
            has_errors = true;
        }

        if (has_errors) {
            return;
        }

        const options = {
            method: 'post',
            url: '/send-message',
            data: {
                message: message_input.value
            }
        }

        axios(options);
    })

    window.Echo.channel('chat')
        .listen('.message', (e) => {
            console.log(e);
            message_input.value = '';
            new_msg.innerHTML +=
                '<div class="incoming_msg_img mt-3">' +
                '<img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> ' +
                '</div>' +
                '<div class="received_msg">' +
                '<div class="received_withd_msg">' +
                '<b>' + e.username +'</b>' +
                '<p>' + e.message +'</p>' +
                '</div>' +
                '</div>';
        })
}

