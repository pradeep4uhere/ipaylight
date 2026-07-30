
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/10.10.0/firebase-app.js";
  import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.10.0/firebase-analytics.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
    apiKey: "AIzaSyAfVROvbYtbFmY3GFnxylGBWDyaoB0dUec",
    authDomain: "payertrustmultiservices.firebaseapp.com",
    projectId: "payertrustmultiservices",
    storageBucket: "payertrustmultiservices.appspot.com",
    messagingSenderId: "1055307368237",
    appId: "1:1055307368237:web:3fac070ea3639930f3f5a4",
    measurementId: "G-SJG6LQS6ML"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const analytics = getAnalytics(app);
