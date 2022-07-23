document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll("[x-countdown]").forEach(element => {
    setInterval(() => {
      const timestamp = element.getAttribute("x-countdown-end");
      let end = Date.parse(timestamp);
      let secondsLeft = Math.floor((end - Date.now()) / 1000);
      element.textContent = remainingText(secondsLeft);
    }, 1000);
  });
});

function remainingText(secondsRemaining) {
  if (secondsRemaining <= 0) return "Jetzt";

  let seconds = Math.floor(secondsRemaining % 60);
  let minutes = Math.floor((secondsRemaining % (60 * 60)) / 60);
  let hours = Math.floor(secondsRemaining % (24 * 60 * 60) / (60 * 60));
  let days = Math.floor(secondsRemaining / (24 * 60 * 60));

  if (days > 0) // D, H
  {
    minutes += Math.round(seconds / 60); // Add a minute if the seconds almost give a minute
    hours += Math.round(minutes / 60); // Add an hour if the minutes almost gives an hour

    if (days < 2) {
      // setMinimumTimerInterval(60 * minutes);
      return "1d " + hours + "h";
    } else {
      // setMinimumTimerInterval(60 * 60 * hours);
      return days + "d";
    }
  } else if (hours > 0) // H, M
  {
    minutes += Math.round(seconds / 60); // Add a minute if the seconds almost give a minute)

    if (hours < 4) {
      // setMinimumTimerInterval(seconds);
      return hours + "h " + minutes + "m";
    } else {
      // setMinimumTimerInterval(minutes * 60);

      hours += Math.round(minutes / 60); // Add an hour if the minutes almost gives an hour

      return hours + "h";
    }
  } else // M, S
  {
    if (minutes >= 5) {
      // setMinimumTimerInterval(seconds);
      return minutes + " m";
    } else {
      // setMinimumTimerInterval(1);

      if (minutes > 0)
        return minutes + "m " + seconds + "s";
      else
        return seconds + "s";
    }
  }
}