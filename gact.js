 function getAccessToken() {
  return new Promise(function(resolve, reject) {
    const key = require('./apiyt-332805-firebase-adminsdk-fbsvc-64640dd95b.json');
    const jwtClient = new google.auth.JWT(
      key.client_email,
      null,
      key.private_key,
      SCOPES,
      null
    );
    jwtClient.authorize(function(err, tokens) {
      if (err) {
        reject(err);
        return;
      }
      resolve(tokens.access_token);
    });
  });
}

console.log(getAccessToken());
