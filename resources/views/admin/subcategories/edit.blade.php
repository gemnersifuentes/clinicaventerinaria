@extends('admin.layouts.main')

@section('content')

<div class="wg-box">
    <form class="form-new-product form-style-1" action="{{ route('subcategories.update', $subcategory->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Usamos el método PUT para actualizar -->

        <fieldset class="name">
            <div class="body-title">Subcategory Name <span class="tf-color-1">*</span></div>
            <input class="flex-grow" type="text" placeholder="Subcategory name" name="name" value="{{ old('name', $subcategory->name) }}" tabindex="0" aria-required="true" required>
        </fieldset>

        <fieldset class="description">
            <div class="body-title">Description</div>
            <textarea class="flex-grow" placeholder="Subcategory description" name="description">{{ old('description', $subcategory->description) }}</textarea>
        </fieldset>

        <fieldset class="category">
            <div class="body-title">Category <span class="tf-color-1">*</span></div>
            <select class="flex-grow" name="category_id" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" 
                        {{ $subcategory->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </fieldset>

        <div class="bot">
            <div></div>
            <button class="tf-button w208" type="submit">Update</button>
        </div>
    </form>
</div>
<style>
    /* Estilo de la barra de desplazamiento */
::-webkit-scrollbar {
    width: 0px; /* Ancho de la barra */
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
@endsection
