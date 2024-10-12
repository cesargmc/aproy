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
    <link rel="stylesheet" href="/build/css/app.css">
    <link rel="icon" href="/src/img/myris.png" type="image/x-icon">
</head>
<body>
    <header id="#header" class="header">
        <div class="barra contenedor">
            <div class="logo">
                <a href="../../public/index.php"><h1 class="logo__texto">Miry's Viajes</h1></a>
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
                <a href="/public/index.php#inicio" class="navegacion__enlace">Inicio</a>
                <a href="/public/index.php#servicios" class="navegacion__enlace">Servicos</a>
                <a href="/public/index.php#viajes" class="navegacion__enlace">Viajes</a>
                <a href="/public/index.php#reseñas" class="navegacion__enlace">Reseñas</a>
            </aside>

            <!-- Menu Tablet+ -->
            <nav class="navegacion">
                <a href="/public/index.php#inicio" class="navegacion__enlace">Inicio</a>
                <a href="/public/index.php#servicios" class="navegacion__enlace">Servicos</a>
                <a href="/public/index.php#viajes" class="navegacion__enlace">Viajes</a>
                <a href="/public/index.php#reseñas" class="navegacion__enlace">Reseñas</a>
                <a href="/public/login.php" class="navegacion__enlace-login">Acceder</a>
            </nav>
        </div>
    </header>

    <?php if ($inicio): ?>
        <div id="inicio" class="contenido">
            <div class="contenido__principal contenedor">
                <p class="p1">Inicia un viaje con nosotros y diviértete!</p>
                <p class="p2">Estamos aquí para hacer realidad tus sueños de viaje con experiencias inolvidables y servicios personalizados.</p>
            </div>
        </div><!-- CONTENIDO -->
    <?php endif; ?>