$(document).ready(function () {
    $('#year_month_start').datepicker({
        format: 'yyyy/mm',
        language: 'ja',
        autoclose: true,
        minViewMode: 'months'
    });
});

$(document).ready(function () {
    $('#year_month_start').datepicker({
        format: 'yyyy/mm',
        language: 'ja',
        autoclose: true,
        minViewMode: 'months'
    }).on('changeDate', function (e) {
        const selectedDate = e.date;
        const selectedYear = selectedDate.getFullYear();
        const selectedMonth = selectedDate.getMonth() + 1;

        const url = `/attendance/list/${selectedYear}/${selectedMonth}`;

        window.location.href = url;
    });
});

$('#calendar_icon').on('click', function () {
    $('#year_month_start').datepicker('show');
});