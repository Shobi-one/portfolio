AOS.init({
    duration: 1000,
    once: true,
    easing: 'ease-out-cubic'
});

// Page load animation
window.addEventListener('load', () => {
    document.querySelector('.page-load-animation').style.opacity = '0';
    setTimeout(() => {
        document.querySelector('.page-load-animation').remove();
    }, 1000);
});

// Theme toggle
const themeToggle = document.getElementById('theme-toggle');
const themeIcon = document.getElementById('theme-icon');
const storedTheme = localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');

function updateThemeIcon(theme) {
    // Get the current page path to determine the correct relative path
    const currentPath = window.location.pathname;
    const isInSubdirectory = currentPath.split('/').length > 2;
    const basePath = isInSubdirectory ? '../' : './';
    
    themeIcon.src = theme === 'dark' ? `${basePath}assets/img/decor/sunIcon.png` : `${basePath}assets/img/decor/moonIcon.png`;
}

if (storedTheme) {
    document.documentElement.setAttribute('data-theme', storedTheme);
    updateThemeIcon(storedTheme);
}

themeToggle.addEventListener('click', () => {
    const currentTheme = document.documentElement.getAttribute('data-theme');
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

    document.documentElement.setAttribute('data-theme', newTheme);
    localStorage.setItem('theme', newTheme);
    updateThemeIcon(newTheme);
});

// Hamburger menu toggle with body class
const hamburgerIcon = document.getElementById('hamburger-icon');
const menuItems = document.getElementById('menu-items');

hamburgerIcon.addEventListener('click', () => {
    hamburgerIcon.classList.toggle('open');
    menuItems.classList.toggle('menu-closed');
    document.body.classList.toggle('menu-open');
});

// Close menu when clicking outside of it
document.addEventListener('click', (event) => {
    if (!hamburgerIcon.contains(event.target) && !menuItems.contains(event.target)) {
        hamburgerIcon.classList.remove('open');
        menuItems.classList.add('menu-closed');
        document.body.classList.remove('menu-open');
    }
});

// Close menu when a navigation link is clicked
const navLinks = menuItems.querySelectorAll('a');
navLinks.forEach(link => {
    link.addEventListener('click', () => {
        hamburgerIcon.classList.remove('open');
        menuItems.classList.add('menu-closed');
        document.body.classList.remove('menu-open');
    });
});