// Clock functionality
class DigitalClock {
    constructor() {
        this.is24Hour = false;
        this.init();
    }

    init() {
        this.updateClock();
        setInterval(() => this.updateClock(), 1000);
    }

    updateClock() {
        const now = new Date();
        
        // Update time
        let hours = now.getHours();
        const minutes = now.getMinutes();
        const seconds = now.getSeconds();
        
        // Determine AM/PM
        const period = hours >= 12 ? 'PM' : 'AM';
        
        // Convert to 12-hour format if needed
        if (!this.is24Hour) {
            hours = hours % 12;
            hours = hours ? hours : 12; // 0 should be 12
        }
        
        // Update DOM elements
        document.getElementById('hours').textContent = this.padZero(hours);
        document.getElementById('minutes').textContent = this.padZero(minutes);
        document.getElementById('seconds').textContent = this.padZero(seconds);
        
        // Update period (AM/PM)
        const periodBadge = document.querySelector('.period-badge');
        if (this.is24Hour) {
            periodBadge.textContent = '24H';
        } else {
            periodBadge.textContent = period;
        }
        
        // Update date
        this.updateDate(now);
        
        // Update additional info
        this.updateAdditionalInfo(now);
    }

    updateDate(date) {
        const days = ['일요일', '월요일', '화요일', '수요일', '목요일', '금요일', '토요일'];
        const months = ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'];
        
        const dayOfWeek = days[date.getDay()];
        const month = months[date.getMonth()];
        const day = date.getDate();
        const year = date.getFullYear();
        
        document.getElementById('dayOfWeek').textContent = dayOfWeek;
        document.getElementById('fullDate').textContent = ` ${year}년 ${month} ${day}일`;
    }

    updateAdditionalInfo(date) {
        // Day of year
        const start = new Date(date.getFullYear(), 0, 0);
        const diff = date - start;
        const oneDay = 1000 * 60 * 60 * 24;
        const dayOfYear = Math.floor(diff / oneDay);
        document.getElementById('dayOfYear').textContent = dayOfYear;
        
        // Week of year
        const oneJan = new Date(date.getFullYear(), 0, 1);
        const numberOfDays = Math.floor((date - oneJan) / oneDay);
        const weekOfYear = Math.ceil((date.getDay() + 1 + numberOfDays) / 7);
        document.getElementById('weekOfYear').textContent = weekOfYear;
        
        // Timezone
        const offset = -date.getTimezoneOffset() / 60;
        const sign = offset >= 0 ? '+' : '-';
        document.getElementById('timezone').textContent = `UTC${sign}${Math.abs(offset)}`;
    }

    padZero(num) {
        return num < 10 ? '0' + num : num.toString();
    }

    toggle24Hour() {
        this.is24Hour = !this.is24Hour;
        this.updateClock();
    }
}

// Initialize clock when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    const clock = new DigitalClock();
    
    // Format toggle button
    const formatToggle = document.getElementById('formatToggle');
    if (formatToggle) {
        formatToggle.addEventListener('click', function() {
            clock.toggle24Hour();
            const icon = this.querySelector('i');
            icon.classList.add('fa-spin');
            setTimeout(() => icon.classList.remove('fa-spin'), 500);
        });
    }
});

// Add smooth scroll behavior
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Add parallax effect to background
let ticking = false;

function updateBackgroundPosition(scrollPos) {
    document.body.style.backgroundPositionY = scrollPos * 0.5 + 'px';
}

window.addEventListener('scroll', function() {
    const scrollPos = window.scrollY;
    
    if (!ticking) {
        window.requestAnimationFrame(function() {
            updateBackgroundPosition(scrollPos);
            ticking = false;
        });
        ticking = true;
    }
});

// Add keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Press 'T' to toggle theme
    if (e.key === 't' || e.key === 'T') {
        document.getElementById('themeToggle').click();
    }
    
    // Press 'F' to toggle format
    if (e.key === 'f' || e.key === 'F') {
        document.getElementById('formatToggle').click();
    }
});

// Add visibility change handling
document.addEventListener('visibilitychange', function() {
    if (document.hidden) {
        console.log('Clock paused - tab is hidden');
    } else {
        console.log('Clock resumed - tab is visible');
    }
});

// Performance optimization: Reduce animations when battery is low
if ('getBattery' in navigator) {
    navigator.getBattery().then(function(battery) {
        function updateBatteryStatus() {
            if (battery.level < 0.2 && !battery.charging) {
                document.body.classList.add('low-battery-mode');
                console.log('Low battery mode activated');
            } else {
                document.body.classList.remove('low-battery-mode');
            }
        }
        
        battery.addEventListener('levelchange', updateBatteryStatus);
        battery.addEventListener('chargingchange', updateBatteryStatus);
        updateBatteryStatus();
    });
}

// Add network status indicator
function updateOnlineStatus() {
    const status = navigator.onLine ? 'online' : 'offline';
    console.log(`Network status: ${status}`);
    
    if (!navigator.onLine) {
        // Could show a notification here
        console.warn('You are currently offline');
    }
}

window.addEventListener('online', updateOnlineStatus);
window.addEventListener('offline', updateOnlineStatus);

// Wake lock API to keep screen on (if supported)
let wakeLock = null;

async function requestWakeLock() {
    try {
        if ('wakeLock' in navigator) {
            wakeLock = await navigator.wakeLock.request('screen');
            console.log('Wake Lock activated');
            
            wakeLock.addEventListener('release', () => {
                console.log('Wake Lock released');
            });
        }
    } catch (err) {
        console.log(`${err.name}, ${err.message}`);
    }
}

// Request wake lock when page becomes visible
document.addEventListener('visibilitychange', async () => {
    if (wakeLock !== null && document.visibilityState === 'visible') {
        await requestWakeLock();
    }
});

// Optional: Auto-request wake lock on load
// requestWakeLock();
