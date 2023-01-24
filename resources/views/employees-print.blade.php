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
        <h2 class="mt-5 text-center text-bg font-bold">EMPLOYEES</h2>
        <center>
            <div class="bg-black border-2 w-full"></div>
            <div class="flex flex-col">
                <div class="sm:-mx-6 lg:-mx-8">
                    <div class="py-2 inline-block sm:px-2 lg:px-8">
                        <div class="overflow-hidden">
                            <table class="border">
                            <thead class="border-b text-center">
                                <tr>
                                <th scope="col" class="text-xs font-semibold text-black px-2 py-2 border-r"> No </th>
                                <th scope="col" class="text-xs font-semibold text-black px-2 py-2 border-r"> Name </th>
                                <th scope="col" class="text-xs font-semibold text-black px-2 py-2 border-r"> Email </th>
                                <th scope="col" class="text-xs font-semibold text-black px-2 py-2 border-r"> Gender </th>
                                <th scope="col" class="text-xs font-semibold text-black px-2 py-2 border-r"> Phone </th>
                                <th scope="col" class="text-xs font-semibold text-black px-2 py-2 border-r"> Address </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $counter=0 @endphp
                                @foreach ($employees as $employee)
                                <tr class="border-b">
                                <td class="px-2 py-2 whitespace-nowrap text-xs font-medium text-gray-900 border-r text-center">
                                    {{ ++$counter }}
                                </td>
                                <td class="text-xs text-gray-900 font-light px-2 py-2 whitespace-nowrap border-r">
                                    {{ $employee->name }}
                                </td>
                                <td class="text-xs text-gray-900 font-light px-2 py-2 whitespace-nowrap border-r">
                                    {{ $employee->email }}
                                </td>
                                <td class="text-xs text-gray-900 font-light px-2 py-2 whitespace-nowrap border-r text-center">
                                    @if($employee->gender == "male") M @else F @endif
                                </td>
                                <td class="text-xs text-gray-900 font-light px-2 py-2 whitespace-nowrap border-r">
                                    {{ $employee->phone }}
                                </td>
                                <td class="text-xs text-gray-900 font-light px-2 py-2 whitespace-nowrap border-r">
                                    {{ $employee->address }}
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