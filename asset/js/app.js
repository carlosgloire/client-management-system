const image = document.querySelector('.image-box img');

image.addEventListener('mouseenter', () => {
    image.style.animation = 'none';
});

image.addEventListener('mousemove', (e) => {
    const box = image.getBoundingClientRect();
    const centerX = box.left + box.width / 2;
    const centerY = box.top + box.height / 2;
    const rotateX = (centerY - e.clientY) / 10;
    const rotateY = (e.clientX - centerX) / 10;
    image.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
});

image.addEventListener('mouseleave', () => {
    image.style.transform = 'rotate(0deg)';
    image.style.animation = 'upAndDown 2s infinite';
});


/*----------------------------------
#Menu deroulant
----------------------------------*/

document.addEventListener('DOMContentLoaded', () => {
    const list = document.querySelector('.header-content');
    const exit = document.querySelector('.exit');
    const menuIcon = document.querySelector('.menu');
    const overlay = document.querySelector('.overlay');

    if (menuIcon) {
        menuIcon.addEventListener('click', () => {
            list.classList.add('active');
            overlay.classList.add('active');
            menuIcon.style.display = 'none';
            exit.style.display = 'inline-block';
        });
    }

    if (exit) {
        exit.addEventListener('click', () => {
            list.classList.remove('active');
            overlay.classList.remove('active');
            exit.style.display = 'none';
            menuIcon.style.display = 'inline-block';
        });
    }
});