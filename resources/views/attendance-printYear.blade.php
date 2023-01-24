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
<body>
    <div class="p-12">
        <h1 class="text-center text-bg font-bold">PT. VODJO TEKNOLOGI INDONESIA</h1>
        <h3 class="text-center text-sm font-bold">Graha Pos Indonesia, Lantai 2, Blok C Jl. Banda 30, Bandung 40115, Indonesia</h3>

        <h2 class="mt-5 text-center text-bg font-bold">{{ strtoupper(Auth::user()->name) }}'S REPORTS THIS YEAR</h2>
        <center>
            <div class="bg-black border-2 w-full"></div>
                <div class="mt-2">
                    <h3 class="text-left text-sm font-semibold">Date :
                        {{ $attendance->startdate->date }}
                          - 
                         {{ $attendance->enddate->date }}
                     </h3>
                    <h2 class="text-left text-sm font-semibold">Morning Report Present : {{ $attendance->presentclockin }}</h2>
                    <h2 class="text-left text-sm font-semibold">Morning Report Absence : {{ $attendance->absenceclockin }}</h2>
                    <h2 class="text-left text-sm font-semibold">Afternoon Report Present : {{ $attendance->presentclockout }}</h2>
                    <h2 class="text-left text-sm font-semibold">Afternoon Report Absence : {{ $attendance->absenceclockout }}</h2>
                </div>
            <div class="flex flex-col">
                <div class="sm:-mx-6 lg:-mx-8">
                    <div class="py-2 inline-block sm:px-2 lg:px-8">
                        <div class="overflow-hidden">
                            <table class="border">
                            <thead class="border-b text-center">
                                <tr>
                                <th scope="col" class="text-xs font-semibold text-black px-2 py-2 border-r"> Date </th>
                                <th scope="col" class="text-xs font-semibold text-black px-2 py-2 border-r"> Morning </th>
                                <th scope="col" class="text-xs font-semibold text-black px-2 py-2 border-r"> M.Report </th>
                                <th scope="col" class="text-xs font-semibold text-black px-2 py-2 border-r"> Afternoon </th>
                                <th scope="col" class="text-xs font-semibold text-black px-2 py-2 border-r"> A.Report </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendance as $arr)
                                <tr class="border-b">
                                <td class="text-xs text-gray-900 font-light px-2 py-2 whitespace-nowrap border-r">
                                    {{ $arr->date }}
                                </td>
                                <td class="text-xs text-gray-900 font-light px-2 py-2 whitespace-nowrap border-r">
                                    @if( $arr->status_clockin == 'present')
                                    <span class="bg-green-200 text-green-700 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:text-green-800"> {{ $arr->clockin }}(Present) </span>
                                    @elseif($arr->status_clockin == 'absence')
                                    <span class="bg-red-200 textred-700 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:text-red-800"> {{ $arr->clockin }}(Absence) </span>
                                    @endif
                                </td>
                                <td class="text-xs text-gray-900 font-light px-2 py-2 whitespace-nowrap border-r">
                                    {{ $arr->desc_clockin }}
                                </td>
                                <td class="text-xs text-gray-900 font-light px-2 py-2 whitespace-nowrap border-r">
                                    @if( $arr->status_clockout == 'present')
                                    <span class="bg-green-200 text-green-700 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:text-green-800"> {{ $arr->clockout }}(Present) </span>
                                    @elseif($arr->status_clockout == 'absence')
                                    <span class="bg-red-200 textred-700 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:text-red-800"> {{ $arr->clockout }}(Absence) </span>
                                    @endif
                                </td>
                                <td class="text-xs text-gray-900 font-light px-2 py-2 whitespace-nowrap border-r">
                                    {{ $arr->desc_clockout }}
                                </td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </center>
    </div>
</body>
{{-- <script>
    window.print();
</script> --}}
</html>