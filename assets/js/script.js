function updateTime() {
    const currentTimeElement = document.getElementById('current-time');
    const now = new Date();
    const formattedTime = now.toLocaleString('en-US', { 
        year: 'numeric', 
        month: 'short', 
        day: 'numeric', 
        hour: '2-digit', 
        minute: '2-digit', 
        second: '2-digit' 
    });
    currentTimeElement.textContent = formattedTime;
}

setInterval(updateTime, 1000);
updateTime();  // initial call to display time immediately