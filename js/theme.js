// Theme management
class ThemeManager {
    constructor() {
        this.theme = localStorage.getItem('theme') || 'dark';
        this.init();
    }

    init() {
        this.applyTheme();
        this.setupEventListeners();
    }

    applyTheme() {
        if (this.theme === 'light') {
            document.body.classList.add('light-theme');
            this.updateThemeButton('dark');
        } else {
            document.body.classList.remove('light-theme');
            this.updateThemeButton('light');
        }
    }

    toggleTheme() {
        this.theme = this.theme === 'dark' ? 'light' : 'dark';
        localStorage.setItem('theme', this.theme);
        
        // Add transition effect
        document.body.style.transition = 'all 0.5s ease';
        this.applyTheme();
        
        // Remove transition after animation
        setTimeout(() => {
            document.body.style.transition = '';
        }, 500);
    }

    updateThemeButton(nextTheme) {
        const themeToggle = document.getElementById('themeToggle');
        if (themeToggle) {
            const icon = themeToggle.querySelector('i');
            const text = nextTheme === 'light' ? 'Light Mode' : 'Dark Mode';
            const iconClass = nextTheme === 'light' ? 'fa-sun' : 'fa-moon';
            
            icon.className = `fas ${iconClass}`;
            themeToggle.innerHTML = `<i class="fas ${iconClass}"></i> ${text}`;
        }
    }

    setupEventListeners() {
        const themeToggle = document.getElementById('themeToggle');
        if (themeToggle) {
            themeToggle.addEventListener('click', () => {
                this.toggleTheme();
                
                // Add animation to button
                const icon = themeToggle.querySelector('i');
                icon.classList.add('fa-spin');
                setTimeout(() => icon.classList.remove('fa-spin'), 500);
            });
        }

        // Listen for system theme changes
        if (window.matchMedia) {
            const darkModeQuery = window.matchMedia('(prefers-color-scheme: dark)');
            darkModeQuery.addEventListener('change', (e) => {
                if (!localStorage.getItem('theme')) {
                    this.theme = e.matches ? 'dark' : 'light';
                    this.applyTheme();
                }
            });
        }
    }
}

// Initialize theme manager when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    const themeManager = new ThemeManager();
    
    // Add smooth theme transition on page load
    setTimeout(() => {
        document.body.style.transition = 'background 0.5s ease, color 0.5s ease';
    }, 100);
});

// Add particle effect on theme toggle
function createParticles(x, y) {
    const colors = ['#00d4ff', '#ff00ea', '#00ff88'];
    const particleCount = 15;
    
    for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.style.position = 'fixed';
        particle.style.left = x + 'px';
        particle.style.top = y + 'px';
        particle.style.width = '8px';
        particle.style.height = '8px';
        particle.style.borderRadius = '50%';
        particle.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
        particle.style.pointerEvents = 'none';
        particle.style.zIndex = '9999';
        particle.style.boxShadow = `0 0 10px ${particle.style.backgroundColor}`;
        
        document.body.appendChild(particle);
        
        const angle = (Math.PI * 2 * i) / particleCount;
        const velocity = 2 + Math.random() * 2;
        const vx = Math.cos(angle) * velocity;
        const vy = Math.sin(angle) * velocity;
        
        let posX = x;
        let posY = y;
        let opacity = 1;
        
        const animate = () => {
            posX += vx;
            posY += vy;
            opacity -= 0.02;
            
            particle.style.left = posX + 'px';
            particle.style.top = posY + 'px';
            particle.style.opacity = opacity;
            
            if (opacity > 0) {
                requestAnimationFrame(animate);
            } else {
                particle.remove();
            }
        };
        
        animate();
    }
}

// Add particle effect to theme toggle button
document.addEventListener('DOMContentLoaded', function() {
    const themeToggle = document.getElementById('themeToggle');
    if (themeToggle) {
        themeToggle.addEventListener('click', function(e) {
            const rect = this.getBoundingClientRect();
            const x = rect.left + rect.width / 2;
            const y = rect.top + rect.height / 2;
            createParticles(x, y);
        });
    }
});

// Save user preferences
class PreferenceManager {
    constructor() {
        this.preferences = this.load();
    }

    load() {
        const saved = localStorage.getItem('clockPreferences');
        return saved ? JSON.parse(saved) : {
            theme: 'dark',
            format24h: false,
            animations: true
        };
    }

    save() {
        localStorage.setItem('clockPreferences', JSON.stringify(this.preferences));
    }

    set(key, value) {
        this.preferences[key] = value;
        this.save();
    }

    get(key) {
        return this.preferences[key];
    }
}

// Initialize preference manager
const preferenceManager = new PreferenceManager();

// Export for use in other scripts
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { ThemeManager, PreferenceManager };
}
