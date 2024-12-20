document.addEventListener('DOMContentLoaded', function() {
    const hamburgerInput = document.querySelector('.hamburger input');
    const navUl = document.querySelector('nav ul');

    hamburgerInput.addEventListener('change', function() {
        if (this.checked) {
            navUl.style.transform = 'translateY(0)';
            navUl.style.visibility = 'visible';
            navUl.style.opacity = '1'
        } else {
            navUl.style.transform = 'translateY(-100%)';
            navUl.style.visibility = 'hidden';
            navUl.style.opacity = '0'
        }
    });
});

function openWhatsApp() {
    window.open('https://wa.me/628172320099', '_blank');
}

function openWhatsApp2() {
    window.open('https://wa.me/6281288172775', '_blank');
}

function sendEmail() {
    window.location.href = 'mailto:dvsaudit@gmail.com';
}


document.querySelectorAll('nav li a').forEach((link) => {
    link.addEventListener('mouseenter', () => {
        link.querySelector('.nav-label').classList.add('show');
    });

    link.addEventListener('mouseleave', () => {
        link.querySelector('.nav-label').classList.remove('show');
    });
});