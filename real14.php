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
    <link rel="stylesheet" href="build/css/app.css">
    <link rel="stylesheet" href="build/css/cerrarS.css">
    <link rel="icon" href="src/img/myris.png" type="image/x-icon">
</head>
<body>
    <header class="header">
        <div class="barra contenedor">
            <div class="logo">
                <a href="index.html"><h1 class="logo__texto">Miry's Viajes</h1></a>
            </div>

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
                <a href="index.php#incio" class="navegacion__enlace">Inicio</a>
                <a href="index.php#servicios" class="navegacion__enlace">Servicos</a>
                <a href="index.php#viajes" class="navegacion__enlace">Viajes</a>
                <a href="index.php#reseñas" class="navegacion__enlace">Reseñas</a>
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


            <nav class="navegacion-viaje">
                <a href="index.php#inicio" class="navegacion__enlace">Inicio</a>
                <a href="index.php#servicios" class="navegacion__enlace">Servicos</a>
                <a href="index.php#viajes" class="navegacion__enlace">Viajes</a>
                <a href="index.php#reseñas" class="navegacion__enlace">Reseñas</a>
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
    </header><!-- HEADER -->

    <div class="contenido">
        <div class="contenido__principal contenedor">
            <p class="p1">Inicia un viaje con nosotros y diviértete!</p>
            <p class="p2">Estamos aquí para hacer realidad tus sueños de viaje con experiencias inolvidables y servicios personalizados.</p>
        </div>
    </div><!-- CONTENIDO -->

    <main class="contenedor">
        <section clase="viaje">
            <h2>Real de 14</h2>

            <div class="viaje-contenido">
                <picture>
                    <source loading="lazy" srcset="/build/img/real-14.webp" type="image/webp">
                    <source loading="lazy" srcset="/build/img/real-14.avif" type="image/avif">
                    <img class="viajes__img" loading="lazy" src="/build/img/real-14.png" alt="Imagen viaje">
                </picture>

                <ul class="contenido-lista no-padding">
                    <li class="lista__informacion">
                        <div class="lista__descripcion">
                            <h3>SALIDA Y REGRESO</h3>
                            <p>8 al 10 de noviembre.</p>
                            <p>2 días y 1 noche.</p>
                        </div>
                    </li>
                    <li class="lista__informacion">
                        <div class="lista__descripcion">
                            <h3>PRECIO POR PERSONA</h3>
                            <p>$1,950 p/p habitacion doble</p>
                            <p>$1,800 p/p habitacion triple</p>
                            <p>$1,750 p/p habitacion cuadruple</p>
                        </div>
                    </li>
                    <li class="lista__informacion">
                        <div class="lista__descripcion">
                            <h3>ACTIVIDADES</h3>
                            <p>Paseo en willys $250</p>
                            <p>Paseo en caballo $350</p>
                            <p>Tirolesa $500</p>
                            <p>Manos de San Francisco de Asís $100</p>
                            <p>Puente de cristal $50</p>
                            <p>Resbaladero de cristal $150</p>
                            <p>Escalera al cielo $100</p>
                            <p>Tours de las leyendas $50</p>
                        </div>
                    </li>
                    <li class="lista__informacion">
                        <div class="lista__descripcion">
                            <h3>AVISOS</h3>
                            <p>Separa con $500, los lugares deben liquidarse 15 días antes del viaje.</p>
                            <p>Los lugares en el autobús se van asignando como vayan pagando.</p>
                            <p>El costo no incluye traslado en camioneta para cruce del túnel, alimentos ni propinas.</p>
                            <p>En caso de cancelación por parte del cliente no hay reembolso.</p>
                        </div>
                    </li>
                    <li class="lista__informacion">
                        <div class="lista__descripcion">
                            <h3>LUGAR DE SALIDA</h3>
                            <p>Av. Los Pinos y Rio Ramos Villas de Ote.</p>
                            <p>Guadalupe / Plaza de las Banderas</p>
                        </div>
                    </li>
                    <li class="lista__informacion">
                        <div class="lista__descripcion">
                            <h3>HORARIO DE SALIDA & REGRESO</h3>
                            <p>Viernes en la noche</p>
                            <p>Domingo después del mediodía</p>
                        </div>
                    </li>
                </ul>
            </div>

            <a class="contacto" href="https://wa.me/8112586422?text=Hola,%20me%20gustaría%20saber%20más%20sobre%20el%20viaje.%0Ahttps://mirys.vercel.app/real14.html" target="_blank">Separa tu lugar</a>
        </section>
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