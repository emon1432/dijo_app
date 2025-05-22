importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

firebase.initializeApp({
    apiKey: "AIzaSyByqXD4A1qtQCULWr36RcjmswhXjgltB64",
    authDomain: "dijo-4cd8c.firebaseapp.com",
    projectId: "dijo-4cd8c",
    storageBucket: "dijo-4cd8c.firebasestorage.app",
    messagingSenderId: "730819239818",
    appId: "1:730819239818:web:3a903dbf77e6152f473273",
    measurementId: "G-QKR945QKXX"
});

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (payload) {
    return self.registration.showNotification(payload.data.title, {
        body: payload.data.body ? payload.data.body : '',
        icon: payload.data.icon ? payload.data.icon : ''
    });
});