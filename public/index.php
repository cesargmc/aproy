<?php
    require '../includes/funciones.php';
    incluirTemplate('header', $inicio = true);
?>

    <main class="contenedor">
        <section id="servicios" class="servicio texto-centrado">
            <h2>Mis Servicios</h2>

            <p class="servicios__texto">
                Ofrecemos servicio de transporte de ida y vuelta, con una coordinadora que se encargará de los paseos y traslados durante todo el viaje. Disfruta de snacks mientras te desplazas, y al final del recorrido, participa en una rifa especial para nuestros viajeros.
            </p>

            <div class="servicios">
                <div class="servicios__contenido">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bed" width="60" height="60" viewBox="0 0 24 24" stroke-width="1.5" stroke="#6d9773" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M3 7v11m0 -4h18m0 4v-8a2 2 0 0 0 -2 -2h-8v6" />
                        <path d="M7 10m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                    </svg>
    
                    <h3>Hospedaje</h3>
                    <p>Disfruta de una estancia sin preocupaciones en nuestros hoteles seleccionados. Todo lo que necesitas hacer es llegar, y nosotros nos encargaremos del resto.</p>
                </div><!-- servicios__contenido -->

                <div class="border"></div>

                <div class="servicios__contenido">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bus" width="60" height="60" viewBox="0 0 24 24" stroke-width="1.5" stroke="#6d9773" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M6 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M18 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M4 17h-2v-11a1 1 0 0 1 1 -1h14a5 7 0 0 1 5 7v5h-2m-4 0h-8" />
                        <path d="M16 5l1.5 7l4.5 0" />
                        <path d="M2 10l15 0" />
                        <path d="M7 5l0 5" />
                        <path d="M12 5l0 5" />
                    </svg>
    
                    <h3>Transporte</h3>
                    <p>Viaja cómodamente en nuestros autobuses climatizados, que ofrecen un recorrido redondo con todas las comodidades baños a bordo y paradas programadas para estirar las piernas y disfrutar de un refrigerio.</p>
                </div><!-- servicios__contenido -->

                <div class="border"></div>

                <div class="servicios__contenido">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shield-lock" width="60" height="60" viewBox="0 0 24 24" stroke-width="1.5" stroke="#6d9773" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3" />
                        <path d="M12 11m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                        <path d="M12 12l0 2.5" />
                    </svg>
    
                    <h3>Seguro de Viaje</h3>
                    <p>Tu seguridad es nuestra prioridad. Por eso, todos nuestros viajeros cuentan con un seguro de viaje mientras están a bordo de nuestras unidades, para que disfrutes del viaje con total tranquilidad.</p>
                </div><!-- servicios__contenido -->
            </div>
        </section><!-- SERVICIO -->

        <section id="viajes" class="catalogo">
            <h2 class="texto-centrado">Próximos Viajes</h2>

            <?php 
                include '../includes/templates/anuncios.php'
            ?>
        </section><!-- VIAJES -->

        <section id="reseñas" class="resenas">
            <h2 class="texto-centrado">Reseñas</h2>

            <div class="contenedor-resena">
                <div class="resena mySwiper">
                    <div class="resena-contenido swiper-wrapper">
                        <div class="slide swiper-slide">
                            <img src="build/img/user.png" alt="Imagen de usuario predeterminada">

                            <p>3 de 3 viajes y cada vez se pone mejor esperando el próximo viaje</p>

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="30" height="30" fill="rgba(109,151,115,1)"><path d="M4.58341 17.3211C3.55316 16.2274 3 15 3 13.0103C3 9.51086 5.45651 6.37366 9.03059 4.82318L9.92328 6.20079C6.58804 8.00539 5.93618 10.346 5.67564 11.822C6.21263 11.5443 6.91558 11.4466 7.60471 11.5105C9.40908 11.6778 10.8312 13.159 10.8312 15C10.8312 16.933 9.26416 18.5 7.33116 18.5C6.2581 18.5 5.23196 18.0095 4.58341 17.3211ZM14.5834 17.3211C13.5532 16.2274 13 15 13 13.0103C13 9.51086 15.4565 6.37366 19.0306 4.82318L19.9233 6.20079C16.588 8.00539 15.9362 10.346 15.6756 11.822C16.2126 11.5443 16.9156 11.4466 17.6047 11.5105C19.4091 11.6778 20.8312 13.159 20.8312 15C20.8312 16.933 19.2642 18.5 17.3312 18.5C16.2581 18.5 15.232 18.0095 14.5834 17.3211Z"></path></svg>

                            <div class="informacion">
                                <a href="https://www.facebook.com/share/p/zoX2DyKjZ4UH5gao/" target="_blank">
                                    <span class="nombre">Martha Garza Sepulveda</span>
                                    <span class="experiencia">Guadalajara, Jalisco</span>
                                </a>
                            </div>
                        </div>

                        <div class="slide swiper-slide">
                            <img src="build/img/user.png" alt="Imagen de usuario predeterminada">

                            <p>Muy Recomendada, Excelente Coordinadora y Servicio👌</p>

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="30" height="30" fill="rgba(109,151,115,1)"><path d="M4.58341 17.3211C3.55316 16.2274 3 15 3 13.0103C3 9.51086 5.45651 6.37366 9.03059 4.82318L9.92328 6.20079C6.58804 8.00539 5.93618 10.346 5.67564 11.822C6.21263 11.5443 6.91558 11.4466 7.60471 11.5105C9.40908 11.6778 10.8312 13.159 10.8312 15C10.8312 16.933 9.26416 18.5 7.33116 18.5C6.2581 18.5 5.23196 18.0095 4.58341 17.3211ZM14.5834 17.3211C13.5532 16.2274 13 15 13 13.0103C13 9.51086 15.4565 6.37366 19.0306 4.82318L19.9233 6.20079C16.588 8.00539 15.9362 10.346 15.6756 11.822C16.2126 11.5443 16.9156 11.4466 17.6047 11.5105C19.4091 11.6778 20.8312 13.159 20.8312 15C20.8312 16.933 19.2642 18.5 17.3312 18.5C16.2581 18.5 15.232 18.0095 14.5834 17.3211Z"></path></svg>

                            <div class="informacion">
                                <a href="https://www.facebook.com/share/r/kjgfjh9xYWLvHTgh/" target="_blank">
                                    <span class="nombre">Gina Moran</span>
                                    <span class="experiencia">Maztlán, Sinaloa</span>
                                </a>
                            </div>
                        </div>

                        <div class="slide swiper-slide">
                            <img src="build/img/user.png" alt="Imagen de usuario predeterminada">

                            <p>Muchas gracias por todo, estuvo muy bien organizado, y excelente el trato.</p>

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="30" height="30" fill="rgba(109,151,115,1)"><path d="M4.58341 17.3211C3.55316 16.2274 3 15 3 13.0103C3 9.51086 5.45651 6.37366 9.03059 4.82318L9.92328 6.20079C6.58804 8.00539 5.93618 10.346 5.67564 11.822C6.21263 11.5443 6.91558 11.4466 7.60471 11.5105C9.40908 11.6778 10.8312 13.159 10.8312 15C10.8312 16.933 9.26416 18.5 7.33116 18.5C6.2581 18.5 5.23196 18.0095 4.58341 17.3211ZM14.5834 17.3211C13.5532 16.2274 13 15 13 13.0103C13 9.51086 15.4565 6.37366 19.0306 4.82318L19.9233 6.20079C16.588 8.00539 15.9362 10.346 15.6756 11.822C16.2126 11.5443 16.9156 11.4466 17.6047 11.5105C19.4091 11.6778 20.8312 13.159 20.8312 15C20.8312 16.933 19.2642 18.5 17.3312 18.5C16.2581 18.5 15.232 18.0095 14.5834 17.3211Z"></path></svg>

                            <div class="informacion">
                                <a href="https://www.facebook.com/share/v/2EMAdGpjxR2nSxj7/" target="_blank">
                                    <span class="nombre">Ana Coronado</span>
                                    <span class="experiencia">Mazatlán, Sinaloa</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-button-next nav-btn"></div>
                    <div class="swiper-button-prev nav-btn"></div>
                    <div class="swiper-pagination swp"></div>
                </div>
            </div>
        </section><!-- RESEÑAS -->
    </main>

    <?php incluirTemplate('footer'); ?>

    <script src="/build/js/app.js"></script>
    <script src="/build/js/modernizr.js"></script>
    <script src="/build/js/swiper.js"></script>
</body>
</html>