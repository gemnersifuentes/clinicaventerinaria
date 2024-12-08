@extends('admin.layouts.main')
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
@section('content')
<div class="main-content-wrap">
    <div class="flex items-center flex-wrap justify-between gap20 mb-27">
        <h3>Nueva Subcategoría</h3>
        <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
            <li>
                <a href="">
                    <div class="text-tiny">Dashboard</div>
                </a>
            </li>
            <li>
                <i class="icon-chevron-right"></i>
            </li>
            <li>
                <a href="{{ route('subcategories.index') }}">
                    <div class="text-tiny">Subcategorías</div>
                </a>
            </li>
            <li>
                <i class="icon-chevron-right">Nuevo</i>
            </li>
        </ul>
    </div>
    <!-- new-subcategory -->
</div>
<div class="wg-box">
    <form class="form-new-product form-style-1" action="{{ route('subcategories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <fieldset class="name">
            <div class="body-title">Nombre de la Subcategoría <span class="tf-color-1">*</span></div>
            <input class="flex-grow" type="text" placeholder="Nombre de la subcategoría" name="name" tabindex="0" value="{{ old('name') }}" aria-required="true" required>
        </fieldset>

        <fieldset class="description">
            <div class="body-title">Descripción</div>
            <textarea class="flex-grow" placeholder="Descripción de la subcategoría" name="description">{{ old('description') }}</textarea>
        </fieldset>

        <fieldset class="category">
            <div class="body-title">Categoría Principal <span class="tf-color-1">*</span></div>
            <select class="flex-grow" name="category_id" required>
                <option value="" disabled selected>Selecciona una categoría</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </fieldset>

        <div class="bot">
            <button class="tf-button w208" type="submit">Guardar</button>
        </div>
    </form>
</div>

@endsection
