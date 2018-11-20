<div class="clock-widget flex justify-center flex-col full-height">
    <div class="day text-centered"></div>
    <div class="time flex justify-center">
        <div class="hour"></div>:
        <div class="minute"></div>
    </div>
</div>


@section("javascript")
<script>
var $clock = $(".clock-widget");

function prefix(n) {
    return n < 10 ? "0" + n : n;
}
var date = new Date();
var days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
$clock.find(".day").text(days[date.getDay()]);
$clock.find(".hour").text(prefix(date.getHours() % 12));
$clock.find(".minute").text(prefix(date.getMinutes()));
setInterval(function () {
    var date = new Date();
    var days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    $clock.find(".day").text(days[date.getDay()]);
    $clock.find(".hour").text(prefix(date.getHours()));
    $clock.find(".minute").text(prefix(date.getMinutes()));
}, 1000)
</script>
@append