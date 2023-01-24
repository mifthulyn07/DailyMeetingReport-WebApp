<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daily Meeting Report') }}
        </h2>
    </x-slot>

    <!-- Session Status -->
    <x-success-status :status="session('success')" />
    <x-error-status :status="session('error')" />

    <!-- Validation Errors -->
    <x-validation-errors :messages="$errors->first()" />
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="w-full bg-white border rounded-lg shadow-md">
                <div class="sm:hidden">
                    <label for="tabs" class="sr-only">Select tab</label>
                    <select id="tabs" class="bg-blue-100 border-0 border-b border-gray-200 text-gray-900 text-sm rounded-t-lg focus:ring-gray-800 focus:border-gray-800 block w-full p-2.5 ">
                        <option>Morning Report</option>Morning
                        <option>Afternoon Report</option>
                        <option>History</option>
                    </select>
                </div>
                <ul class="hidden text-sm font-medium text-center text-gray-900 divide-x divide-gray-200 rounded-lg sm:flex" id="fullWidthTab" data-tabs-toggle="#fullWidthTabContent" role="tablist">
                    <li class="w-full">
                        <button id="MorningReport-tab" data-tabs-target="#MorningReport" type="button" role="tab" aria-controls="MorningReport" aria-selected="true" class="inline-block w-full p-4 rounded-tl-lg bg-blue-60 hover:bg-blue-100 focus:outline-none">Morning Report</button>
                    </li>
                    <li class="w-full">
                        <button id="AfternoonReport-tab" data-tabs-target="#AfternoonReport" type="button" role="tab" aria-controls="AfternoonReport" aria-selected="false" class="inline-block w-full p-4 bg-blue-60 hover:bg-blue-100 focus:outline-none">Afternoon Report</button>
                    </li>
                    <li class="w-full">
                        <button id="History-tab" data-tabs-target="#History" type="button" role="tab" aria-controls="History" aria-selected="false" class="inline-block w-full p-4 rounded-tr-lg bg-blue-60 hover:bg-blue-100 focus:outline-none">History</button>
                    </li>
                </ul>
                <div id="fullWidthTabContent" class="border-t border-gray-200">
                    <div class="hidden p-4 bg-white rounded-lg md:p-8" id="MorningReport" role="tabpanel" aria-labelledby="MorningReport-tab">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3 max-w-lg p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                                <div id="clock1" onclick="currentTime()" class="text-white"></div>
                                <div id="clock2" onclick="currentTime()" class="text-white text-2xl"></div>
                                <form action="{{ route('attendance.clockin') }}" method="POST">
                                    @csrf
                                    <textarea name="desc_clockin" id="desc_clockin" rows="4" class="my-2 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Report" required></textarea>
                                    <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">The Morning Report is available at 7.30 - 8.30</p>
                                    <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Clockin</button>
                                </form>
                            </div>
                            <div class="col-span-6 sm:col-span-3 pl-6 pt-6">
                                <ol class="relative border-l border-gray-200 dark:border-gray-700">  
                                    @php $counter=0; @endphp
                                    @foreach ($history as $arr)
                                    <li class="mb-10 ml-6">      
                                        <span class="flex absolute -left-3 justify-center items-center w-6 h-6 bg-blue-200 rounded-full ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                                            <svg aria-hidden="true" class="w-3 h-3 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                        </span>
                                        @if ($counter == 0)
                                            <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900">History Morning Reports <span class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ml-3">Latest</span></h3>
                                        @endif
                                        <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">{{ $arr->date }}</time>
                                        @if( $arr->status_clockin == 'present')
                                        <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">You did Morning Report at <span class="text-gray-800 font-semibold rounded"> {{ $arr->clockin }} </span> with status <span class=" text-green-700 font-semibold rounded dark:text-green-800"> {{ $arr->status_clockin }} </span>.</p>
                                        @elseif($arr->status_clockin == 'absence')
                                        <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">You did Morning Report at <span class="text-gray-800 font-semibold rounded"> {{ $arr->clockin }} </span> with status <span class=" text-red-700 font-semibold rounded dark:text-red-800"> {{ $arr->status_clockin }} </span>.</p>
                                        @endif
                                    </li>
                                    @php if($counter == 2) {break;} $counter++; @endphp
                                    @endforeach
                                </ol>                            
                            </div>
                        </div>
                    </div>
                    <div class="hidden p-4 bg-white rounded-lg md:p-8" id="AfternoonReport" role="tabpanel" aria-labelledby="AfternoonReport-tab">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3 max-w-lg p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                                <div id="clock3" onclick="currentTime()" class="text-white"></div>
                                <div id="clock4" onclick="currentTime()" class="text-white text-2xl"></div>
                                @foreach ($history as $arr)
                                @if(date('Y-m-d') == date($arr->date) && date('H:i:s') >= date('16:30:00'))
                                <form action="{{ route('attendance.clockout', $arr->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <textarea name="desc_clockout" id="desc_clockin" rows="4" class="my-2 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Report" required></textarea>
                                    <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">The Afternoon Report is available at 15.30 - 16.30</p>
                                    <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Clockout</button>
                                </form>
                                @php break; @endphp
                                @else
                                <textarea name="desc_clockout" id="desc_clockout" rows="4" class="my-2 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="you can not do Afternoon Report before do Morning Report" required></textarea>
                                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">The Afternoon Report is available at 15.30 - 16.30</p>
                                <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Clockout</button>
                                @php break; @endphp
                                @endif
                                @endforeach
                            </div>
                            <div class="col-span-6 sm:col-span-3 pl-6 pt-6">
                                <ol class="relative border-l border-gray-200 dark:border-gray-700">  
                                    @php $counter=0; @endphp
                                    @foreach ($attendance as $arr)
                                    <li class="mb-10 ml-6">      
                                        <span class="flex absolute -left-3 justify-center items-center w-6 h-6 bg-blue-200 rounded-full ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                                            <svg aria-hidden="true" class="w-3 h-3 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                        </span>
                                        @if ($counter == 0)
                                            <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900">History Afternoon Reports <span class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ml-3">Latest</span></h3>
                                        @endif
                                        <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">{{ $arr->date }}</time>
                                        @if( $arr->status_clockout == 'present')
                                        <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">You did Morning Report at <span class="text-gray-800 font-semibold rounded"> {{ $arr->clockout }} </span> with status <span class=" text-green-700 font-semibold rounded dark:text-green-800"> {{ $arr->status_clockout }} </span>.</p>
                                        @elseif($arr->status_clockout == 'absence')
                                        <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">You did Morning Report at <span class="text-gray-800 font-semibold rounded"> {{ $arr->clockout }} </span> with status <span class=" text-red-700 font-semibold rounded dark:text-red-800"> {{ $arr->status_clockout }} </span>.</p>
                                        @elseif($arr->clockout == null)
                                        <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">You have not do Afternoon Report yet.</p>
                                        @endif
                                    </li>
                                    @php if($counter == 2) {break;} $counter++; @endphp
                                    @endforeach
                                </ol>                            
                            </div>
                        </div>
                    </div>
                    <div class="hidden p-4 bg-white rounded-lg md:p-8" id="History" role="tabpanel" aria-labelledby="History-tab">
                        <div class="grid grid-cols-3 gap-3">
                            {{-- This week  --}}
                            <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                                <a href="#">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">This Week</h5>
                                </a>
                                <ul class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                    <li class="py-3">Morning Reports
                                        <ul class="grid"> 
                                            <li class="inline-flex">
                                                <svg class="mx-2 text-green-500 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                Present : {{ $countWeek->presentclockin}}
                                            </li>
                                            <li class="inline-flex">
                                                <svg class="mx-2 text-red-500 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                Absence : {{ $countWeek->absenceclockin}}
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="py-3">Afternoon Reports
                                        <ul class="grid">
                                            <li class="inline-flex">
                                                <svg class="mx-2 text-green-500 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                Present : {{ $countWeek->presentclockout}}
                                            </li>
                                            <li class="inline-flex">
                                                <svg class="mx-2 text-red-500 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                Absence : {{ $countWeek->absenceclockout}}
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                {{-- Print  --}}
                                <div class="px-6 pb-0.5 flex flex-wrap first-line:w-full flex-row-reverse">
                                    <a href="{{ route("attendance.printWeek") }}" target="_blank" class="inline-flex flex-end items-center px-7 py-1 text-sm font-semibold text-center text-gray-800 bg-purple-200 rounded-lg hover:bg-purple-300 focus:ring-4 focus:outline-none focus:ring-white dark:bg-purple-200 dark:hover:bg-purple-300 dark:focus:ring-white">
                                        PRINT
                                        <svg class="w-6 h-6 ml-2 -mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                    </a>
                                </div> 
                            </div>
                            {{-- This Month  --}}
                            <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                                <a href="#">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">This Month: {{ $thisMonth }}</h5>
                                </a>
                                <ul class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                    <li class="py-3">Morning Reports
                                        <ul class="grid"> 
                                            <li class="inline-flex">
                                                <svg class="mx-2 text-green-500 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                Present : {{ $countMonth->presentclockin}}
                                            </li>
                                            <li class="inline-flex">
                                                <svg class="mx-2 text-red-500 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                Absence : {{ $countMonth->absenceclockin}}
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="py-3">Afternoon Reports
                                        <ul class="grid">
                                            <li class="inline-flex">
                                                <svg class="mx-2 text-green-500 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                Present : {{ $countMonth->presentclockout}}
                                            </li>
                                            <li class="inline-flex">
                                                <svg class="mx-2 text-red-500 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                Absence : {{ $countMonth->absenceclockout}}
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                {{-- Print  --}}
                                <div class="px-6 pb-0.5 flex flex-wrap first-line:w-full flex-row-reverse">
                                    <a href="{{ route("attendance.printMonth") }}" target="_blank" class="inline-flex flex-end items-center px-7 py-1 text-sm font-semibold text-center text-gray-800 bg-purple-200 rounded-lg hover:bg-purple-300 focus:ring-4 focus:outline-none focus:ring-white dark:bg-purple-200 dark:hover:bg-purple-300 dark:focus:ring-white">
                                        PRINT
                                        <svg class="w-6 h-6 ml-2 -mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                    </a>
                                </div> 
                            </div>
                            {{-- This Year  --}}
                            <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                                <a href="#">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">This Year: {{ $thisYear }}</h5>
                                </a>
                                <ul class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                    <li class="py-3">Morning Reports
                                        <ul class="grid"> 
                                            <li class="inline-flex">
                                                <svg class="mx-2 text-green-500 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                Present : {{ $countYear->presentclockin}}
                                            </li>
                                            <li class="inline-flex">
                                                <svg class="mx-2 text-red-500 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                Absence : {{ $countYear->absenceclockin}}
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="py-3">Afternoon Reports
                                        <ul class="grid">
                                            <li class="inline-flex">
                                                <svg class="mx-2 text-green-500 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                Present : {{ $countYear->presentclockout}}
                                            </li>
                                            <li class="inline-flex">
                                                <svg class="mx-2 text-red-500 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                Absence : {{ $countYear->absenceclockout}}
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                {{-- Print  --}}
                                <div class="px-6 pb-0.5 flex flex-wrap first-line:w-full flex-row-reverse">
                                    <a href="{{ route("attendance.printYear") }}" target="_blank" class="inline-flex flex-end items-center px-7 py-1 text-sm font-semibold text-center text-gray-800 bg-purple-200 rounded-lg hover:bg-purple-300 focus:ring-4 focus:outline-none focus:ring-white dark:bg-purple-200 dark:hover:bg-purple-300 dark:focus:ring-white">
                                        PRINT
                                        <svg class="w-6 h-6 ml-2 -mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                    </a>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <div class="pb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="w-full bg-white border rounded-lg shadow-md">
               
            {{-- search --}}
            <form method="GET" action="{{ route("attendance.index") }}">   
                <div class="p-6 space-y-2"> 
                    
                    {{-- Sort, Order, Paginate --}}
                    <div>
                        <div class="flex items-center">

                            {{-- Sort  --}}
                            <label for="sort" class="sr-only">Sort</label>
                            <select id="sort" name="sort" class="flex-shrink-0 z-10 inline-flex items-center py-1.5 px-7 text-sm font-medium text-center text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-white focus:ring-4 focus:outline-none focus:ring-gray-100 ">
                                <option value="desc">Desc</option>
                                <option value="asc">Asc</option>
                            </select>

                            {{-- Order --}}
                            <label for="order" class="sr-only">choose Order</label>
                            <select id="order" name="order" class="mr-5 bg-white border border-gray-300 py-1.5 text-gray-900 text-sm rounded-r-lg border-l-gray-100 border-l-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="date">Date</option>
                            </select>

                            {{-- Paginate  --}}
                            <label for="limit" class="sr-only">Paginate</label>
                            <div class="relative w-full p-1.5">
                                <input value="{{ old('limit') }}" name="limit" type="number" id="limit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-10" placeholder="Paginate" min="0">
                            </div>
                        </div>
                    </div>
                    
                    {{-- Search Time Base on Absence or Present & search By date --}}
                    <div class="flex items-center">

                        {{-- Search Time Base on Absence or Present  --}}
                        <label for="time" class="sr-only">choose</label>
                        <select id="time" name="time" class="flex-shrink-0 z-10 inline-flex items-center py-1.5 px-7 text-sm font-medium text-center text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-white focus:ring-4 focus:outline-none focus:ring-gray-100 ">
                            <option value="">-Pilih-</option>
                            <option value="morning">Morning</option>
                            <option value="afternoon">Afternoon</option>
                        </select>
                        <label for="status" class="sr-only">choose</label>
                        <select id="status" name="status" class="mr-5 bg-white border border-gray-300 py-1.5 text-gray-900 text-sm rounded-r-lg border-l-gray-100 border-l-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                            <option value="">-Pilih-</option>
                            <option value="absence">Absence</option>
                            <option value="present">Present</option>
                        </select>

                       {{-- Range Time  --}}
                       <div date-rangepicker class="flex items-center">
                        <div class="relative">
                            <x-text-input id="startdate" name="startdate" type="date" class="mt-1 block w-full" :value="old('startdate')"/>
                        </div>
                        <span class="mx-4 text-gray-500">to</span>
                        <div class="relative">
                            <x-text-input id="enddate" name="enddate" type="date" class="mt-1 block w-full" :value="old('enddate')"/>
                        </div>
                    </div>
                    {{-- End Range Time --}}

                        {{-- button Search --}}
                        <button id='search' type="submit" class="search p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-gray-800 dark:hover:border-gray-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-blue-800">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            <span class="sr-only">Search</span>
                        </button>
                    </div>

                </div>
            </form>
            {{-- End Search  --}}

            {{-- counter  --}}
            <div class="p-6">
                <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                    <div class="w-full p-4 text-center bg-white border rounded-lg shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                        <h5 class="inline-flex mb-2 text-3xl font-bold text-gray-900 dark:text-white">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                            Counter Reports
                        </h5>
                        @if ($attendance->order || $attendance->startdate || $attendance->enddate)
                        <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">Shows Attendance from {{ $attendance->startdate }} to {{ $attendance->enddate }} with {{ $attendance->sort }} order.</p>
                        @else
                        <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">Count of All Reports.</p>
                        @endif
                        <div class="items-center justify-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
                            <div class="w-full sm:w-auto bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 text-white rounded-lg inline-flex items-center justify-center px-4 py-2.5 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                <svg class="text-green-500 mr-3 w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                                <div class="text-left">
                                    <div class="mb-1 text-xs">Present Morning Reports</div>
                                    <div class="-mt-1 font-sans text-sm font-semibold">{{ $attendance->presentclockin }}</div>
                                </div>
                            </div>
                            <div class="w-full sm:w-auto bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 text-white rounded-lg inline-flex items-center justify-center px-4 py-2.5 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                <svg class="text-red-500 mr-3 w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" /></svg>
                                <div class="text-left">
                                    <div class="mb-1 text-xs">Absence Morning Reports</div>
                                    <div class="-mt-1 font-sans text-sm font-semibold">{{ $attendance->absenceclockin }}</div>
                                </div>
                            </div>
                            <div class="w-full sm:w-auto bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 text-white rounded-lg inline-flex items-center justify-center px-4 py-2.5 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                <svg class="text-green-500 mr-3 w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                                <div class="text-left">
                                    <div class="mb-1 text-xs">Present Afternoon Reports</div>
                                    <div class="-mt-1 font-sans text-sm font-semibold">{{ $attendance->presentclockout }}</div>
                                </div>
                            </div>
                            <div class="w-full sm:w-auto bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 text-white rounded-lg inline-flex items-center justify-center px-4 py-2.5 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                <svg class="text-red-500 mr-3 w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" /></svg>
                                <div class="text-left">
                                    <div class="mb-1 text-xs">Absence Afternoon Reports</div>
                                    <div class="-mt-1 font-sans text-sm font-semibold">{{ $attendance->absenceclockout }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End counter  --}}

            {{-- Print  --}}
            <div class="px-6 pb-0.5 flex flex-wrap first-line:w-full flex-row-reverse">
                <a href="{{ route("attendance.printAll") }}" target="_blank" class="inline-flex flex-end items-center px-7 py-1 text-sm font-semibold text-center text-gray-800 bg-purple-200 rounded-lg hover:bg-purple-300 focus:ring-4 focus:outline-none focus:ring-white dark:bg-purple-200 dark:hover:bg-purple-300 dark:focus:ring-white">
                    PRINT ALL
                    <svg class="w-6 h-6 ml-2 -mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                </a>
            </div> 

            {{-- table --}}
            <div class="p-6 pt-1">
                <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-white uppercase bg-gray-50 dark:bg-gray-800 dark:text-gray-100">
                            <tr>
                                <th scope="col" class="py-3 px-6"> No </th>
                                <th scope="col" class="py-3 px-6"> Date </th>
                                <th scope="col" class="py-3 px-6"> Morning (Time) </th>
                                <th scope="col" class="py-3 px-6"> Morning Report </th>
                                <th scope="col" class="py-3 px-6"> Afternoon (Time) </th>
                                <th scope="col" class="py-3 px-6"> Afternoon Report </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($attendance->count() == 0)
                            <tr>
                                <td colspan="8" scope="row" class="py-4 px-6 font-medium text-gray-500 whitespace-nowrap" >No Report to display.</td>
                            </tr>
                            @endif

                            @php $no=1; @endphp
                            @foreach($attendance as $arr)
                            <tr class="bg-white">
                                <td class="py-4 px-6">
                                    {{ $no++ }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ $arr->date }}
                                </td>
                                <td class="py-4 px-6">
                                    @if( $arr->status_clockin == 'present')
                                    <span class="bg-green-200 text-green-700 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:text-green-800"> {{ $arr->clockin }}(Present) </span>
                                    @elseif($arr->status_clockin == 'absence')
                                    <span class="bg-red-200 textred-700 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:text-red-800"> {{ $arr->clockin }}(Absence) </span>
                                    @endif
                                </td>
                                <td class="py-4 px-6">
                                    {{ $arr->desc_clockin }}
                                </td>
                                <td class="py-4 px-6">
                                    @if( $arr->status_clockout == 'present')
                                    <span class="bg-green-200 text-green-700 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:text-green-800"> {{ $arr->clockout }}(Present) </span>
                                    @elseif($arr->status_clockout == 'absence')
                                    <span class="bg-red-200 textred-700 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:text-red-800"> {{ $arr->clockout }}(Absence) </span>
                                    @endif
                                </td>
                                <td class="py-4 px-6">
                                    {{ $arr->desc_clockout }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- End Table  --}}

            {{-- links  --}}
            <div class="p-6">
                {{ $attendance->links() }}
            </div>
        {{-- End History  --}}
            </div>
        </div>
    </div>
</x-app-layout>
