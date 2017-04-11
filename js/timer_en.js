var timerID = null;
var timerRunning = false;
function stopclock ()
{
    if(timerRunning)
    clearTimeout(timerID);
    timerRunning = false;
}
function showtime () {
d = new Date();
dateText = "";
dayValue = d.getDay();
if(dayValue == 0)
    dateText += "Sunday";
else if (dayValue == 1)
    dateText += "Monday";
else if (dayValue == 2)
    dateText += "Tuesday";
else if (dayValue == 3)
    dateText += "Wednesday";
else if (dayValue == 4)
    dateText += "Thursday";
else if (dayValue == 5)
    dateText += "Friday";
else if (dayValue == 6)
    dateText += "Saturday";
// Get the current date; if it's before 2000,add 1900
dateText += ", Day " + d.getDate();
// lấy tháng hiện tại và chuyển nó sang tháng theo tiếng Việt Nam
monthValue = d.getMonth();
dateText += " ";
if (monthValue == 0)
    dateText += "January";
if (monthValue == 1)
    dateText += "February";
if (monthValue == 2)
    dateText += "March";
if (monthValue == 3)
    dateText += "April";
if (monthValue == 4)
    dateText += "May";
if (monthValue == 5)
    dateText += "June";
if (monthValue == 6)
    dateText += "July";
if (monthValue == 7)
    dateText += "August";
if (monthValue == 8)
    dateText += "September";
if (monthValue == 9)
    dateText += "October";
if (monthValue == 10)
    dateText += "November";
if (monthValue == 11)
    dateText += "December";
    
// Get the current year; if it's before 2000, add 1900
if (d.getYear() < 2000)
    dateText += " Year " + (1900 + d.getYear());
else
    dateText += " Year " + (d.getYear());

var now = new Date();
var hours = now.getHours();
var minutes = now.getMinutes();
var seconds = now.getSeconds()
var timeValue = "" + ((hours >12) ? hours -12 :hours)
if (timeValue == "0") timeValue = 12;
timeValue += ((minutes < 10) ? ":0" : ":") + minutes
timeValue += ((seconds < 10) ? ":0" : ":") + seconds
timeValue += (hours >= 12) ? " Afternoon " : " Morning "

objtime = document.getElementById("timmer");
objtime.innerHTML = timeValue + dateText;

timerID = setTimeout("showtime()",1000);
timerRunning = true;
}

function startclock() {
stopclock();
showtime();
}