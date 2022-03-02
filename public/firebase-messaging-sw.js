importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

firebase.initializeApp({
    apiKey: "AIzaSyD4n1dS7zBbr8Gyjibfe1jFVKIZBsgKkeQ",

    authDomain: "pc-covid-a996f.firebaseapp.com",

    projectId: "pc-covid-a996f",

    storageBucket: "pc-covid-a996f.appspot.com",

    messagingSenderId: "806316885713",

    appId: "1:806316885713:web:cdbcf235b5ee681e3227f0",

    measurementId: "G-578BHJEPRH"

});

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (payload) {
    console.log("Message received.", payload);
    const title = "Hello world is awesome";
    const options = {
        body: "Your notificaiton message .",
        icon: "/firebase-logo.png",
    };
    return self.registration.showNotification(
        title,
        options,
    );
});
