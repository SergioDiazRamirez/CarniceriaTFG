importScripts('https://www.gstatic.com/firebasejs/9.22.0/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/9.22.0/firebase-messaging-compat.js');


firebase.initializeApp({
    apiKey: "AIzaSyCXkX7Dn31vvqoI0fE0bKDuFSkSIxPUduY",
    authDomain: "mi-carniceria-ccd11.firebaseapp.com",
    projectId: "mi-carniceria-ccd11",
    storageBucket: "mi-carniceria-ccd11.firebasestorage.app",
    messagingSenderId: "1075235705568",
    appId: "1:1075235705568:web:7be50c3102c400b5d7b685",
});

const messaging = firebase.messaging();
