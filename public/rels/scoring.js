function incRound(gameID) {
    var settings = {
        "url": "https://alpine.cx/game/api.php",
        "method": "POST",
        "timeout": 0,
        "headers": {
          "Content-Type": "application/x-www-form-urlencoded",
          
        },
        "data": {
          "action": "incRound",
          "gameID": gameID
        }
      };
      
      $.ajax(settings).done(function (response) {
        if (response == "success") {
            window.alert("Moving to next round!");;
          }
      });
}

function saveScore($gameID,$teamID, $score, $round) {
    var settings = {
        "url": "https://alpine.cx/game/api.php",
        "method": "POST",
        "timeout": 0,
        "headers": {
          "Content-Type": "application/x-www-form-urlencoded",
          
        },
        "data": {
          "action": "saveScore",
          "gameID": gameID,
          "teamID": teamID,
          "round": round,
          "score": score
        }
      };
      
      $.ajax(settings).done(function (response) {
        if (response == "success") {
            window.alert("Score Saved!");;
          }
      });
}