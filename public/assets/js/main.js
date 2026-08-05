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

//===== Dark Mode Functions
function setDarkMode() {
    document.documentElement.classList.add('dark-mode');
    localStorage.setItem('theme', 'dark');
    updateThemeButtons();
}

function setLightMode() {
    document.documentElement.classList.remove('dark-mode');
    localStorage.setItem('theme', 'light');
    updateThemeButtons();
}

function updateThemeButtons() {
    const isDark = document.documentElement.classList.contains('dark-mode');
    const darkBtns = document.querySelectorAll('.dark-btn');
    const lightBtns = document.querySelectorAll('.light-btn');
    
    darkBtns.forEach(btn => {
        btn.style.border = isDark ? '2px solid #0167F3' : 'none';
    });
    
    lightBtns.forEach(btn => {
        btn.style.border = isDark ? 'none' : '2px solid #0167F3';
    });
}

// Initialize theme on page load
(function initTheme() {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        document.documentElement.classList.add('dark-mode');
    } else if (savedTheme === 'light') {
        document.documentElement.classList.remove('dark-mode');
    }
    // Update button styles after DOM is loaded
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', updateThemeButtons);
    } else {
        updateThemeButtons();
    }
})();