<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        {{-- ajax --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        
        {{-- tailwind --}}
        <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.4/dist/flowbite.min.css" />
        
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            @import url('https://fonts.googleapis.com/css?family=Orbitron');
       </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            @include('layouts.footer')
        </div>
    </body>
    <script src="https://unpkg.com/flowbite@1.5.4/dist/flowbite.js"></script>
    <script>
        // for search 
        $('#search').click(function(){
            if($('#time').val() == 'morning'){
                $('#status').attr("name", "status_clockin");
            }else{
                $('#status').attr("name", "status_clockout");
            }
        });
    </script>

    <script type="text/javascript">
        function currentTime() {
            var date = new Date(); /* creating object of Date class */
            var hour = date.getHours();
            var min = date.getMinutes();
            var sec = date.getSeconds();
            hour = updateTime(hour);
            min = updateTime(min);
            sec = updateTime(sec);
            var yy = date.getFullYear();
            var mm = date.getMonth()+1;
            var dd = date.getDate();
            var d = new Date();
            var weekday = new Array(7);
            weekday[0] = "Sunday";
            weekday[1] = "Monday";
            weekday[2] = "Tuesday";
            weekday[3] = "Wednesday";
            weekday[4] = "Thursday";
            weekday[5] = "Friday";
            weekday[6] = "Saturday";
            var n = weekday[d.getDay()];
            document.getElementById("clock1").innerText = n + " , " + dd + " " + mm + " " + yy; /* adding time to the div */
            document.getElementById("clock2").innerText = hour + " : " + min + " : " + sec; /* adding time to the div */
            document.getElementById("clock3").innerText = n + " , " + dd + " " + mm + " " + yy; /* adding time to the div */
            document.getElementById("clock4").innerText = hour + " : " + min + " : " + sec; /* adding time to the div */
            var t = setTimeout(function(){ currentTime() }, 1000); /* setting timer */
        }
        function updateTime(k) {
            if (k < 10) {
            return "0" + k;
            }
            else {
            return k;
            }
        }
        currentTime(); /* calling currentTime() function to initiate the process */
    </script>
</html>
