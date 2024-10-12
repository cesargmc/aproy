document.addEventListener('DOMContentLoaded', function() {
    navegacionFija();
    resaltarEnlace();
    scrollNav();
    slide();
    menu();
    agregarActividad();
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

    navLinks.forEach(link => {
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

function agregarActividad() {
    // Crear un nuevo div para la nueva actividad
    var nuevaActividad = document.createElement("div");
    nuevaActividad.classList.add("actividad-item");

    // Crear el input para el nombre de la actividad
    var inputNombre = document.createElement("input");
    inputNombre.type = "text";
    inputNombre.name = "actividad_nombre[]";
    inputNombre.placeholder = "Ej: Callejonada";
    inputNombre.required = true;

    // Crear el input para el precio de la actividad
    var inputPrecio = document.createElement("input");
    inputPrecio.type = "number";
    inputPrecio.name = "actividad_precio[]";
    inputPrecio.placeholder = "Precio ($)";
    inputPrecio.required = true;

    // Añadir los inputs al div de la nueva actividad
    nuevaActividad.appendChild(inputNombre);
    nuevaActividad.appendChild(inputPrecio);

    // Añadir el nuevo div al contenedor de actividades
    document.getElementById("actividades-container").appendChild(nuevaActividad);
}