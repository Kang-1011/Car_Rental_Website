function setPickupDate() {
    var today = new Date();
    var h = today.getHours();
    var d = today.getDate();
    var m = today.getMonth() + 1;
    var y = today.getFullYear();

    if(d < 10) {
        d = '0' + d;
    }
    if(m < 10) {
        m = '0' + m;
    }
    if(h > 10) { // (last order for the day by 1100)
        d = d + 1;
    }

    var date = y + '-' + m + '-' + d;
    document.getElementById("pickup-date").min = date;
}
function setDropoffDate() {
    var pickupDate = document.getElementById("pickup-date").value;
    var nextDay = new Date(pickupDate);
    var d = nextDay.getDate() + 1;
    var m = nextDay.getMonth() + 1;
    var y = nextDay.getFullYear();

    if(d < 10) {
        d = '0' + d;
    }
    if(m < 10) {
        m = '0' + m;
    }

    var date = y + '-' + m + '-' + d;
    document.getElementById("dropoff-date").min = date;
}