// Import the functions you need from the SDKs you need
import {
  initializeApp
} from "https://www.gstatic.com/firebasejs/10.7.2/firebase-app.js";
import {
  getMessaging,
  getToken
} from "https://www.gstatic.com/firebasejs/10.7.2/firebase-messaging.js";

// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyDIVLU4UdSYndP7OZuKLPMOuNm5QMbAr_A",
  authDomain: "belajar-403115.firebaseapp.com",
  projectId: "belajar-403115",
  storageBucket: "belajar-403115.appspot.com",
  messagingSenderId: "921599509873",
  appId: "1:921599509873:web:8ce9a9280b1511cc4e22d0",
  measurementId: "G-HZ50Y022BS"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const messaging = getMessaging(app);

navigator.serviceWorker.register("sw.js").then(registration => {
  getToken(messaging, {
    ServiceWorkerRegistration: registration,
    vapidKey: 'BNDIc3W3rG4logY_AIRBgl7VoRRfq3te0S7Ww6iiwPm8W_VcaeI3_CFHW3oeYy2jfThW4BT1WE6pAh9xrqjQdVU'
  }).then((currentToken) => {
    if (currentToken) {
      console.log("Token is: " + currentToken);
      console.log('Message received. ', currentToken);
      const messagesElement = document.querySelector('.message');
      const dataHeaderElement = document.createElement('h5');
      const dataElement = document.createElement('pre');
      dataHeaderElement.textContent = "Message Received:";
      dataElement.textContent = JSON.stringify(currentToken, null, 2);
      messagesElement.appendChild(dataHeaderElement);
      messagesElement.appendChild(dataElement);
    } else {
      // Show permission request UI
      console.log('No registration token available. Request permission to generate one.');
      const messagesElement = document.querySelector('.message');
      const dataHeaderElement = document.createElement('h5');
      const dataElement = document.createElement('pre');
      dataElement.style = "overflow-x: hidden;";
      dataHeaderElement.textContent = "Message Received:";
      dataElement.textContent = JSON.stringify('No registration token available. Request permission to generate one.', null, 2);
      messagesElement.appendChild(dataHeaderElement);
      messagesElement.appendChild(dataElement);
      // ...
    }
  }).catch((err) => {
    console.log('An error occurred while retrieving token. ', err);
    const messagesElement = document.querySelector('.message');
      const dataHeaderElement = document.createElement('h5');
      const dataElement = document.createElement('pre');
      dataElement.style = "overflow-x: hidden;";
      dataHeaderElement.textContent = "Message Received:";
      dataElement.textContent = JSON.stringify('An error occurred while retrieving token.', null, 2);
      messagesElement.appendChild(dataHeaderElement);
      messagesElement.appendChild(dataElement);
    // ...
  });
});