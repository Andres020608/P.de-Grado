<!DOCTYPE html>
<html lang="es">
    <head>
        <!-- Código hecho por Camilo Fernandez Astaiza -->
        <!-- Documentación general agregada para orientación de compañeros -->
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- Vincular iconos de redes sociales -->
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        />

        <!-- Icono de pestaña -->
        <link
            rel="icon"
            href="{{ asset('Images/imageSinCALIDAD (1).png') }}"
            type="image/png"
        />

        <!-- Fuentes de Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Ballet:opsz@16..72&family=Dancing+Script:wght@400..700&family=Monsieur+La+Doulaise&display=swap"
            rel="stylesheet"
        />

        <!-- Vinculación con hoja de estilos -->
        <link rel="stylesheet" href="{{ asset('css/Landing.UP.css') }}" />
        <title>Jesica Joyería</title>
    </head>

    <body>
        <!-- Encabezado con logo y menú -->
        <header>
            <a href="#" class="logo">
                <h1>Jesica Joyería</h1>
            </a>

            <!-- Botón hamburguesa -->
            <div class="menu-toggle" id="menu-toggle">
                &#9776;
                <!-- Icono de tres líneas -->
            </div>

            <!-- Barra de navegación -->
            <nav id="nav">
                <ul>
                    <li><a href= {{route('products.index')}}>Catalogo</a></li>
                    <li><a href="#">Contáctanos</a></li>
                    <li><a href="#">Ayuda</a></li>
                    <li>
                        <button>
                            <i
                                class="fa-solid fa-user"
                                style="color: #ffffff"
                            ></i>
                        </button>
                    </li>
                </ul>
            </nav>
        </header>

        <!-- Sección principal con imagen y eslogan -->
        <main class="hero">
            <div class="overlay"></div>

            <div class="logolan">
                <img
                    src="{{ asset('Images/image.png') }}"
                    alt="Logo Jesica Joyería"
                />
            </div>

            <div class="content">
                <h1>Inventario Jesica Joyería</h1>
                <p>Organiza, gestiona y brilla con cada detalle.</p>
                <button>Ir</button>
            </div>
        </main>

        <!-- Sección: información general -->
        <section class="about-section">
            <h2 class="about-title">Luce y siéntete bien</h2>

            <div class="about-logo">
                <img src="{{ asset('Images/Logo3.jpeg') }}" alt="Logo Joyería" />
            </div>

            <div class="about-box">
                <div class="about-item">
                    <h3>VENTA DE ACCESORIOS</h3>
                    <p>
                        Todos nuestros accesorios son fabricados en plata 100%
                        garantizada.<br />
                        Contamos con accesorios bañados en oro de 14k y 18k
                        (kilates).
                    </p>
                </div>

                <div class="divider"></div>

                <div class="about-item">
                    <h3>SERVICIOS</h3>
                    <p>
                        Nos ubicamos en Colombia. Se realizan domicilios en la
                        ciudad de Cali.<br />
                        Somos una tienda online, recibimos pagos digitales y
                        contra entrega.
                    </p>
                </div>
            </div>

            <div class="about-instagram">
                <a href="#" aria-label="Instagram"
                    ><i class="fab fa-instagram"></i
                ></a>
                <span>@JESSICA_JOYAS</span>
            </div>
        </section>

        <hr />

        <!-- Sección: Anillos de compromiso -->
        <section class="anillos-section">
            <div class="anillos-header">
                <img
                    src="{{ asset('Images/Logo3.jpeg') }}"
                    alt="Logo Joyas"
                    class="anillos-logo"
                />
                <h2 class="anillos-titulo">ANILLOS DE COMPROMISO</h2>
                <p class="anillos-subtitulo">Gran variedad de diseños</p>
                <p class="anillos-descripcion">
                    Anillos fabricados en plata y baño de oro de 14 y 18k.<br />
                    Distintos colores y tamaños.<br />
                    Todas las tallas, a partir de la 6.
                </p>
            </div>

            <div class="slider-box">
                <h2 class="anillosts">Anillos Recientes</h2>
                <ul class="slider">
                    <li>
                        <img
                            src="{{ asset('Images/Anillo1.jpeg') }}"
                            alt="Anillo de oro"
                        />
                    </li>
                    <li>
                        <img
                            src="/Html-css-js/Images/Anillo1.jpeg"
                            alt="Anillo de oro"
                        />
                    </li>
                    <li>
                        <img
                            src="/Html-css-js/Images/Anillo1.jpeg"
                            alt="Anillo de oro"
                        />
                    </li>
                    <li>
                        <img
                            src="/Html-css-js/Images/Anillo1.jpeg"
                            alt="Anillo de oro"
                        />
                    </li>
                    <li>
                        <img
                            src="/Html-css-js/Images/Anillo1.jpeg"
                            alt="Anillo de oro"
                        />
                    </li>
                    <li>
                        <img
                            src="/Html-css-js/Images/Anillo1.jpeg"
                            alt="Anillo de oro"
                        />
                    </li>
                    <li>
                        <img
                            src="/Html-css-js/Images/Anillo1.jpeg"
                            alt="Anillo de oro"
                        />
                    </li>
                    <li>
                        <img
                            src="/Html-css-js/Images/Anillo1.jpeg"
                            alt="Anillo de oro"
                        />
                    </li>
                </ul>
            </div>
        </section>

        <!-- Sección: Explorar más -->
        <section class="explore">
            <h2>Descubre Más de Jesica Joyería</h2>

            <div class="explore-grid">
                <div class="card">
                    <img
                        src="{{ asset('Images/Anillo1.jpeg') }}"
                        alt="Anillo oro rosa"
                    />
                    <div class="card-content">
                        <h3>Anillo de Oro Rosa</h3>
                        <p>Una joya atemporal con destellos que enamoran.</p>
                    </div>
                </div>

                <div class="card">
                    <img
                        src="{{ asset('Images/Anillo7.jpeg') }}"
                        alt="Anillo de plata con piedra"
                    />
                    <div class="card-content">
                        <h3>Anillo de Plata</h3>
                        <p>Elegancia moderna con un toque clásico.</p>
                    </div>
                </div>

                <div class="card">
                    <img
                        src="{{ asset('Images/Anillo5.jpeg') }}"
                        alt="Anillo de compromiso"
                    />
                    <div class="card-content">
                        <h3>Anillo de Compromiso</h3>
                        <p>El brillo que celebra las promesas eternas.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sección: Sobre nosotros -->
        <section id="about-us" class="about-us">
            <div class="about">
                <img src="{{ asset('Images/about.jpg') }}" alt="" />
                <h2 class="anillosts">About us</h2>
            </div>

            <div class="about-us-text">
                <h3>Sobre Nosotros</h3>
                <p>
                    En Jesica Joyeria, creemos que cada accesorio cuenta una
                    historia. Nos inspira la elegancia, la autenticidad y el
                    deseo de ofrecer piezas que realcen la personalidad de quien
                    las lleva.
                </p>
                <p>
                    Cada diseño es cuidadosamente seleccionado para combinar
                    calidad, estilo y durabilidad, reflejando nuestra pasión por
                    los detalles y el trabajo artesanal.
                </p>
                <br />
                <h3>Nuestra Filosofía</h3>
                <p>
                    Nos mueve la idea de que la joyería no es solo un
                    complemento, sino una forma de expresión. Por eso,
                    trabajamos con materiales nobles y diseños modernos que
                    acompañan tus momentos más importantes.
                </p>
                <br />
                <h3>Compromiso con el Cliente</h3>
                <p>
                    Queremos que cada compra sea una experiencia única.
                    Ofrecemos atención personalizada, asesoría en estilos y
                    entregas seguras en todo el país.
                </p>
                <br />
                <p>Si quieres saber más de nosotros:</p>
                <a
                    href="{{ asset('PDF/Jessica Joyería.pdf') }}"
                    download="Jessica Joyería.pdf"
                    target="_blank"
                    >Descarga nuestro PDF</a
                >
            </div>
        </section>

        <!-- Pie de página -->
        <footer>
            <div class="footer-content">
                <p>
                    &copy; 2025 Jesica Joyería. Todos los derechos reservados.
                </p>
                <div class="social-icons">
                    <a href="#" aria-label="Facebook"
                        ><i class="fab fa-facebook-f"></i
                    ></a>
                    <a href="#" aria-label="Instagram"
                        ><i class="fab fa-instagram"></i
                    ></a>
                    <a href="#" aria-label="Twitter"
                        ><i class="fab fa-x-twitter"></i
                    ></a>
                    <a href="#" aria-label="WhatsApp"
                        ><i class="fab fa-whatsapp"></i
                    ></a>
                </div>
            </div>
        </footer>

        <!-- Script JS del menú hamburguesa -->
        <script src="{{ asset('js/menu.js') }}"></script>
    </body>
</html>
