import './bootstrap';
import 'bootstrap';

// === SIDEBAR TOGGLE ===
document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('sidebarToggle');
    const mobileToggle = document.getElementById('sidebarMobileToggle');
    const overlay = document.getElementById('sidebarOverlay');

    if (toggleBtn) {
        toggleBtn.addEventListener('click', function () {
            sidebar.classList.toggle('collapsed');
            const icon = this.querySelector('i');
            if (icon) {
                icon.classList.toggle('bi-chevron-left');
                icon.classList.toggle('bi-chevron-right');
            }
        });
    }

    if (mobileToggle) {
        mobileToggle.addEventListener('click', function () {
            sidebar.classList.toggle('mobile-open');
            overlay.classList.toggle('show');
        });
    }

    if (overlay) {
        overlay.addEventListener('click', function () {
            sidebar.classList.remove('mobile-open');
            overlay.classList.remove('show');
        });
    }

    // === SUBMENU TOGGLE ===
    document.querySelectorAll('.submenu-toggle').forEach(function (toggle) {
        toggle.addEventListener('click', function (e) {
            e.preventDefault();
            const parent = this.closest('.nav-item');
            const submenu = parent.querySelector('.submenu');
            if (submenu) {
                submenu.classList.toggle('open');
                this.classList.toggle('open');
            }
        });
    });

    // Auto-open submenu if child is active
    document.querySelectorAll('.submenu .nav-link.active').forEach(function (link) {
        const submenu = link.closest('.submenu');
        const toggle = submenu.closest('.nav-item').querySelector('.submenu-toggle');
        if (submenu && toggle) {
            submenu.classList.add('open');
            toggle.classList.add('open');
        }
    });

    // === SMOOTH SCROLL ===
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                const offset = 80;
                const pos = target.getBoundingClientRect().top + window.pageYOffset - offset;
                window.scrollTo({ top: pos, behavior: 'smooth' });
            }
        });
    });

    // === INTERSECTION OBSERVER FOR ANIMATIONS ===
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver(
            function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            },
            { threshold: 0.1 }
        );

        document.querySelectorAll('.animate-on-scroll').forEach(function (el) {
            observer.observe(el);
        });
    } else {
        document.querySelectorAll('.animate-on-scroll').forEach(function (el) {
            el.classList.add('visible');
        });
    }

    // === NAVBAR SCROLL EFFECT ===
    const landingNav = document.querySelector('.landing-navbar');
    if (landingNav) {
        window.addEventListener('scroll', function () {
            if (window.scrollY > 50) {
                landingNav.style.padding = '0.5rem 0';
                landingNav.style.boxShadow = '0 2px 30px rgba(27, 67, 50, 0.4)';
            } else {
                landingNav.style.padding = '0.75rem 0';
                landingNav.style.boxShadow = '0 2px 20px rgba(27, 67, 50, 0.3)';
            }
        });
    }
});
