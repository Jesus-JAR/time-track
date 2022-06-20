<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Time Track</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <!-- Alpine js -->
    <script src="https://unpkg.com/tailwindcss-jit-cdn"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="flex max-h-screen-screen w-screen justify-between">
        <div class="px-4 pl-2 m-2">
            <x-component-logo width="w-20"/>
        </div>

        <div class="flex justify-around pt-4 mr-6 md:mr-12">
            <div class="">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="text-2xl text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-2xl text-gray-700 dark:text-gray-500 underline">Log
                            in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="ml-4 text-2xl text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
            </div>
            @endif
        </div>
    </div>
</div>
<div class="flex justify-center pt-20">
    <div class=" mx-4 px-6 py-2 m-2 hidden md:block">
        <div x-data="carousel()" class="relative">
            <img
                class="w-full object-cover object-center"
                :src="images[selected]"
                alt="mountains"
            />

            <button @click="if (selected > 0 ) {selected -= 1} else { selected = images.length - 1 }"
                    class="absolute inset-y-0 left-0 x-2 py-[2%] h-64 w-16 group hover:bg-ochre-500 hover:bg-opacity-75 cursor-pointer">
                <span class="hidden group-hover:block text-gray-50">
          &larr;
        </span>
            </button>
            <button
                @click="if (selected < images.length - 1  ) {selected += 1} else { selected = 0 }"
                class="absolute inset-y-0 right-0 px-2 py-[2%] h-64 w-16 group hover:bg-sea-500 hover:bg-opacity-75 cursor-pointer">
        <span class="hidden group-hover:block text-gray-50">
          &rarr;
        </span>
            </button>

            <div class="absolute bottom-0 w-full p-4 flex justify-center space-x-2">
                <template x-for="(image,index) in images" :key="index">
                    <button
                        @click="selected = index"
                        :class="{'bg-gray-300': selected == index, 'bg-gray-500': selected != index}"
                        class="h-2 w-2 rounded-full hover:bg-gray-300 ring-2 ring-gray-300"
                    ></button>
                </template>
            </div>
        </div>
    </div>

    <div class=" mx-4 px-6 py-2 m-2 md:hidden">
        <div x-data="carousel2()" class="relative">
            <img
                class="w-full object-cover object-center"
                :src="images[selected]"
                alt="mountains"
            />

            <button @click="if (selected > 0 ) {selected -= 1} else { selected = images.length - 1 }"
                    class="absolute inset-y-0 left-0 x-2 py-[2%] h-64 w-16 group hover:bg-ochre-500 hover:bg-opacity-75 cursor-pointer">
                <span class="hidden group-hover:block text-gray-50">
          &larr;
        </span>
            </button>
            <button
                @click="if (selected < images.length - 1  ) {selected += 1} else { selected = 0 }"
                class="absolute inset-y-0 right-0 px-2 py-[2%] h-64 w-16 group hover:bg-sea-500 hover:bg-opacity-75 cursor-pointer">
        <span class="hidden group-hover:block text-gray-50">
          &rarr;
        </span>
            </button>

            <div class="absolute bottom-0 w-full p-4 flex justify-center space-x-2">
                <template x-for="(image,index) in images" :key="index">
                    <button
                        @click="selected = index"
                        :class="{'bg-gray-300': selected == index, 'bg-gray-500': selected != index}"
                        class="h-2 w-2 rounded-full hover:bg-gray-300 ring-2 ring-gray-300"
                    ></button>
                </template>
            </div>
        </div>
    </div>
</div>

<script>
    const carousel = () => {
        return {
            selected: 0,
            images: [
                "{{ asset('welcome/table_records_web.png') }}",
                "{{ asset('welcome/pdf.png') }}",
                "{{ asset('welcome/check_in..png') }}",
            ],

        };
    };

    const carousel2 = () => {
        return {
            selected: 0,
            images: [
                "{{ asset('welcome_mobile/record_web_table_mobile.png')}}",
                "{{ asset('welcome_mobile/pdf.png')}}",
                "{{ asset('welcome_mobile/check_in..png') }}",
            ],

        };
    };
</script>

</body>
</html>
