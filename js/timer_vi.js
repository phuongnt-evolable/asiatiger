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
    dateText += "Chủ Nhật";
else if (dayValue == 1)
    dateText += "Thứ hai";
else if (dayValue == 2)
    dateText += "Thứ Ba";
else if (dayValue == 3)
    dateText += "Thứ Tư";
else if (dayValue == 4)
    dateText += "Thứ Năm";
else if (dayValue == 5)
    dateText += "Thứ Sáu";
else if (dayValue == 6)
    dateText += "Thứ Bảy";
// Get the current date; if it's before 2000,add 1900
dateText += ", Ngày " + d.getDate();
// lấy tháng hiện tại và chuyển nó sang tháng theo tiếng Việt Nam
monthValue = d.getMonth();
dateText += " ";
if (monthValue == 0)
    dateText += "Tháng 1";
if (monthValue == 1)
    dateText += "Tháng 2";
if (monthValue == 2)
    dateText += "Tháng 3";
if (monthValue == 3)
    dateText += "Tháng 4";
if (monthValue == 4)
    dateText += "Tháng 5";
if (monthValue == 5)
    dateText += "Tháng 6";
if (monthValue == 6)
    dateText += "Tháng 7";
if (monthValue == 7)
    dateText += "Tháng 8";
if (monthValue == 8)
    dateText += "Tháng 9";
if (monthValue == 9)
    dateText += "Tháng 10";
if (monthValue == 10)
    dateText += "Tháng 11";
if (monthValue == 11)
    dateText += "Tháng 12";
    
// Get the current year; if it's before 2000, add 1900
if (d.getYear() < 2000)
    dateText += " năm " + (1900 + d.getYear());
else
    dateText += " năm " + (d.getYear());

var now = new Date();
var hours = now.getHours();
var minutes = now.getMinutes();
var seconds = now.getSeconds()
var timeValue = "" + ((hours >12) ? hours -12 :hours)
if (timeValue == "0") timeValue = 12;
timeValue += ((minutes < 10) ? ":0" : ":") + minutes
timeValue += ((seconds < 10) ? ":0" : ":") + seconds
timeValue += (hours >= 12) ? " Chiều " : " Sáng "

objtime = document.getElementById("timmer");
objtime.innerHTML = timeValue + dateText;

timerID = setTimeout("showtime()",1000);
timerRunning = true;
}

function startclock() {
stopclock();
showtime();
}