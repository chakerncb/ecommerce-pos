/*
Template Name: ShopGrids - Bootstrap 5 eCommerce HTML Template.
Author: GrayGrids
*/

(function () {
    //===== Prealoder

    window.onload = function () {
        window.setTimeout(fadeout, 500);
    }

    function fadeout() {
        document.querySelector('.preloader').style.opacity = '0';
        document.querySelector('.preloader').style.display = 'none';
    }


    
    
    /*=====================================
    Sticky
    ======================================= */
    window.onscroll = function () {
        var header_navbar = document.querySelector(".navbar-area");
        var sticky = header_navbar.offsetTop;

        // show or hide the back-top-top button
        var backToTo = document.querySelector(".scroll-top");
        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
            backToTo.style.display = "flex";
        } else {
            backToTo.style.display = "none";
        }
    };


    
    //===== mobile-menu-btn
    let navbarToggler = document.querySelector(".mobile-menu-btn");
    navbarToggler.addEventListener('click', function () {
        navbarToggler.classList.toggle("active");
    });

})();

//===== Dark Mode Functions (Apple Standard)
function updateThemeIcon() {
    const isDark = document.documentElement.classList.contains('dark-mode');
    const icon = document.getElementById('theme-toggle-icon');
    const btn = document.getElementById('theme-toggle-btn');
    
    if (icon) {
        if (isDark) {
            icon.className = 'bi bi-sun-fill';
            if (btn) {
                btn.setAttribute('title', 'Switch to Light Mode');
                btn.setAttribute('aria-label', 'Switch to Light Mode');
            }
        } else {
            icon.className = 'bi bi-moon-stars-fill';
            if (btn) {
                btn.setAttribute('title', 'Switch to Dark Mode');
                btn.setAttribute('aria-label', 'Switch to Dark Mode');
            }
        }
    }

    const darkBtns = document.querySelectorAll('.dark-btn');
    const lightBtns = document.querySelectorAll('.light-btn');
    darkBtns.forEach(b => b.style.border = isDark ? '2px solid #fe8517' : 'none');
    lightBtns.forEach(b => b.style.border = isDark ? 'none' : '2px solid #fe8517');
}

function setDarkMode() {
    document.documentElement.classList.add('dark-mode');
    localStorage.setItem('theme', 'dark');
    updateThemeIcon();
}

function setLightMode() {
    document.documentElement.classList.remove('dark-mode');
    localStorage.setItem('theme', 'light');
    updateThemeIcon();
}

function toggleTheme() {
    if (document.documentElement.classList.contains('dark-mode')) {
        setLightMode();
    } else {
        setDarkMode();
    }
}

// Initialize theme on page load
(function initTheme() {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark' || (!savedTheme && window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark-mode');
    } else if (savedTheme === 'light') {
        document.documentElement.classList.remove('dark-mode');
    }
    
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', updateThemeIcon);
    } else {
        updateThemeIcon();
    }
})();