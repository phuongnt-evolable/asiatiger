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
    dateText += "星期日";
else if (dayValue == 1)
    dateText += "星期一";
else if (dayValue == 2)
    dateText += "星期二";
else if (dayValue == 3)
    dateText += "星期三";
else if (dayValue == 4)
    dateText += "星期四";
else if (dayValue == 5)
    dateText += "星期五";
else if (dayValue == 6)
    dateText += "星期六";
// Get the current date; if it's before 2000,add 1900

if (d.getYear() < 2000)
    dateText += " , " + (1900 + d.getYear() + "  年 "  );
else
    dateText += " , " + (d.getYear() + " 年 " );

monthValue = d.getMonth();
dateText += " ";
if (monthValue == 0)
    dateText += "1 月 ";
if (monthValue == 1)
    dateText += "2 月 ";
if (monthValue == 2)
    dateText += "3 月 ";
if (monthValue == 3)
    dateText += "4 月 ";
if (monthValue == 4)
    dateText += "5 月 ";
if (monthValue == 5)
    dateText += "6 月 ";
if (monthValue == 6)
    dateText += "7 月 ";
if (monthValue == 7)
    dateText += "8 月 ";
if (monthValue == 8)
    dateText += "9 月 ";
if (monthValue == 9)
    dateText += "10 月 ";
if (monthValue == 10)
    dateText += "11 月 ";
if (monthValue == 11)
    dateText += "12 月 ";

dateText +=  d.getDate()+" 日 " ;
// lấy tháng hiện tại và chuyển nó sang tháng theo tiếng Việt Nam

    
// Get the current year; if it's before 2000, add 1900


var now = new Date();
var hours = now.getHours();
var minutes = now.getMinutes();
var seconds = now.getSeconds()
var timeValue = "" + ((hours >12) ? hours -12 :hours)
if (timeValue == "0") timeValue = 12;
timeValue += ((minutes < 10) ? ":0" : ":") + minutes
timeValue += ((seconds < 10) ? ":0" : ":") + seconds
timeValue += (hours >= 12) ? " 下午 " : " 上午 "

objtime = document.getElementById("timmer");
objtime.innerHTML = timeValue + dateText;

timerID = setTimeout("showtime()",1000);
timerRunning = true;
}


function startclock() {
stopclock();
showtime();
}