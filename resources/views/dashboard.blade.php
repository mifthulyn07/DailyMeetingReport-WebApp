<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <div class="grid grid-cols-6 gap-6">
                    
                    {{-- Attedance  --}}
                    <div class="col-span-6 sm:col-span-3 max-w-lg rounded-lg">
                        
                        <div class="bg-white border rounded-lg shadow-md p-6">
                            <h3 class="text-xl font-bold">Your History This Year</h3>
                            <div id="accordion-flush" data-accordion="collapse" data-active-classes="bg-white text-gray-900" data-inactive-classes="text-gray-500 dark:text-gray-400">
                                <h2 id="accordion-flush-heading-1">
                                    <button type="button" class="flex items-center justify-between w-full py-5 font-semibold text-left text-gray-500 border-b border-gray-200" data-accordion-target="#accordion-flush-body-1" aria-expanded="true" aria-controls="accordion-flush-body-1">
                                        <span>This Week</span>
                                        <svg data-accordion-icon class="w-6 h-6 rotate-180 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    </button>
                                </h2>
                                <div id="accordion-flush-body-1" class="hidden" aria-labelledby="accordion-flush-heading-1">
                                    <div class="py-5 font-light border-b border-gray-200 bg-white">
                                        <ul class="inline-flex font-normal text-gray-700 dark:text-gray-400">
                                            <svg class="w-20 h-20 mt-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
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
                                            <svg class="w-20 h-20 mt-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
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
                                    </div>
                                </div>
                                <h2 id="accordion-flush-heading-2">
                                    <button type="button" class="flex items-center justify-between w-full py-5 font-semibold text-left text-gray-500 border-b border-gray-200" data-accordion-target="#accordion-flush-body-2" aria-expanded="false" aria-controls="accordion-flush-body-2">
                                        <span>This {{ $thisMonth }}</span>
                                        <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    </button>
                                </h2>
                                <div id="accordion-flush-body-2" class="hidden" aria-labelledby="accordion-flush-heading-2">
                                    <div class="py-5 font-light border-b border-gray-200">
                                        <ul class="inline-flex font-normal text-gray-700 dark:text-gray-400">
                                            <svg class="w-20 h-20 mt-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
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
                                            <svg class="w-20 h-20 mt-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
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
                                    </div>
                                </div>
                                <h2 id="accordion-flush-heading-3">
                                    <button type="button" class="flex items-center justify-between w-full py-5 font-semibold text-left text-gray-500 border-b border-gray-200" data-accordion-target="#accordion-flush-body-3" aria-expanded="false" aria-controls="accordion-flush-body-3">
                                        <span>This {{ $thisYear }}</span>
                                        <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    </button>
                                </h2>
                                <div id="accordion-flush-body-3" class="hidden" aria-labelledby="accordion-flush-heading-3">
                                    <div class="py-5 font-light border-b border-gray-200">
                                        <ul class="inline-flex font-normal text-gray-700 dark:text-gray-400">
                                            <svg class="w-20 h-20 mt-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
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
                                            <svg class="w-20 h-20 mt-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
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
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="w-full bg-white border rounded-lg shadow-md mt-10">
                            <div class="sm:hidden">
                                <label for="tabs" class="sr-only">Select tab</label>
                                <select id="tabs" class="bg-blue-100 border-0 border-b border-gray-200 text-gray-900 text-sm rounded-t-lg focus:ring-gray-800 focus:border-gray-800 block w-full p-2.5 ">
                                    <option>Morning Report</option>
                                    <option>Afternoon Report</option>
                                </select>
                            </div>
                            <ul class="hidden text-sm font-medium text-center text-gray-900 divide-x divide-gray-200 rounded-lg sm:flex" id="fullWidthTab" data-tabs-toggle="#fullWidthTabContent" role="tablist">
                                <li class="w-full">
                                    <button id="MorningReport-tab" data-tabs-target="#MorningReport" type="button" role="tab" aria-controls="MorningReport" aria-selected="true" class="inline-block w-full p-4 rounded-tl-lg bg-blue-60 hover:bg-blue-100 focus:outline-none">Morning Report</button>
                                </li>
                                <li class="w-full">
                                    <button id="AfternoonReport-tab" data-tabs-target="#AfternoonReport" type="button" role="tab" aria-controls="AfternoonReport" aria-selected="false" class="inline-block w-full p-4 bg-blue-60 hover:bg-blue-100 focus:outline-none">Afternoon Report</button>
                                </li>
                            </ul>
                            <div id="fullWidthTabContent" class="border-t border-gray-200">
                                <div class="hidden p-4 bg-white rounded-lg md:p-8" id="MorningReport" role="tabpanel" aria-labelledby="MorningReport-tab">
                                    <div class="col-span-6 sm:col-span-3 max-w-lg p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800">
                                        <div id="clock1" onclick="currentTime()" class="text-white"></div>
                                        <div id="clock2" onclick="currentTime()" class="text-white text-2xl"></div>
                                        <form action="{{ route('attendance.clockin') }}" method="POST">
                                            @csrf
                                            <textarea name="desc_clockin" id="desc_clockin" rows="4" class="my-2 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Report" required></textarea>
                                            <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">The Morning Report is available at 7.30 - 8.30</p>
                                            <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Clockin</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="hidden p-4 bg-white rounded-lg md:p-8" id="AfternoonReport" role="tabpanel" aria-labelledby="AfternoonReport-tab">
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
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    {{-- History  --}}
                    <div class="col-span-6 sm:col-span-3 px-6">
                        {{-- Employees  --}}
                        <div class="grid p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                            <a href="#">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">PT. Vodjo Teknologi Indonesia's Employees</h5>
                            </a>
                            <div class="justify-center inline-flex mb-3 text-green-500 dark:text-green-500">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                                <p class="font-bold text-green-500 dark:text-green-500 text-3xl mt-2">{{ $countUser }}</p>                            
                            </div>
                            <a href="{{ route("employees.index") }}" class="inline-flex items-center font-medium text-blue-600 hover:text-blue-800 dark:text-blue-500 dark:hover:text-blue-700">
                                Show more
                                <svg class="w-6 h-6 ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            </a>
                        </div>

                        {{-- History  --}}
                        <div class="border rounded-lg shadow-md bg-white col-span-6 sm:col-span-3 p-10 mt-10">
                            <ol class="relative border-l border-gray-200 dark:border-gray-700">  
                                @php $counter=0; @endphp
                                @foreach ($attendance1 as $arr)
                                <li class="mb-10 ml-6">      
                                    <span class="flex absolute -left-3 justify-center items-center w-6 h-6 bg-blue-200 rounded-full ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                                        <svg aria-hidden="true" class="w-3 h-3 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                    </span>
                                    @if ($counter == 0)
                                        <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900">History of All Employees<span class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ml-3">Latest</span></h3>
                                    @endif
                                    <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">{{ $arr->date }} | {{ $arr->user->name }} </time>
                                    @if( $arr->status_clockin == 'present')
                                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">
                                        did Morning Report at <span class="text-gray-800 font-semibold rounded"> {{ $arr->clockin }} </span> with status <span class=" text-green-700 font-semibold rounded dark:text-green-800"> {{ $arr->status_clockin }} </span> and 
                                    </p>
                                    @elseif($arr->status_clockin == 'absence')
                                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">
                                        did Morning Report at <span class="text-gray-800 font-semibold rounded"> {{ $arr->clockin }} </span> with status <span class=" text-red-700 font-semibold rounded dark:text-red-800"> {{ $arr->status_clockin }} </span> and
                                    </p>
                                    @endif
                                    @if( $arr->status_clockout == 'present')
                                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">
                                        did Afternoon Report at <span class="text-gray-800 font-semibold rounded"> {{ $arr->clockout }} </span> with status <span class=" text-green-700 font-semibold rounded dark:text-green-800"> {{ $arr->status_clockout }} </span>.
                                    </p>
                                    @elseif($arr->status_clockout == 'absence')
                                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">
                                        did Afternoon Report at <span class="text-gray-800 font-semibold rounded"> {{ $arr->clockout }} </span> with status <span class=" text-red-700 font-semibold rounded dark:text-red-800"> {{ $arr->status_clockout }} </span>.
                                    </p>
                                    @endif
                                </li>
                                @php if($counter == 4) {break;} $counter++; @endphp
                                @endforeach
                            </ol>
                        </div>                       
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
