document.addEventListener('DOMContentLoaded', function() {
    navegacionFija();
    resaltarEnlace();
    scrollNav();
    slide();
    menu();
})

function navegacionFija() {
    const header = document.querySelector('.header')
    const sobreFestival = document.querySelector('.p1')

    window.addEventListener('scroll', function() {
        if(sobreFestival.getBoundingClientRect().bottom < 1) {
            header.classList.add('fixed');
        } else {
            header.classList.remove('fixed');
        }
    })
}

function resaltarEnlace() {
    document.addEventListener('scroll', function() {
        const sections = document.querySelectorAll('section');
        const navLinks = document.querySelectorAll('.navegacion a');

        let actual = '';

        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            if(window.scrollY >= (sectionTop - sectionHeight / 3)) {
                actual = section.id
            }
        })

        navLinks.forEach(link => {
            link.classList.remove('active');
            if(link.getAttribute('href') === '#' + actual) {
                link.classList.add('active');
            }
        })
    })
}

function scrollNav() {
    const navLinks = document.querySelectorAll('.navegacion .navegacion__enlace');

    navLinks.forEach( link => {
        link.addEventListener('click', evento => {
            evento.preventDefault();
            const sectionScroll = evento.target.getAttribute('href');
            const section = document.querySelector(sectionScroll);
            
            section.scrollIntoView({behavior: 'smooth'});
        })
    })
}

function slide() {
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        grabCursor: true,
        spaceBetween: 30,
        loop: true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
    });
}

function toggleMenu() {
    document.body.classList.toggle('open');
}

function closeMenu() {
    document.body.classList.remove('open');
}

function menu() {
    const menuButton = document.querySelector('.menu');
    const overlay = document.querySelector('.overlay');

    menuButton.addEventListener('click', toggleMenu);

    overlay.addEventListener('click', closeMenu);
}
