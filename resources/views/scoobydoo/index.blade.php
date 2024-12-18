@extends('scoobydoo.layouts.main')
@section('content')
 

    <section
    class="relative bg-[url('{{ asset('assets/img/banner.png') }}')] bg-cover bg-center bg-no-repeat">
       
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
      <img src="{{ asset('img/banner.png') }}" alt="Veterinario y mascotas" >
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



  


  
  <section class="flex justify-between mb-10  mx-auto w[100%] max-w-screen-lg" style="margin-top: 50px">
    <!-- Left Section -->
    <div class="flex items-center w-1/2">
        <img src="{{ asset('assets/img/bear.png') }}" alt="Dog" class="w-2/6 rounded-lg">
        <div class="mt-6 ml-10 w-3/5 mr-2">
            <h2 class="text-2xl font-bold text-gray-800">Conoce a nuestras profesionales</h2>
            <p class="mt-4 text-gray-600" style="font-size: 12px;">Contamos con un equipo calificado con experiencia
                para tomar
                cuida a tu mejor amigo</p>
            <a href="#"
                class="mt-6 inline-block bg-red-500 text-white px-4 py-2 rounded-full font-semibold border-2 border-red-500 hover:bg-transparent hover:text-red-500 relative overflow-hidden group"
                style="font-size: 13px;">
                VIEW ALL TEAM

            </a>

        </div>
    </div>



    <div class="w-1/2 relative mt-6">
        <!-- Contenedor principal para el carrusel -->
        <div class="relative max-w-md overflow-visible">
            <!-- Contenedor de las imágenes y perfiles -->
            <div id="carousel" class="relative">
                <!-- Slide 1 -->
                <div class="carousel-item active">
                   
                    <div class="relative max-w-md overflow-visible ">
                        <!-- Main image -->
                        <img src="{{ asset('assets/img/doc.png') }}" alt="Veterinary Assistant with dog "
                            class=" object-cover w-[90%] rounded-[20px] ">
        
                        <!-- Profile info card -->
                        <div class="absolute -bottom-20 -right-1 w-[70%] rounded-[20px] bg-[#CCEBEF] p-4 shadow-lg">
                            <h2 class="mb-1 text-2xl font-bold text-gray-800 text-left">
                                Jacqueline
                            </h2>
                            <p class="mb-3 text-sm text-gray-500 text-left">
                                Veterinary Assistant
                            </p>
        
                            <p class="mb-4 text-xs text-gray-600">
                                Scelerisque laoreet nibh hendrerit id. In aliquet magna nec labortis maximus. Donec commodo
                                sodales ex, nec elementum ipsum convali.
                            </p>
        
                            <!-- Social media links -->
                            <div class="flex gap-2">
                                <!-- Facebook -->
                                <a href="#" class="rounded-md bg-[#1877F2] p-1.5 text-white hover:bg-[#1877F2]/80">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-facebook">
                                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                                    </svg>
                                </a>
                                <!-- Twitter -->
                                <a href="#" class="rounded-md bg-[#1DA1F2] p-1.5 text-white hover:bg-[#1DA1F2]/80">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-twitter">
                                        <path
                                            d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z" />
                                    </svg>
                                </a>
                                <!-- Instagram -->
                                <a href="#" class="rounded-md bg-[#E4405F] p-1.5 text-white hover:bg-[#E4405F]/80">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-instagram">
                                        <rect width="20" height="20" x="2" y="2" rx="5" ry="5" />
                                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                                        <line x1="17.5" x2="17.51" y1="6.5" y2="6.5" />
                                    </svg>
                                </a>
                            </div>
        
                        </div>
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="carousel-item hidden">
                    <div class="relative max-w-md overflow-visible ">
                        <!-- Main image -->
                        <img src="{{ asset('assets/img/doc.png') }}" alt="Veterinary Assistant with dog "
                            class=" object-cover w-[90%] rounded-[20px] ">
        
                        <!-- Profile info card -->
                        <div class="absolute -bottom-20 -right-1 w-[70%] rounded-[20px] bg-[#CCEBEF] p-4 shadow-lg">
                            <h2 class="mb-1 text-2xl font-bold text-gray-800 text-left">
                                Jacqueline
                            </h2>
                            <p class="mb-3 text-sm text-gray-500 text-left">
                                Veterinary Assistant
                            </p>
        
                            <p class="mb-4 text-xs text-gray-600">
                                Scelerisque laoreet nibh hendrerit id. In aliquet magna nec labortis maximus. Donec commodo
                                sodales ex, nec elementum ipsum convali.
                            </p>
        
                            <!-- Social media links -->
                            <div class="flex gap-2">
                                <!-- Facebook -->
                                <a href="#" class="rounded-md bg-[#1877F2] p-1.5 text-white hover:bg-[#1877F2]/80">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-facebook">
                                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                                    </svg>
                                </a>
                                <!-- Twitter -->
                                <a href="#" class="rounded-md bg-[#1DA1F2] p-1.5 text-white hover:bg-[#1DA1F2]/80">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-twitter">
                                        <path
                                            d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z" />
                                    </svg>
                                </a>
                                <!-- Instagram -->
                                <a href="#" class="rounded-md bg-[#E4405F] p-1.5 text-white hover:bg-[#E4405F]/80">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-instagram">
                                        <rect width="20" height="20" x="2" y="2" rx="5" ry="5" />
                                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                                        <line x1="17.5" x2="17.51" y1="6.5" y2="6.5" />
                                    </svg>
                                </a>
                            </div>
        
                        </div>
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="carousel-item hidden">
                    <div class="relative max-w-md overflow-visible ">
                        <!-- Main image -->
                        <img src="{{ asset('assets/img/doc.png') }}" alt="Veterinary Assistant with dog "
                            class=" object-cover w-[90%] rounded-[20px] ">
        
                        <!-- Profile info card -->
                        <div class="absolute -bottom-20 -right-1 w-[70%] rounded-[20px] bg-[#CCEBEF] p-4 shadow-lg">
                            <h2 class="mb-1 text-2xl font-bold text-gray-800 text-left">
                                Jacqueline
                            </h2>
                            <p class="mb-3 text-sm text-gray-500 text-left">
                                Veterinary Assistant
                            </p>
        
                            <p class="mb-4 text-xs text-gray-600">
                                Scelerisque laoreet nibh hendrerit id. In aliquet magna nec labortis maximus. Donec commodo
                                sodales ex, nec elementum ipsum convali.
                            </p>
        
                            <!-- Social media links -->
                            <div class="flex gap-2">
                                <!-- Facebook -->
                                <a href="#" class="rounded-md bg-[#1877F2] p-1.5 text-white hover:bg-[#1877F2]/80">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-facebook">
                                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                                    </svg>
                                </a>
                                <!-- Twitter -->
                                <a href="#" class="rounded-md bg-[#1DA1F2] p-1.5 text-white hover:bg-[#1DA1F2]/80">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-twitter">
                                        <path
                                            d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z" />
                                    </svg>
                                </a>
                                <!-- Instagram -->
                                <a href="#" class="rounded-md bg-[#E4405F] p-1.5 text-white hover:bg-[#E4405F]/80">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-instagram">
                                        <rect width="20" height="20" x="2" y="2" rx="5" ry="5" />
                                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                                        <line x1="17.5" x2="17.51" y1="6.5" y2="6.5" />
                                    </svg>
                                </a>
                            </div>
        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        let currentIndex = 0;
        const slides = document.querySelectorAll('.carousel-item');
    
        function showSlide(index) {
            slides.forEach((slide, i) => {
                if (i === index) {
                    slide.classList.remove('hidden');
                    slide.classList.add('active', 'fade-in');
                } else {
                    slide.classList.add('hidden');
                    slide.classList.remove('active', 'fade-in');
                }
            });
        }
    
        function nextSlide() {
            currentIndex = (currentIndex + 1) % slides.length;
            showSlide(currentIndex);
        }
    
        setInterval(nextSlide, 5000); // Cambia de slide cada 5 segundos
    </script>
    
    <style>
        .fade-in {
            animation: fadeIn 2s;
            transition: opacity 2s ease-in-out;
        }
    
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    
       
    </style>
    





</section>

<div class="container mx-auto max-w-6xl mt-60">
    <!-- Header Section -->
    <div class=" text-center">
        <h1 class="mb-4 text-3xl font-bold text-gray-900">Looking & Smelling Great</h1>
        <p class="mx-auto max-w-2xl text-gray-600">
            Pellentesque maximus augue orci, quis congue purus iaculison id. Maecenas eu lorem quisesdoi massal
            molestie vulputate in sitagi amet dram. Cras eu odio sit amet.
        </p>
    </div>

    <div class="flex justify-center items-center   mb-10 ">

        <!-- Div 1 -->
        <div class="flex flex-col items-center mx-2 rounded-lg ">
            <img src="C:\Users\HP\Downloads\gallery-1.png" alt="Imagen 1"
                class="w-48 h-48 rounded-lg object-cover mb-4">
            <img src="https://via.placeholder.com/300" alt="Imagen 2" class="w-48 h-48 rounded-lg object-cover">
        </div>
        <!-- Div 2 -->
        <div class="flex flex-col items-center mx-2 mt-16">
            <img src="https://via.placeholder.com/300" alt="Imagen 1"
                class="w-48 h-48 rounded-lg object-cover mb-4">
            <img src="https://via.placeholder.com/300" alt="Imagen 2" class="w-48 h-48 rounded-lg object-cover">
        </div>
        <!-- Div 3 -->
        <div class="flex flex-col items-center mx-2 mt-36">
            <img src="https://via.placeholder.com/300" alt="Imagen 1"
                class="w-48 h-48 rounded-lg object-cover mb-4">
            <img src="https://via.placeholder.com/300" alt="Imagen 2" class="w-48 h-48 rounded-lg object-cover">
        </div>
        <!-- Div 4 -->
        <div class="flex flex-col items-center mx-2 mt-16">
            <img src="https://via.placeholder.com/300" alt="Imagen 1"
                class="w-48 h-48 rounded-lg object-cover mb-4">
            <img src="https://via.placeholder.com/300" alt="Imagen 2" class="w-48 h-48 rounded-lg object-cover">
        </div>
        <!-- Div 5 -->
        <div class="flex flex-col items-center mx-2">
            <img src="https://via.placeholder.com/300" alt="Imagen 1"
                class="w-48 h-48 rounded-lg object-cover mb-4">
            <img src="https://via.placeholder.com/300" alt="Imagen 2" class="w-48 h-48 rounded-lg object-cover">
        </div>
    </div>
</div>


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