window.onload = function() {
    let menuItems = document.querySelectorAll('.menu-item');
    menuItems.forEach((item, index) => {
        item.style.transitionDelay = `${index * 0.1}s`;
        item.classList.add('fade-in');
    });
};

document.querySelector('.menu-navigation').addEventListener('click', function(e) {
    if (e.target.tagName === 'A') {
        document.querySelectorAll('.menu-item').forEach(item => item.classList.remove('fade-in'));
    }
});
