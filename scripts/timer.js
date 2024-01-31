function updateClock(){
    // get the current time
    const currentTime = new Date();

    // format the time as HH:mm:ss
    const hours = currentTime.getHours().toString().padStart(2, '0');
    const minutes = currentTime.getMinutes().toString().padStart(2, '0');
    const seconds = currentTime.getSeconds().toString().padStart(2, '0');

    // update the clock element
    const clockElement = document.getElementById('time');
    clockElement.textContent = `${hours}:${minutes}:${seconds}`;
};

// update the clock every second
setInterval(updateClock, 1000);

// initial call to set the inital time
updateClock();