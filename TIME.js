function displayClock() {
    var now = new Date();
    var hours = now.getHours();
    var minutes = now.getMinutes();
    var seconds = now.getSeconds();
    str = " AM";
    acthours = 0;
    if (hours >= 12 && hours <= 23) {
        if (hours != 12)
            acthours = -12;
        acthours += hours;
        str = " PM"
    }
    else if (hours == 0) 
        acthours = 12;
    else    
        acthours = hours;
    
    if (minutes < 10) minutes = "0" + minutes;
    var time = acthours + ':' + minutes + str; 
    document.getElementById('clock').innerHTML = time;
  }
  
  setInterval(displayClock, 1000);