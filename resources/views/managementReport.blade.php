<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage All Reports') }}
        </h2>
    </x-slot>
    
    {{-- Session Status --}}
    <x-success-status :status="session('success')" />
    <x-error-status :status="session('error')" />

    {{-- Validation Errors --}}
    <x-validation-errors :messages="$errors->first()" />

  
    <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="w-full bg-white border rounded-lg shadow-md">
    
                {{-- Add Attendance --}}
                <div class="px-6 py-4">
                    {{-- Add Modal toggle --}}
                    <x-primary-button data-modal-toggle="defaultModal">{{ __('Add Report') }}</x-primary-button>

                    {{-- Add Main modal --}}
                    <div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                        <div class="relative w-full h-full max-w-2xl md:h-auto">
                            {{-- Modal content --}}
                            <div class="relative bg-white rounded-lg shadow">
                                <form action="{{ route("managementReport.store") }}" method="POST">
                                    @csrf
                                    {{-- Modal header --}}
                                    <div class="flex items-start justify-between p-4 border-b rounded-t">
                                        <h3 class="text-xl font-semibold text-gray-900">
                                            Add Report
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="defaultModal">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    {{-- Modal body --}}
                                    <div class="p-6 space-y-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-3">
                                                <x-input-label for="user_id" :value="__('Name')" />
                                                <select name="user_id" id="user_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                                    <option selected>-Pilih-</option>
                                                    @foreach($employees as $employee)
                                                    <option value="@if($user = $employee->id) {{$user}}" @endif>
                                                        {{$user = $employee->name}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <x-input-label for="date" :value="__('Date')" />
                                                <x-text-input id="date" name="date" type="date" class="mt-1 block w-full" requireds/>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-3">
                                                <x-input-label for="clockin" :value="__('Clockin(Time)')" />
                                                <x-text-input id="clockin" name="clockin" type="time" class="mt-1 block w-full" required/>
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <x-input-label for="clockout" :value="__('Clockout(Time)')" />
                                                <x-text-input id="clockout" name="clockout" type="time" class="mt-1 block w-full" required/>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-3">
                                                <x-input-label for="desc_clockin" :value="__('Morning Report')" />
                                                <x-text-input id="desc_clockin" name="desc_clockin" type="text" class="block mt-1 w-full" required />
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <x-input-label for="desc_clockout" :value="__('Afternoon Report')" />
                                                <x-text-input id="desc_clockout" name="desc_clockout" type="text" class="block mt-1 w-full" required />
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-6 gap-6" >
                                            <div class="col-span-6 sm:col-span-3">
                                                <x-input-label for="status_clockin" :value="__('Status Clockin')" />
                                                <select name="status_clockin" id="status_clockin" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                                    <option value="present">Present</option>
                                                    <option value="absence">Absence</option>
                                                </select>
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <x-input-label for="status_clockout" :value="__('Status Clockout')" />
                                                <select name="status_clockout" id="status_clockout" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                                    <option value="present">Present</option>
                                                    <option value="absence">Absence</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Modal footer --}}
                                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                                        <x-secondary-button data-modal-toggle="defaultModal">{{ __('Cancel') }}</x-secondary-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- End Main Modal  --}}
                </div>
                {{-- End Add Attendance --}}

                {{-- search --}}
                <form method="GET" action="{{ route("managementReport.index") }}">   
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

                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full pr-5">
                                <input value="{{ old('nama_idUser') }}" name="nama_idUser" type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Search Employee">
                            </div>

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
                            @if ($attendance->nama_idUser || $attendance->order || $attendance->startdate || $attendance->enddate)
                            <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">Shows {{ $attendance->nama_idUser }} attendance from {{ $attendance->startdate }} to {{ $attendance->enddate }} with {{ $attendance->sort }} order.</p>
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
                    <a href="{{ route("managementReport.printAll") }}" target="_blank" class="inline-flex flex-end items-center px-7 py-1 text-sm font-semibold text-center text-gray-800 bg-purple-200 rounded-lg hover:bg-purple-300 focus:ring-4 focus:outline-none focus:ring-white dark:bg-purple-200 dark:hover:bg-purple-300 dark:focus:ring-white">
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
                                    <th scope="col" class="py-3 px-6">No</th>
                                    <th scope="col" class="py-3 px-6">Date</th>
                                    <th scope="col" class="py-3 px-6">Name</th>
                                    <th scope="col" class="py-3 px-6">Morning (Time)</th>
                                    <th scope="col" class="py-3 px-6">Morning Report</th>
                                    <th scope="col" class="py-3 px-6">Afternoon (Time)</th>
                                    <th scope="col" class="py-3 px-6">Afternoon Report</th>
                                    <th scope="col" class="py-3 px-6">Action</th>
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
                                        {{ $arr->user->name }}
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
                                    <td class="py-4 px-6">
                                        <button id="dropdownMenuIconButton" data-dropdown-toggle="dropdownDots{{ $arr->id }}" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50" type="button"> 
                                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path></svg>
                                        </button>
                                        
                                        {{-- Dropdown menu --}}
                                        <div id="dropdownDots{{ $arr->id }}" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                            <div class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton">
                                                <button type="button" data-modal-toggle="editModal{{ $arr->id }}" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white w-full">
                                                    Edit
                                                </button>
                                                <button type="button" data-modal-toggle="deleteModal{{ $arr->id }}" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white w-full">
                                                    Delete
                                                </button> 
                                            </div>
                                        </div>
                                        {{-- End Dropdown menu --}}
                                    </td>

                                    {{-- Edit Modal --}}
                                    <div id="editModal{{ $arr->id }}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                                        <div class="relative w-full h-full max-w-2xl md:h-auto">
                                            {{-- Modal content --}}
                                            <div class="relative bg-white rounded-lg shadow">
                                                <form action="{{ route("managementReport.update", $arr->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    {{-- Modal header --}}
                                                    <div class="flex items-start justify-between p-4 border-b rounded-t">
                                                        <h3 class="text-xl font-semibold text-gray-900">
                                                            Edit Employee
                                                        </h3>
                                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="editModal{{ $arr->id }}">
                                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                    </div>
                                                    {{-- Modal body --}}
                                                    <div class="p-6 space-y-6">
                                                        <div class="grid grid-cols-6 gap-6">
                                                            <div class="col-span-6 sm:col-span-3">
                                                                <x-input-label for="user_id" :value="__('Name')" />
                                                                <select name="user_id" id="user_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                                                    @foreach($employees as $employee)
                                                                    @if($arr->user->id == $employee->id)
                                                                    <option selected value="{{ $employee->id }}">
                                                                        {{$employee->name}}
                                                                    </option>
                                                                    <?php continue; ?>
                                                                    @endif
                                                                    <option value="@if($user = $employee->id) {{$user}}" @endif>
                                                                        {{$user = $employee->name}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-span-6 sm:col-span-3">
                                                                <x-input-label for="date" :value="__('Date')" />
                                                                <x-text-input id="date" name="date" type="date" class="mt-1 block w-full" :value="$arr->date" requireds/>
                                                            </div>
                                                        </div>
                                                        <div class="grid grid-cols-6 gap-6">
                                                            <div class="col-span-6 sm:col-span-3">
                                                                <x-input-label for="clockin" :value="__('Clockin(Time)')" />
                                                                <x-text-input id="clockin" name="clockin" type="time" class="mt-1 block w-full" :value="$arr->clockin" required/>
                                                            </div>
                                                            <div class="col-span-6 sm:col-span-3">
                                                                <x-input-label for="clockout" :value="__('Clockout(Time)')" />
                                                                <x-text-input id="clockout" name="clockout" type="time" class="mt-1 block w-full" :value="$arr->clockout" required/>
                                                            </div>
                                                        </div>
                                                        <div class="grid grid-cols-6 gap-6">
                                                            <div class="col-span-6 sm:col-span-3">
                                                                <x-input-label for="desc_clockin" :value="__('Morning Report')" />
                                                                <x-text-input id="desc_clockin" name="desc_clockin" type="text" class="block mt-1 w-full" :value="$arr->desc_clockin" required />
                                                            </div>
                                                            <div class="col-span-6 sm:col-span-3">
                                                                <x-input-label for="desc_clockout" :value="__('Afternoon Report')" />
                                                                <x-text-input id="desc_clockout" name="desc_clockout" type="text" class="block mt-1 w-full" :value="$arr->desc_clockout" required />
                                                            </div>
                                                        </div>
                                                        <div class="grid grid-cols-6 gap-6" >
                                                            <div class="col-span-6 sm:col-span-3">
                                                                <x-input-label for="status_clockin" :value="__('Status Clockin')" />
                                                                <select name="status_clockin" id="status_clockin" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                                                    @if($arr->status_clockin == "absence")
                                                                    <option selected value="absence">Absence</option>
                                                                    <option value="present">Present</option>
                                                                    @else
                                                                    <option selected value="present">Present</option>
                                                                    <option value="absence">Absence</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            <div class="col-span-6 sm:col-span-3">
                                                                <x-input-label for="status_clockout" :value="__('Status Clockout')" />
                                                                <select name="status_clockout" id="status_clockout" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                                                    @if($arr->status_clockout == "absence")
                                                                    <option selected value="absence">Absence</option>
                                                                    <option value="present">Present</option>
                                                                    @else
                                                                    <option selected value="present">Present</option>
                                                                    <option value="absence">Absence</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- Modal footer --}}
                                                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                                                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                                                        <x-secondary-button data-modal-toggle="editModal{{ $arr->id }}">{{ __('Cancel') }}</x-secondary-button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Edit Modal --}}

                                    {{-- Delete Modal  --}}
                                    <div id="deleteModal{{ $arr->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                                        <div class="relative w-full h-full max-w-md md:h-auto">
                                            <div class="relative bg-white rounded-lg shadow">
                                                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center " data-modal-toggle="deleteModal{{ $arr->id }}">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                                <div class="p-6 text-center">
                                                    <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete {{ $arr->user->name }}'s absence on {{ $arr->date }}? ?</h3>
                                                    <form action="{{ route("managementReport.destroy", $arr->id) }}" method="POST">
                                                        @csrf
                                                        @method("DELETE")
                                                        <button type="submit" data-modal-toggle="deleteModal{{ $arr->id }}" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                            Yes, I'm sure
                                                        </button>
                                                    </form>
                                                    <button data-modal-toggle="deleteModal{{ $arr->id }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 ">No, cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- End Delete Modal  --}}

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- End Table --}}

                {{-- links  --}}
                <div class="p-6">
                    {{ $attendance->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
