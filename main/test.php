<script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.7/firebase-app.js";
  import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.6.7/firebase-analytics.js";
  import { getMessaging , getToken, onMessage} from "https://www.gstatic.com/firebasejs/9.6.7/firebase-messaging.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
    apiKey: "AIzaSyCdt65Zu7D22YyrJSRRdhp3XON4u6xcw5U",
    authDomain: "suerteya-chat.firebaseapp.com",
    projectId: "suerteya-chat",
    storageBucket: "suerteya-chat.appspot.com",
    messagingSenderId: "649819214063",
    appId: "1:649819214063:web:8d7fecb2e4147c6ae5cb1a",
    measurementId: "G-72E516BGWW"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const analytics = getAnalytics(app);

  const messaging = getMessaging();
//   if ("serviceWorker" in navigator) {
// navigator.serviceWorker
//   .register("../firebase-messaging-sw.js")
//   .then(function(registration) {
//     console.log("Registration successful, scope is:", registration.scope);
//     getToken(messaging,{vapidKey: 'BPtp_CX_zBEmEVq2Oov2ilD9zRHkS9VN4-4slE0XdF6lxsvkp7iBMuRJGgA_uuVytLyjI6JagyhVlSxgIjZdqVE', serviceWorkerRegistration : registration })
//       .then((currentToken) => {
//         if (currentToken) {
//           console.log('current token for client: ', currentToken);

//           // Track the token -> client mapping, by sending to backend server
//           // show on the UI that permission is secured
//         } else {
//           console.log('No registration token available. Request permission to generate one.');

//           // shows on the UI that permission is required 
//         }
//       }).catch((err) => {
//         console.log('An error occurred while retrieving token. ', err);
//         // catch error while creating client token
//       });  
//     })
//     .catch(function(err) {
//       console.log("Service worker registration failed, error:"  , err );
//   }); 
// }

// Handle incoming messages. Called when:
// - a message is received while the app has focus
// - the user clicks on an app notification created by a service worker
//   `messaging.onBackgroundMessage` handler.


onMessage(messaging, (payload) => {
  console.log('Message received. ', payload);
  // ...
});
</script>