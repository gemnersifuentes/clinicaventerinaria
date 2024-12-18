<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inicio</title>

   @include('scoobydoo.layouts.partials.css')
    <style>
        /* Animación para la transición del menú */
        .slide-in {
            transform: translateX(0);
            transition: transform 0.3s ease-in-out;
        }

        .slide-out {
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }

        #mobile-menu {
            position: fixed;
            /* Mantén el menú fijo en la pantalla */
            top: 0;
            left: 0;
            width: 50%;
            /* Ajusta el ancho completo para el menú móvil */
            height: 100%;
            background-color: white;
            z-index: 9999;
            /* Asegura que el menú esté sobre otros elementos */
            transform: translateX(-100%);
            /* Empieza oculto fuera de la pantalla */
            transition: transform 0.3s ease-in-out;
            /* Transición suave para mostrar el menú */
        }



        /* Estilo para los iconos de redes sociales */
        .social-icon {
            width: 36px;
            /* Ancho del círculo */
            height: 36px;
            /* Alto del círculo */
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            /* Círculo perfecto */
            background-color: #e0e0e0;
            /* Fondo inicial */
            transition: background-color 0.3s, transform 0.3s;
            /* Transición suave */
        }

        .social-icon:hover {
            background-color: #6b5fc9;
            /* Cambia el fondo al pasar el mouse */
            transform: scale(1.1);
            /* Efecto de escalado */
        }

        .fixed {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 70px;
            background-color: white;
            /* Cambia el color de fondo si es necesario */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            /* Sombra para el efecto de elevación */

            z-index: 10;
            /* Asegúrate de que esté sobre otros elementos */

            padding: 0px 16px;
        }
    </style>
</head>

<body>
    <!-- Header -->

    <header class="bg-white shadow p-4">

        <div class="flex items-center justify-between" id="menu-container-mobile">
            <!-- Logo y ubicación (ocultar en móviles) -->
            <div class="flex items-center space-x-4">
                <span class="text-purple-600 text-2xl font-bold">SCOOBY-DOO</span>
            </div>
            <span class="text-gray-500 text-center hidden lg:block">Jirón Dos de Mayo 308, Chachapoyas</span>
            <!-- Iconos de redes sociales (ocultar en móviles) -->
            <div class="flex space-x-4 hidden lg:flex">
                <a href="#" class="social-icon text-gray-500 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-icon text-gray-500 hover:text-white"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-icon text-gray-500 hover:text-white"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-icon text-gray-500 hover:text-white"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <!-- Cuadro de búsqueda para móviles -->
            <div class="relative lg:hidden ml-2">
                <input type="text" class="pl-10 pr-4 py-2 w-full border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500"
                    placeholder="Buscar...">
                <svg class="w-5 h-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m1.88-4.65a7.5 7.5 0 11-15 0 7.5 7.5 0 0115 0z"></path>
                </svg>
            </div>
            <!-- Icono de hamburguesa para móviles -->
            <button id="menu-btn" class="lg:hidden text-gray-500 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Línea (ocultar en móviles) -->
        <div class="border-t border-gray-300 my-4 hidden lg:block"></div>

        <!-- Contenedor del menú y el cuadro de búsqueda -->
        <div class="flex items-center justify-between lg:flex-row" id="menu-container-desktop">
            <!-- Menú visible en pantallas grandes y oculto en móviles -->
            <nav id="menu" class="lg:flex lg:items-center lg:space-x-6 hidden lg:block">
                <!-- Botón para cerrar el menú en móviles -->
                <button id="close-btn" class="absolute top-4 right-4 lg:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <a href="/scoobydoo" class="menu-item block text-purple-600 border-b-2 border-purple-600 py-2 px-4 lg:py-0" onclick="setActive(this)">Inicio</a>
                <a href="servicios.php" class="menu-item block text-gray-500 hover:text-gray-800 py-2 px-4 lg:py-0" onclick="setActive(this)">Servicios</a>
                <a href="agenda.php" class="menu-item block text-gray-500 hover:text-gray-800 py-2 px-4 lg:py-0" onclick="setActive(this)">Agendar Cita</a>
                <a href="{{ route('scoobydoo.productos.index') }}" class="menu-item block text-gray-500 hover:text-gray-800 py-2 px-4 lg:py-0" onclick="setActive(this)">Productos</a>
                <a href="nosotros.php" class="menu-item block text-gray-500 hover:text-gray-800 py-2 px-4 lg:py-0" onclick="setActive(this)">Nosotros</a>
                <a href="contacto.php" class="menu-item block text-gray-500 hover:text-gray-800 py-2 px-4 lg:py-0" onclick="setActive(this)">Contacto</a>
            </nav>
      

            <!-- Cuadro de búsqueda (en pantallas grandes, alineado a la derecha del menú) -->
            <div class="flex items-center ml-auto space-x-4">
                <div class="relative hidden lg:block">
                    <form action="{{ route('productos.search') }}" method="GET" class="flex items-center relative">
                        <input
                            type="text"
                            name="search"
                            placeholder="Buscar productos..."
                            class="border border-gray-300 p-2 rounded-l-md w-full focus:outline-none"
                            id="searchInput"
                            autocomplete="off">
                        <button type="submit" class="bg-blue-500 text-white p-2 rounded-r-md hover:bg-blue-600">Buscar</button>
                        <div id="suggestions" class="absolute top-full left-0 w-full bg-white border border-gray-300 rounded-b-md hidden"></div>
                    </form>
            

                </div>

                <div class="relative" style="border-radius: 50%; background-color: rgb(248, 248, 248); padding:2px;">
                    <img src="https://img.icons8.com/?size=100&id=fJ7hcfUGpKG7&format=png&color=000000" alt="Carrito" class="w-8 h-8">
                    <!-- Contador en la esquina superior derecha del ícono -->

                </div>
                <div class="flex items-center text-gray-700 cursor-pointer">
                    <div class="flex flex-col ml-2 text-sm text-gray-600">
                        @if(Auth::guard('cliente')->check())
                            {{-- Cliente autenticado --}}
                            <span id="userAccountBtn">Hola, {{ explode(' ', Auth::guard('cliente')->user()->nombre)[0] }}</span>

                            
                            <div class="relative">
                                <button id="accountButton" style="margin-top: -10px;" class="py-2 text-gray-700">Mi Cuenta</button>
                                <div id="accountDropdownMenu" class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 shadow-lg rounded-md hidden z-50">
                                    <a href="{{ route('scoobydoo.cliente.mi_cuenta') }}" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Mi cuenta</a>
                                    <form method="POST" action="{{ route('scoobydoo.cliente.logout') }}">
                                        @csrf  <!-- Este es el token CSRF -->
                                        <button type="submit" class="text-red-600 hover:underline">Cerrar Sesión</button>
                                    </form>
                                    
                                </div>
                            </div>
                        @else
                            {{-- Cliente no autenticado --}}
                            <span id="userAccountBtn">Hola, Invitado</span>
                            
                            <div class="relative">
                                <button id="accountButton" style="margin-top: -10px;" class="py-2 text-gray-700">Mi Cuenta</button>
                                <div id="accountDropdownMenu" class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 shadow-lg rounded-md hidden z-50">
                                    <a href="{{ route('scoobydoo.cliente.login') }}" class="block px-4 py-2 text-sm text-indigo-600 hover:bg-gray-100">Iniciar Sesión</a>
                                    <a href="{{ route('scoobydoo.cliente.registro') }}" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Registrarse</a>
                                </div>
                            </div>
                        @endif
                    </div>
                    




                </div>

                <style>
                    /* Estilos adicionales para asegurar que el modal esté centrado */
                    #loginModal {
                        display: none;
                        /* Inicialmente oculto */
                        justify-content: center;
                        align-items: center;
                    }

                    #loginModal .modal-content {
                        background-color: white;
                        width: 400px;
                        padding: 20px;
                        border-radius: 8px;
                        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
                    }
                </style>


                <div class="relative flex items-center space-x-2 text-gray-600 hover:text-gray-800 cursor-pointer">
                    <a href="cart.php" class="relative" style="border-radius: 50%; background-color: rgb(248, 248, 248); padding: 2px; display: inline-block;">
                        <img src="https://img.icons8.com/?size=100&id=gApPmBfBhHWY&format=png&color=000000" alt="Carrito" class="w-10 h-10">
                        <span id="cart-count" class="absolute top-0 right-0 bg-red-500 text-white rounded-full text-xs w-4 h-4 flex items-center justify-center transform translate-x-1/3 -translate-y-1/5">
                            
                        </span>
                    </a>

                    <div class="flex flex-col">
                        <span id="cart-total" class="font-semibold">S/.2365 </span>
                    </div>

                    <div id="cartDropdownMenu" class="absolute right-0 mt-2 w-80 bg-white border border-gray-200 shadow-lg rounded-md hidden z-50 transition-all duration-500 transform -translate-y-5 opacity-0">
                        <div class="p-4 border-b border-gray-200 bg-gray-100 rounded-t-md flex justify-between items-center">
                            <span class="font-semibold text-lg">Carrito de Compras</span>
                            <button onclick="closeCartMenu()" class="text-red-500 hover:text-red-700">✕</button>
                        </div>
                        <div id="cart-items" class="p-4 space-y-3 max-h-96 overflow-y-auto">
                           
                        </div>

                        <div class="flex justify-between items-center p-4 border-t border-gray-200 bg-gray-100 rounded-b-md">
                            <form method="POST" action="">
                                <button type="submit" name="clear_cart" class="bg-red-500 text-white px-4 py-2 text-sm rounded hover:bg-red-600 transition-all duration-200">Vaciar carrito</button>
                            </form>
                            <button id="confirmPurchaseBtn" class="bg-blue-500 text-white px-4 py-2 text-sm rounded hover:bg-blue-600 transition-all duration-200">Confirmar compra</button>
                        </div>
                    </div>
                </div>

                <script>
                    // Función para agregar un producto al carrito
                    function addToCart(productId) {
                        var xhr = new XMLHttpRequest();
                        xhr.open('GET', 'products.php?add_to_cart=' + productId, true);
                        xhr.onload = function() {
                            if (xhr.status === 200) {
                                var response = JSON.parse(xhr.responseText);

                                if (response.status === 'success') {
                                    // Actualizar el contador de productos en el carrito
                                    document.getElementById('cart-count').textContent = response.cart_count;

                                    // Actualizar el total del carrito
                                    document.getElementById('cart-total').textContent = 'S/. ' + response.cart_total;

                                    // Actualizar la lista de productos del carrito
                                    document.getElementById('cart-items').innerHTML = response.cart_html;
                                } else {
                                    alert(response.message);
                                }
                            }
                        };
                        xhr.send();
                    }
                </script>



                <script>
                    function toggleCartMenu() {
                        const cartMenu = document.getElementById('cartDropdownMenu');
                        if (cartMenu.classList.contains('hidden') || cartMenu.style.display === 'none') {
                            // Mostrar el menú con la animación
                            cartMenu.classList.remove('hidden');
                            cartMenu.style.display = 'block';
                            setTimeout(() => {
                                cartMenu.classList.remove('-translate-y-5', 'opacity-0');
                                cartMenu.classList.add('translate-y-0', 'opacity-100');
                            }, 10); // Breve retraso para activar la transición
                        } else {
                            // Ocultar el menú con la animación
                            cartMenu.classList.add('-translate-y-5', 'opacity-0');
                            cartMenu.classList.remove('translate-y-0', 'opacity-100');
                            setTimeout(() => {
                                cartMenu.style.display = 'none';
                            }, 500); // Tiempo de la animación
                        }
                    }

                    function closeCartMenu() {
                        const cartMenu = document.getElementById('cartDropdownMenu');
                        if (cartMenu.style.display !== 'none') {
                            // Ocultar el menú con la animación
                            cartMenu.classList.add('-translate-y-5', 'opacity-0');
                            cartMenu.classList.remove('translate-y-0', 'opacity-100');
                            setTimeout(() => {
                                cartMenu.style.display = 'none';
                            }, 500); // Tiempo de la animación
                        }
                    }

                    // Cerrar el menú si se hace clic fuera de él
                    window.onclick = function(event) {
                        const cartMenu = document.getElementById('cartDropdownMenu');
                        if (!event.target.closest('#cartDropdownMenu') && !event.target.closest('div[onclick="toggleCartMenu()"]')) {
                            if (cartMenu.style.display !== 'none') {
                                closeCartMenu();
                            }
                        }
                    }
                </script>



                <!-- Menú desplegable del carrito -->



            </div>
        </div>
        <script>
            // Obtener el botón y el menú desplegable
            const accountButton = document.getElementById('accountButton');
            const accountDropdownMenu = document.getElementById('accountDropdownMenu');

            // Añadir un evento de clic al botón
            accountButton.addEventListener('click', function() {
                // Alternar la clase 'hidden' para mostrar u ocultar el menú
                accountDropdownMenu.classList.toggle('hidden');
            });

            // Opcional: Cerrar el menú si se hace clic fuera de él
            window.addEventListener('click', function(event) {
                if (!accountButton.contains(event.target) && !accountDropdownMenu.contains(event.target)) {
                    accountDropdownMenu.classList.add('hidden');
                }
            });
        </script>


        <!-- Menú lateral para móviles -->
        <nav id="mobile-menu" class="fixed inset-y-0 left-0 bg-white w-64 transform -translate-x-full lg:hidden shadow-lg">
            <button id="close-btn-mobile" class="absolute top-4 right-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div class="flex flex-col p-4 space-y-2">
                <a href="#" class="block text-purple-600 py-2">Basic</a>
                <a href="#" class="block text-gray-500 hover:text-gray-800 py-2">Integrations</a>
                <a href="#" class="block text-gray-500 hover:text-gray-800 py-2">Notifications</a>
                <a href="#" class="block text-gray-500 hover:text-gray-800 py-2">Usage</a>
                <a href="#" class="block text-gray-500 hover:text-gray-800 py-2">Billing</a>
                <a href="#" class="block text-gray-500 hover:text-gray-800 py-2">Advanced</a>
            </div>
        </nav>
    </header>

    <!-- JavaScript para manejar el menú de hamburguesa -->
    <script>
        // JavaScript para fijar el menú
        const mobileMenuContainer = document.getElementById('menu-container-mobile');
        const desktopMenuContainer = document.getElementById('menu-container-desktop');

        function handleScroll() {
            // Para el menú móvil
            if (mobileMenuContainer) {
                const stickyMobile = mobileMenuContainer.offsetTop;

                if (window.innerWidth < 1024) { // Ancho de la pantalla menor a 1024px (dispositivos móviles)
                    if (window.pageYOffset > stickyMobile) {
                        mobileMenuContainer.classList.add("fixed");
                    } else {
                        mobileMenuContainer.classList.remove("fixed");
                    }
                } else {
                    mobileMenuContainer.classList.remove("fixed"); // Eliminar la clase fija en pantallas grandes
                }
            }

            // Para el menú de escritorio
            if (desktopMenuContainer) {
                const stickyDesktop = desktopMenuContainer.offsetTop;

                if (window.innerWidth >= 1024) { // Ancho de la pantalla igual o mayor a 1024px (escritorio)
                    if (window.pageYOffset > stickyDesktop) {
                        desktopMenuContainer.classList.add("fixed");
                    } else {
                        desktopMenuContainer.classList.remove("fixed");
                    }
                } else {
                    desktopMenuContainer.classList.remove("fixed"); // Eliminar la clase fija en pantallas pequeñas
                }
            }
        }

        window.onscroll = handleScroll; // Asignar la función al evento de desplazamiento
        window.onresize = handleScroll; // También ejecutar en el cambio de tamaño de la ventana

        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const closeBtnMobile = document.getElementById('close-btn-mobile');

        menuBtn.addEventListener('click', () => {
            mobileMenu.style.transform = 'translateX(0)'; // Mostrar el menú móvil
        });

        closeBtnMobile.addEventListener('click', () => {
            mobileMenu.style.transform = 'translateX(-100%)'; // Ocultar el menú móvil
        });

        // Función para cambiar el estado activo del menú
        function setActive(element) {
            const menuItems = document.querySelectorAll('.menu-item');
            menuItems.forEach(item => item.classList.remove('text-purple-600', 'border-b-2', 'border-purple-600'));

            // Añadir las clases al elemento actual
            element.classList.add('text-purple-600', 'border-b-2', 'border-purple-600');

            // Guardar la opción seleccionada en el localStorage
            localStorage.setItem('activeMenu', element.textContent.trim());
        }

        // Al cargar la página, aplicar la clase activa al menú guardado
        window.onload = function() {
            const activeMenu = localStorage.getItem('activeMenu');

            if (activeMenu) {
                const menuItems = document.querySelectorAll('.menu-item');
                menuItems.forEach(item => {
                    if (item.textContent.trim() === activeMenu) {
                        item.classList.add('text-purple-600', 'border-b-2', 'border-purple-600');
                    }
                });
            }
        };

        // Función para cambiar el estado activo del menú
        function setActive(element) {
            const menuItems = document.querySelectorAll('.menu-item');
            menuItems.forEach(item => item.classList.remove('text-purple-600', 'border-b-2', 'border-purple-600'));
            element.classList.add('text-purple-600', 'border-b-2', 'border-purple-600');
        }
    </script>


</body>

</html>