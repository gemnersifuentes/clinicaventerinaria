@extends('admin.layouts.main')

@section('content')
<div class="main-content-wrap">
    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
        <h3>Registro de Subcategorías</h3>
        <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
            <li>
                <a href="#">
                    <div class="text-tiny">Dashboard</div>
                </a>
            </li>
            <li>
                <i class="icon-chevron-right"></i>
            </li>
            <li>
                <a href="#">
                    <div class="text-tiny">Subcategorías</div>
                </a>
            </li>
        </ul>
    </div>

    <div class="wg-box">
        <div class="flex items-center justify-between gap10 flex-wrap">
            <div class="wg-filter flex-grow">
                <form class="form-search">
                    <fieldset class="name">
                        <input type="text" placeholder="Buscar aquí..." name="name"
                               tabindex="2" value="" aria-required="true" required="">
                    </fieldset>
                    <div class="button-submit">
                        <button class="" type="submit"><i class="icon-search"></i></button>
                    </div>
                </form>
            </div>
            <a class="tf-button style-1 w208" href="{{ route('subcategories.create') }}"><i
                    class="icon-plus"></i>Nuevo</a>
        </div>

        <div class="wg-table table-all-user">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Categoría</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subcategories as $subcategory)
                        <tr>
                            <td>{{ $subcategory->id }}</td>
                            <td>{{ $subcategory->name }}</td>
                            <td>{{ $subcategory->description }}</td>
                            <td>{{ $subcategory->category->name }}</td>
                            <td>
                                <a href="{{ route('subcategories.edit', $subcategory->id) }}" class="btn btn-warning">Editar</a>
                                <!-- Botón Eliminar -->
                                <button type="button" class="btn btn-danger" onclick="openModal('{{ $subcategory->id }}')">Eliminar</button>

                                <!-- Modal -->
                                <div class="custom-modal" id="deleteModal{{ $subcategory->id }}">
                                    <div class="custom-modal-content">
                                        <div class="custom-modal-header">
                                            <h5>Confirmar Eliminación</h5>
                                            <button type="button" class="custom-modal-close" onclick="closeModal('{{ $subcategory->id }}')">&times;</button>
                                        </div>
                                        <div class="custom-modal-body">
                                            ¿Está seguro de que desea eliminar la subcategoría "{{ $subcategory->name }}"?
                                        </div>
                                        <div class="custom-modal-footer">
                                            <button type="button" class="btn btn-secondary" onclick="closeModal('{{ $subcategory->id }}')">Cancelar</button>
                                            <form action="{{ route('subcategories.destroy', $subcategory->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Sí, eliminar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Estilos del Modal -->
                                <style>
                                    .custom-modal {
                                        display: none;
                                        position: fixed;
                                        top: 0;
                                        left: 0;
                                        width: 100%;
                                        height: 100%;
                                        background: rgba(0, 0, 0, 0.5);
                                        z-index: 1000;
                                        transition: opacity 0.3s ease;
                                    }

                                    .custom-modal-content {
                                        position: absolute;
                                        top: 50%;
                                        left: 50%;
                                        transform: translate(-50%, -50%);
                                        background: #fff;
                                        padding: 20px;
                                        border-radius: 8px;
                                        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
                                        width: 90%;
                                        max-width: 400px;
                                    }

                                    .custom-modal-header {
                                        display: flex;
                                        justify-content: space-between;
                                        align-items: center;
                                        border-bottom: 1px solid #ddd;
                                        margin-bottom: 10px;
                                    }

                                    .custom-modal-header h5 {
                                        margin: 0;
                                    }

                                    .custom-modal-close {
                                        background: none;
                                        border: none;
                                        font-size: 1.5rem;
                                        color: #555;
                                        cursor: pointer;
                                    }

                                    .custom-modal-body {
                                        font-size: 1rem;
                                        color: #333;
                                        margin-bottom: 20px;
                                    }

                                    .custom-modal-footer {
                                        display: flex;
                                        justify-content: flex-end;
                                        gap: 10px;
                                    }
                                </style>

                                <!-- Scripts del Modal -->
                                <script>
                                    function openModal(id) {
                                        const modal = document.getElementById('deleteModal' + id);
                                        modal.style.display = 'block';
                                        setTimeout(() => {
                                            modal.style.opacity = '1';
                                        }, 10);
                                    }

                                    function closeModal(id) {
                                        const modal = document.getElementById('deleteModal' + id);
                                        modal.style.opacity = '0';
                                        setTimeout(() => {
                                            modal.style.display = 'none';
                                        }, 300);
                                    }

                                    window.addEventListener('click', function (event) {
                                        const modals = document.querySelectorAll('.custom-modal');
                                        modals.forEach(modal => {
                                            if (event.target === modal) {
                                                modal.style.opacity = '0';
                                                setTimeout(() => {
                                                    modal.style.display = 'none';
                                                }, 300);
                                            }
                                        });
                                    });
                                </script>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="pagination-wrapper">
            <div class="pagination-info">
                Mostrando la página {{ $subcategories->currentPage() }} de {{ $subcategories->lastPage() }}
            </div>

            <div class="pagination-container">
                <ul class="pagination">
                    <li class="page-item @if ($subcategories->onFirstPage()) disabled @endif">
                        <a class="page-link" href="{{ $subcategories->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo; Anterior</span>
                        </a>
                    </li>

                    @php
                        $currentPage = $subcategories->currentPage();
                        $totalPages = $subcategories->lastPage();
                        $start = max(1, $currentPage - 1);
                        $end = min($totalPages, $currentPage + 1);
                    @endphp

                    @for ($i = $start; $i <= $end; $i++)
                        <li class="page-item @if ($subcategories->currentPage() == $i) active @endif">
                            <a class="page-link" href="{{ $subcategories->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    <li class="page-item @if ($subcategories->hasMorePages()) @else disabled @endif">
                        <a class="page-link" href="{{ $subcategories->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true">Siguiente &raquo;</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        
        <style>
            .pagination-wrapper {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: 0px;
            }

            .pagination-info {
                font-size: 14px;
                color: #555;
            }

            .pagination-container {
                display: flex;
                justify-content: flex-end;
            }

            .pagination {
                display: flex;
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .page-item {
                margin: 0 5px;
            }

            .page-item a {
                color: #007bff;
                text-decoration: none;
                padding: 8px 16px;
                border-radius: 5px;
            }

            .page-item.active a {
                background-color: #007bff;
                color: white;
            }

            .page-item.disabled span {
                color: #ddd;
            }

            .page-item a:hover {
                background-color: #f8f9fa;
            }
        </style>

    </div>
</div>
<style>
    /* Estilo de la barra de desplazamiento */
::-webkit-scrollbar {
    width: 10px; /* Ancho de la barra */
    height: 10px; /* Alto para barras horizontales */
}

/* Fondo de la barra de desplazamiento */
::-webkit-scrollbar-track {
    background: #f0f0f0; /* Color del fondo de la barra */
    border-radius: 5px; /* Bordes redondeados */
}

/* Color del deslizador (scroll thumb) */
::-webkit-scrollbar-thumb {
    background: #e6e6e6; /* Color del deslizador */
    border-radius: 5px; /* Bordes redondeados */
}

/* Color del deslizador al pasar el mouse por encima */
::-webkit-scrollbar-thumb:hover {
    background: #d1d1d1; /* Color más oscuro en hover */
}

/* Opcional: color del borde del deslizador */
::-webkit-scrollbar-thumb:active {
    background: #bdbdbd; /* Color al hacer clic */
}

/* Estilo para navegadores que no usan WebKit */


</style>
@if(session('success'))
    <div class="alert alert-success" id="successMessage">
        {{ session('success') }}
    </div>
@endif

<style>
    #successMessage {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 9999;
        display: none;
    }
</style>

<script>
    if (document.getElementById('successMessage')) {
        document.getElementById('successMessage').style.display = 'block';
        setTimeout(function () {
            document.getElementById('successMessage').style.display = 'none';
        }, 3000);
    }
</script>

@endsection
