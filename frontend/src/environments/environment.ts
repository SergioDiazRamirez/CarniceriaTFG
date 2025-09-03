// This file can be replaced during build by using the `fileReplacements` array.
// `ng build` replaces `environment.ts` with `environment.prod.ts`.
// The list of file replacements can be found in `angular.json`.

export const environment = {
  production: false,
  apiUrl: 'http://192.168.18.141:8000/api',//'http://localhost:8000/api',
  firebase: {
    apiKey: "AIzaSyCXkX7Dn31vvqoI0fE0bKDuFSkSIxPUduY",
    authDomain: "mi-carniceria-ccd11.firebaseapp.com",
    projectId: "mi-carniceria-ccd11",
    storageBucket: "mi-carniceria-ccd11.firebasestorage.app",
    messagingSenderId: "1075235705568",
    appId: "1:1075235705568:web:7be50c3102c400b5d7b685",
    measurementId: "G-0QNQGKRSLQ"
  }
};

/*
 * For easier debugging in development mode, you can import the following file
 * to ignore zone related error stack frames such as `zone.run`, `zoneDelegate.invokeTask`.
 *
 * This import should be commented out in production mode because it will have a negative impact
 * on performance if an error is thrown.
 */
// import 'zone.js/plugins/zone-error';  // Included with Angular CLI.
