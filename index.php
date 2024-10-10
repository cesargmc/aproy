<?php
    require 'php/config.php';
    require 'php/conexion.php';
    $db = new Database();
    $con = $db->conectar();

    $comando = $con->prepare("SELECT id, nombre FROM viajes WHERE estado=1");
    $comando->execute();
    $resultado = $comando ->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Miry's Viajes</title>
    <meta name="description" content="Página web de viajes Mirys">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="build/css/app.css">
    <link rel="stylesheet" href="build/css/cerrarS.css">
    <link rel="icon" href="src/img/myris.png" type="image/x-icon">
</head>
<body>
    <header class="header">
        <div class="barra contenedor">
            <div class="logo">
                <a href="index.php"><h1 class="logo__texto">Miry's Viajes</h1></a>
            </div>

            <!-- Menu Celular -->
            <div class="overlay"></div>

            <button class="menu">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-menu-2" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#0c3b2e" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M4 6l16 0" />
                    <path d="M4 12l16 0" />
                    <path d="M4 18l16 0" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#0c3b2e" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M18 6l-12 12" />
                    <path d="M6 6l12 12" />
                  </svg>
            </button>

            <aside>
                <a href="#inicio" class="navegacion__enlace">Inicio</a>
                <a href="#servicios" class="navegacion__enlace">Servicos</a>
                <a href="#viajes" class="navegacion__enlace">Viajes</a>
                <a href="#reseñas" class="navegacion__enlace">Reseñas</a>
                <?php if (isset($_SESSION['user_name'])): ?>
                    <div class="menuSalir">
                        <a href="#" class="navegacion__enlace">Hola, <?php echo htmlspecialchars($_SESSION['user_name']); ?></a>
                        <div class="menuSalir_diseño">
                            <a href="php/cerrarS.php">Cerrar Sesión</a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="login.php" class="navegacion__enlace">Iniciar Sesión</a>
                <?php endif; ?>
            </aside>

            <!-- Menu Tablet+ -->
            <nav class="navegacion">
                <a href="#inicio" class="navegacion__enlace">Inicio</a>
                <a href="#servicios" class="navegacion__enlace">Servicos</a>
                <a href="#viajes" class="navegacion__enlace">Viajes</a>
                <a href="#reseñas" class="navegacion__enlace">Reseñas</a>
                <?php if (isset($_SESSION['user_name'])): ?>
                    <div class="menuSalir">
                        <a href="#" class="navegacion__enlace" style="text-decoration: none;color: #6d9773;font-size: 1.8rem;margin-left: 1.5rem;">Hola, <?php echo htmlspecialchars($_SESSION['user_name']); ?></a>
                        <div class="menuSalir_diseño">
                            <a href="php/cerrarS.php">Cerrar Sesión</a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="login.php" style="text-decoration: none;color: #6d9773;font-size: 1.8rem;margin-left: 1.5rem;">Iniciar Sesión</a>
                <?php endif; ?>
            </nav>
        </div>

    </header>

    <div id="inicio" class="contenido">
        <div class="contenido__principal contenedor">
            <p class="p1">Inicia un viaje con nosotros y diviértete!</p>
            <p class="p2">Estamos aquí para hacer realidad tus sueños de viaje con experiencias inolvidables y servicios personalizados.</p>
        </div>
    </div><!-- CONTENIDO -->

    <main class="contenedor">
        <section id="servicios" class="servicio texto-centrado">
            <h2>Mis Servicios</h2>

            <p class="servicios__texto">
                Ofrecemos servicio de transporte de ida y vuelta, con una coordinadora que se encargará de los paseos y traslados durante todo el viaje. Disfruta de snacks mientras te desplazas, y al final del recorrido, participa en una rifa especial para nuestros viajeros.
            </p>

            <div class="servicios">
                <div class="servicios__contenido">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bed" width="80" height="80" viewBox="0 0 24 24" stroke-width="1.5" stroke="#6d9773" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M3 7v11m0 -4h18m0 4v-8a2 2 0 0 0 -2 -2h-8v6" />
                        <path d="M7 10m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                    </svg>
    
                    <h2>Hospedaje</h2>
                    <p>Disfruta de una estancia sin preocupaciones en nuestros hoteles seleccionados. Todo lo que necesitas hacer es llegar, y nosotros nos encargaremos del resto.</p>
                </div><!-- servicios__contenido -->

                <div class="border"></div>

                <div class="servicios__contenido">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bus" width="80" height="80" viewBox="0 0 24 24" stroke-width="1.5" stroke="#6d9773" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M6 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M18 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M4 17h-2v-11a1 1 0 0 1 1 -1h14a5 7 0 0 1 5 7v5h-2m-4 0h-8" />
                        <path d="M16 5l1.5 7l4.5 0" />
                        <path d="M2 10l15 0" />
                        <path d="M7 5l0 5" />
                        <path d="M12 5l0 5" />
                    </svg>
    
                    <h2>Transporte</h2>
                    <p>Viaja cómodamente en nuestros autobuses climatizados, que ofrecen un recorrido redondo con todas las comodidades baños a bordo y paradas programadas para estirar las piernas y disfrutar de un refrigerio.</p>
                </div><!-- servicios__contenido -->

                <div class="border"></div>

                <div class="servicios__contenido">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shield-lock" width="80" height="80" viewBox="0 0 24 24" stroke-width="1.5" stroke="#6d9773" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3" />
                        <path d="M12 11m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                        <path d="M12 12l0 2.5" />
                    </svg>
    
                    <h2>Seguro de Viaje</h2>
                    <p>Tu seguridad es nuestra prioridad. Por eso, todos nuestros viajeros cuentan con un seguro de viaje mientras están a bordo de nuestras unidades, para que disfrutes del viaje con total tranquilidad.</p>
                </div><!-- servicios__contenido -->
            </div>
        </section><!-- SERVICIO -->

        <section id="viajes" class="catalogo">
            <h2 class="texto-centrado">Próximos Viajes</h2>

            <section class="catalogos">
                <picture>
                    <source loading="lazy" srcet="build/img/real-14.webp" type="image/webp">
                    <source loading="lazy" srcset="build/img/real-14.avif" type="image/avif">
                    <img class="catalogos__img" loading="lazy" src="/build/img/real-14.png" alt="Imagen viaje">
                </picture>
                <div class="catalogo__contenido">
                    <h3>Real de 14</h3>

                    <ul class="contenido__enlace no-padding">
                        <li class="lista">
                            <i class="fa-regular fa-circle-check" style="color: #6d9773;"></i>
                            8 al 10 de noviembre.
                            <br>
                            2 días y 1 noche.
                        </li>
                        <li class="lista">
                            <i class="fa-regular fa-circle-check" style="color: #6d9773;"></i>
                            Separa con $500, los lugares deben liquidarse 15 días antes del viaje.
                            <br>
                            El costo no incluye traslado en camioneta para cruce del túnel, alimentos ni propinas.
                        </li>
                        <li class="lista">
                            <i class="fa-regular fa-circle-check" style="color: #6d9773;"></i>
                            $1,950 p/p habitacion doble
                            <br>
                            $1,800 p/p habitacion triple
                            <br>
                            $1,750 p/p habitacion cuadruple
                        </li>
                        <li class="lista">
                            <i class="fa-regular fa-circle-check" style="color: #6d9773;"></i>
                            Salimos viernes en la noche
                            <br>
                            Regresamos el domingo después de mediodía
                        </li>
                    </ul>

                    <a href="real14.php" class="link">Leer más</a>
                </div>
            </section><!-- SECCION VIAJES-->
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

    <footer class="footer">
        <div class="barra contenedor">
            <div class="iconos">
                <a class="whats" href="https://wa.me/8112586422" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-whatsapp" width="20" height="20" viewBox="0 0 22 22" stroke-width="1.5" stroke="#6d9773" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" />
                        <path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" />
                    </svg>
                </a>

                <a class="face" href="https://www.instagram.com/viajestours_myris/" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-instagram" width="20" height="20" viewBox="0 0 22 22" stroke-width="1.5" stroke="#6d9773" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M4 4m0 4a4 4 0 0 1 4 -4h8a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z" />
                        <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        <path d="M16.5 7.5l0 .01" />
                    </svg>
                </a>

                <a href="https://www.facebook.com/profile.php?id=100030899392588" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-facebook" width="20" height="20" viewBox="0 0 21 21" stroke-width="1.5" stroke="#6d9773" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" />
                    </svg>
                </a>
            </div>

            <div class="logo">
                <h1 class="logo__texto">Miry's Viajes</h1>
            </div>

            <p class="copyright">©Myri's 2023</p>
        </div>
    </footer><!-- FOOTER -->

    <script src="build/js/app.js"></script>
    <script src="build/js/modernizr.js"></script>
    <script src="build/js/swiper.js"></script>
</body>
</html>