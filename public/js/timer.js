function timer() {
    var countDownDate = new Date();
    var seconds = parseInt(document.getElementById('timerDate').value || -1);
    countDownDate = countDownDate.setSeconds(countDownDate.getSeconds() +
        seconds);

    // Update the count down every 1 second
    countdownfunction = setInterval(function () {
        var now = new Date().getTime();
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (
            1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Output the result in an element with id="demo"
        document.getElementById("timer").innerHTML = minutes +
            "m " + seconds + "s ";
        // If the count down is over, write some text 
        if (distance < 0) {
            clearInterval(countdownfunction);

            document.getElementById("timer").innerHTML = "0m 0s";
            document.getElementById("timer").style.color = 'red';
        }
        else {
            document.getElementById("timer").style.color = 'green';
        }
    }, 1000);
}