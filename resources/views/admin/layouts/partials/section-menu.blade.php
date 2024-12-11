
<div class="section-menu-left">
    <div class="box-logo">
        <a href="index.html" id="site-logo-inner">
            <img class="" id="logo_header" alt="" src="images/logo/logo.png"
                data-light="images/logo/logo.png" data-dark="images/logo/logo.png">
        </a>
        <div class="button-show-hide">
            <i class="icon-menu-left"></i>
        </div>
    </div>
    <div class="center">
        <div class="center-item">
            <div class="center-heading">Main Home</div>
            <ul class="menu-list">
                <li class="menu-item">
                    <a href="index.html" class="">
                        <div class="icon"><i class="icon-grid"></i></div>
                        <div class="text">Dashboard</div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="center-item">
            <ul class="menu-list">
                <li class="menu-item has-children">
                    <a href="javascript:void(0);" class="menu-item-button">
                        <div class="icon"><i class="icon-shopping-cart"></i></div>
                        <div class="text">Productos</div>
                    </a>
                    <ul class="sub-menu">
                        <li class="sub-menu-item">
                            <a href="" class="">
                                <div class="text">Nuevo Producto</div>
                            </a>
                        </li>
                        <li class="sub-menu-item">
                            <a href="{{ route('productos.index') }}" class="">
                                <div class="text">Productos</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item has-children">
                    <a href="javascript:void(0);" class="menu-item-button">
                        <div class="icon"><i class="icon-layers"></i></div>
                        <div class="text">Categorías</div>
                    </a>
                    <ul class="sub-menu">
                      
                        <li class="sub-menu-item">
                            <a href="  " class="">
                                <div class="text">nueva categoría</div>
                            </a>
                        </li>
                        <li class="sub-menu-item">
                            <a href="{{ route('categorias.index') }}" class="">
                                <div class="text">categorías</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item has-children">
                    <a href="javascript:void(0);" class="menu-item-button">
                        <div class="icon"><i class="icon-layers"></i></div>
                        <div class="text">Maracas</div>
                    </a>
                    <ul class="sub-menu">
                        <li class="sub-menu-item">
                            <a href="{{ route('marcas.create') }}" class="">
                                <div class="text">Nueva marca</div>
                            </a>
                        </li>
                        <li class="sub-menu-item">
                            <a href="{{ route('marcas.index') }}" class="">
                                <div class="text">Marcas</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-item has-children">
                    <a href="javascript:void(0);" class="menu-item-button">
                        <div class="icon"><i class="icon-file-plus"></i></div>
                        <div class="text">Order</div>
                    </a>
                    <ul class="sub-menu">
                        <li class="sub-menu-item">
                            <a href="orders.html" class="">
                                <div class="text">Orders</div>
                            </a>
                        </li>
                        <li class="sub-menu-item">
                            <a href="order-tracking.html" class="">
                                <div class="text">Order tracking</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="" class="">
                        <div class="icon"><i class="icon-image"></i></div>
                        <div class="text">PRODCTO TALLA</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="coupons.html" class="">
                        <div class="icon"><i class="icon-grid"></i></div>
                        <div class="text">Coupns</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="" class="">
                        <div class="icon"><i class="icon-user"></i></div>
                        <div class="text">User</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="settings.html" class="">
                        <div class="icon"><i class="icon-settings"></i></div>
                        <div class="text">Settings</div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>