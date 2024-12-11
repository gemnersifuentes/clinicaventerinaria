@extends('scoobydoo.layouts.main')
@section('content')

<section
class="relative bg-[url('resources/img/banner.png')] bg-cover bg-center bg-no-repeat"    
>
<!-- Limité el ancho máximo a 1200px y lo centré con margin: 0 auto -->
<div
    class="absolute inset-0 bg-gray-900/75 sm:bg-transparent sm:from-gray-900/95 sm:to-gray-900/25 ltr:sm:bg-gradient-to-r rtl:sm:bg-gradient-to-l">
</div>

<div class="relative mx-auto max-w-screen-xl px-4 py-32 sm:px-6 lg:flex lg:h-screen lg:items-center lg:px-8">
    <!-- Cambié py-32 a py-24 para reducir el padding vertical -->
    <div class="max-w-xl text-center ltr:sm:text-left rtl:sm:text-right">
        <h1 class="text-3xl font-extrabold text-white sm:text-5xl">
            Encuentra lo mejor
            <strong class="block font-extrabold text-blue-600"> Para tu mascota. </strong>
        </h1>

        <p class="mt-4 max-w-lg text-white sm:text-xl/relaxed">
        En nuestra clínica veterinaria, ofrecemos atención de calidad para asegurar el bienestar de tu fiel compañero. 
        </p>

        <div class="mt-8 flex flex-wrap gap-4 text-center">
            <a href="#"
                class="block w-full rounded bg-blue-600 px-12 py-3 text-sm font-medium text-white shadow hover:bg-purple-700 focus:outline-none focus:ring active:bg-purple-500 sm:w-auto">
                ver servicios
            </a>    

            <a href="#"
                class="block w-full rounded bg-white px-12 py-3 text-sm font-medium text-blue-600 shadow hover:text-purple-700 focus:outline-none focus:ring active:text-purple-500 sm:w-auto">
                productos
            </a>
        </div>
    </div>
</div>
</section>
<!-- Contenedor principal -->
<div class="flex flex-col md:flex-row items-center justify-between max-w-7xl mx-auto p-6">
<!-- Imagen del veterinario y las mascotas -->
<div class="flex justify-center mb-8 md:mb-0 md:w-1/2">
<img src="resources/img/infor.png" alt="Veterinario y mascotas" >
</div>

<!-- Sección de texto -->
<div class="md:w-1/2 text-center md:text-left">
<h2 class="text-4xl font-bold text-gray-800 mb-4">Acerca de nuestra <span class="text-blue-500">veterinaria & spa SCOOBYDOO</span></h2>
<p class="text-gray-600 mb-6">Tenemos como misión ofrecer servicios médicos veterinarios de óptima calidad, contando con amplia experiencia, un excelente trato personalizado y seguimiento de las necesidades de su mascota para prevenir infortunios y alargarles la vida.</p>
<a href="#" class="bg-blue-500 text-white font-semibold py-3 px-6 rounded-lg shadow hover:bg-blue-600 transition duration-300 ease-in-out">
ver más
</a>
</div>
</div>
<!-- Sección de Servicios -->
<section class="bg-gray-100 py-10">
<div class="max-w-7xl mx-auto text-center px-4 sm:px-6 lg:px-8">
<h2 class="text-3xl font-bold text-blu-500 mb-8">Nuestros equipo</h2>
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
    <div class="bg-white rounded-lg shadow-lg p-4">
        <img src="https://via.placeholder.com/150" alt="Servicio 1" class="w-full h-32 object-cover rounded-t-lg">
        <h3 class="text-lg font-semibold mt-2">DR. Dawin</h3>
        <p class="text-gray-600 mt-1"></p>
        <a href="#" class="mt-3 inline-block bg-blue-500 text-white py-2 px-4 rounded-lg">Más Info</a>
    </div>
    <div class="bg-white rounded-lg shadow-lg p-4">
        <img src="https://via.placeholder.com/150" alt="Servicio 2" class="w-full h-32 object-cover rounded-t-lg">
        <h3 class="text-lg font-semibold mt-2">Servicio 2</h3>
        <p class="text-gray-600 mt-1">Descripción breve del servicio 2.</p>
        <a href="#" class="mt-3 inline-block bg-purple-600 text-white py-2 px-4 rounded-lg">Más Info</a>
    </div>
    <div class="bg-white rounded-lg shadow-lg p-4">
        <img src="https://via.placeholder.com/150" alt="Servicio 3" class="w-full h-32 object-cover rounded-t-lg">
        <h3 class="text-lg font-semibold mt-2">Servicio 3</h3>
        <p class="text-gray-600 mt-1">Descripción breve del servicio 3.</p>
        <a href="#" class="mt-3 inline-block bg-purple-600 text-white py-2 px-4 rounded-lg">Más Info</a>
    </div>
    <div class="bg-white rounded-lg shadow-lg p-4">
        <img src="https://via.placeholder.com/150" alt="Servicio 4" class="w-full h-32 object-cover rounded-t-lg">
        <h3 class="text-lg font-semibold mt-2">Servicio 4</h3>
        <p class="text-gray-600 mt-1">Descripción breve del servicio 4.</p>
        <a href="#" class="mt-3 inline-block bg-purple-600 text-white py-2 px-4 rounded-lg">Más Info</a>
    </div>
</div>
</div>
</section>






<section class="px-4 py-24 mx-auto" style="margin-top: -50px; margin-bottom: 50px;">
<div class="max-w-2xl lg:max-w-4xl mx-auto text-center">
    <h2 class="text-3xl font-extrabold text-blue-500">galeria de fotos</h2>
    
</div>
</section>

</section>

<section style="margin-top: -90px; margin-bottom: 50px;">

<div x-data="{
imageGalleryOpened: false,
imageGalleryActiveUrl: null,
imageGalleryImageIndex: null,
imageGalleryOpen(event) {
    this.imageGalleryImageIndex = event.target.dataset.index;
    this.imageGalleryActiveUrl = event.target.src;
    this.imageGalleryOpened = true;
},
imageGalleryClose() {
    this.imageGalleryOpened = false;
    setTimeout(() => this.imageGalleryActiveUrl = null, 300);
},
imageGalleryNext(){
    if(this.imageGalleryImageIndex == this.$refs.gallery.childElementCount){
        this.imageGalleryImageIndex = 1;
    } else {
        this.imageGalleryImageIndex = parseInt(this.imageGalleryImageIndex) + 1;
    }
    this.imageGalleryActiveUrl = this.$refs.gallery.querySelector('[data-index=\'' + this.imageGalleryImageIndex + '\']').src;
},
imageGalleryPrev() {
    if(this.imageGalleryImageIndex == 1){
        this.imageGalleryImageIndex = this.$refs.gallery.childElementCount;
    } else {
        this.imageGalleryImageIndex = parseInt(this.imageGalleryImageIndex) - 1;
    }

    this.imageGalleryActiveUrl = this.$refs.gallery.querySelector('[data-index=\'' + this.imageGalleryImageIndex + '\']').src;
    
}
}" @image-gallery-next.window="imageGalleryNext()" @image-gallery-prev.window="imageGalleryPrev()" @keyup.right.window="imageGalleryNext();" @keyup.left.window="imageGalleryPrev();" x-init="
imageGalleryPhotos = $refs.gallery.querySelectorAll('img');
for(let i=0; i<imageGalleryPhotos.length; i++){
    imageGalleryPhotos[i].setAttribute('data-index', i+1);
}
" class="w-full h-full select-none">
<div class="max-w-6xl mx-auto duration-1000 delay-300 opacity-0 select-none ease animate-fade-in-view" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px, 0px);">
<ul x-ref="gallery" id="gallery" class="grid grid-cols-2 gap-5 lg:grid-cols-5">
<li><img x-on:click="imageGalleryOpen" src="./resources/img/fotos clinica/clinica14.jpg" class="object-cover select-none w-full h-auto bg-gray-200 rounded cursor-zoom-in aspect-[5/6] lg:aspect-[2/3] xl:aspect-[3/4]" alt="photo gallery image 01"></li>

<li><img x-on:click="imageGalleryOpen" src="./resources/img/clinica11.jpg" class="object-cover select-none w-full h-auto bg-gray-200 rounded cursor-zoom-in aspect-[5/6] lg:aspect-[2/3] xl:aspect-[3/4]" alt="photo gallery image 07"></li>
<li><img x-on:click="imageGalleryOpen" src="./resources/img/clinica3.jpg" class="object-cover select-none w-full h-auto bg-gray-200 rounded cursor-zoom-in aspect-[5/6] lg:aspect-[2/3] xl:aspect-[3/4]" alt="photo gallery image 08"></li>
<li><img x-on:click="imageGalleryOpen" src="./resources/img/clinica4.jpg" class="object-cover select-none w-full h-auto bg-gray-200 rounded cursor-zoom-in aspect-[5/6] lg:aspect-[2/3] xl:aspect-[3/4]" alt="photo gallery image 09"></li>
<li><img x-on:click="imageGalleryOpen" src="./resources/img/clinica5.jpg" class="object-cover select-none w-full h-auto bg-gray-200 rounded cursor-zoom-in aspect-[5/6] lg:aspect-[2/3] xl:aspect-[3/4]" alt="photo gallery image 10"></li>
<li><img x-on:click="imageGalleryOpen" src="./resources/img/clinica13.jpg" class="object-cover select-none w-full h-auto bg-gray-200 rounded cursor-zoom-in aspect-[5/6] lg:aspect-[2/3] xl:aspect-[3/4]" alt="photo gallery image 06"></li>
<li><img x-on:click="imageGalleryOpen" src="./resources/img/clinica6.jpg" class="object-cover select-none w-full h-auto bg-gray-200 rounded cursor-zoom-in aspect-[5/6] lg:aspect-[2/3] xl:aspect-[3/4]" alt="photo gallery image 07"></li>

<li><img x-on:click="imageGalleryOpen" src="./resources/img/clinica7.jpg" class="object-cover select-none w-full h-auto bg-gray-200 rounded cursor-zoom-in aspect-[5/6] lg:aspect-[2/3] xl:aspect-[3/4]" alt="photo gallery image 08"></li>
<li><img x-on:click="imageGalleryOpen" src="./resources/img/clinica16.jpg" class="object-cover select-none w-full h-auto bg-gray-200 rounded cursor-zoom-in aspect-[5/6] lg:aspect-[2/3] xl:aspect-[3/4]" alt="photo gallery image 09"></li>
<li><img x-on:click="imageGalleryOpen" src="./resources/img/clinica9.jpg" class="object-cover select-none w-full h-auto bg-gray-200 rounded cursor-zoom-in aspect-[5/6] lg:aspect-[2/3] xl:aspect-[3/4]" alt="photo gallery image 10"></li>
</ul>
</div>
<template x-teleport="body">
<div x-show="imageGalleryOpened" x-transition:enter="transition ease-in-out duration-300" x-transition:enter-start="opacity-0" x-transition:leave="transition ease-in-in duration-300" x-transition:leave-end="opacity-0" @click="imageGalleryClose" @keydown.window.escape="imageGalleryClose" x-trap.inert.noscroll="imageGalleryOpened" class="fixed inset-0 z-[99] flex items-center justify-center bg-black bg-opacity-50 select-none cursor-zoom-out" x-cloak>
<div class="relative flex items-center justify-center w-11/12 xl:w-4/5 h-11/12">
  <div @click="$event.stopPropagation(); $dispatch('image-gallery-prev')" class="absolute left-0 flex items-center justify-center text-white translate-x-10 rounded-full cursor-pointer xl:-translate-x-24 2xl:-translate-x-32 bg-white/10 w-14 h-14 hover:bg-white/20">
    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
    </svg>
  </div>
  <img x-show="imageGalleryOpened" x-transition:enter="transition ease-in-out duration-300" x-transition:enter-start="opacity-0 transform scale-50" x-transition:leave="transition ease-in-in duration-300" x-transition:leave-end="opacity-0 transform scale-50" class="object-contain object-center w-full h-full select-none cursor-zoom-out" :src="imageGalleryActiveUrl" alt="" style="display: none;">
  <div @click="$event.stopPropagation(); $dispatch('image-gallery-next');" class="absolute right-0 flex items-center justify-center text-white -translate-x-10 rounded-full cursor-pointer xl:translate-x-24 2xl:translate-x-32 bg-white/10 w-14 h-14 hover:bg-white/20">
    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
    </svg>
  </div>
</div>
</div>
</template>
</div>

</section>


<section class="" style="background-color: rgb(248, 248, 248);">
<div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:py-20 lg:px-8">
<div class="max-w-2xl lg:max-w-4xl mx-auto text-center">
    <h2 class="text-3xl font-extrabold text-blue-500">Visita Nuestra Clinica</h2>
    <p class="mt-4 text-lg text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
</div>
<div class="mt-16 lg:mt-20">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="rounded-lg overflow-hidden">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.2752678445677!2d-77.87373172597478!3d-6.22739256098596!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91b6ab713174f151%3A0xf0b8866a3c9fc953!2sCl%C3%ADnica%20Veterinaria%20%26%20Spa%20Scooby-Doo!5e0!3m2!1sen!2sus!4v1728354599550!5m2!1sen!2sus"
                width="100%" height="480" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div>
            <div class="max-w-full mx-auto rounded-lg overflow-hidden ">
                <div class="px-6 py-4">
                    <h3 class="text-lg font-medium text-blue-500">Nuestra Dirección</h3>
                    <p class="mt-1 text-gray-600">Jirón Dos de Mayo 308, Chachapoyas</p>
                </div>
                <div class="border-t border-gray-200 px-6 py-4">
                    <h3 class="text-lg font-medium text-blue-500">Horarios</h3>
                    <p class="mt-1 text-gray-600">  Lunes - Viernes: 8 am - 8 pm</p>
                    <p class="mt-1 text-gray-600">Sábado: 8 a.m. - 5 p.m.</p>
                    <p class="mt-1 text-gray-600">Domingo: 8 a.m. - 1 p.m.</p>
                </div>
              




                <div class="border-t border-gray-200 px-6 py-4">
                    <h3 class="text-lg font-medium text-blue-500">Contacto</h3>
                    <p class="mt-1 text-gray-600">Email: scoobydoo@gmail.com</p>
                    <p class="mt-1 text-gray-600">Phone: +51 930 766 011</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</section>
     
@endsection