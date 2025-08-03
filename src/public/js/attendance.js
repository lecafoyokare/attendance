function updateDateTime() {
            const now = new Date();
            const year = now.getFullYear();
            const month = now.getMonth() + 1;
            const day = now.getDate();
            const weekdays = ['日', '月', '火', '水', '木', '金', '土'];
            const weekdayAbbr = weekdays[now.getDay()];
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');

            const dateString = `${year}年${month}月${day}日(${weekdayAbbr})`;
            const timeString = `${hours}:${minutes}`;

            const dateEl = document.getElementById('today');
            dateEl.textContent = dateString;
            dateEl.setAttribute('datetime', now.toISOString().slice(0, 10));

            const timeEl = document.getElementById('current_time');
            timeEl.textContent = timeString;
            timeEl.setAttribute('datetime', now.toISOString().slice(11, 16));
        }

        document.addEventListener('DOMContentLoaded', () => {
            updateDateTime();
            setInterval(updateDateTime, 1000);
        });