function gameIDpopup(uuID) {
let gameIDprompt = prompt("Enter your game join code");

var settings = {
    "url": "https://alpine.cx/game/api.php",
    "method": "POST",
    "timeout": 0,
    "headers": {
      "Content-Type": "application/x-www-form-urlencoded"
    },
    "data": {
      "action": "joingame",
      "uuID": uuID,
      "gameID": gameIDprompt
    }
  };
  console.log(settings);
  $.ajax(settings).done(function (response) {
    console.log(response);
  });

}
