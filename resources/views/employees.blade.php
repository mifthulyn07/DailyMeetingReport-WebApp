<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employees') }}
        </h2>
    </x-slot>

    <!-- Session Status -->
    <x-success-status :status="session('success')" />
    <x-error-status :status="session('error')" />

    <!-- Validation Errors -->
    <x-validation-errors :messages="$errors->first()" />

    <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="w-full bg-white border rounded-lg shadow-md">
                
                @if ($role == 'super-admin')
                {{-- Add Employee  --}}
                <div class="px-6 py-3">
                    <!-- Button Add Employee -->
                    <x-primary-button data-modal-toggle="defaultModal">{{ __('Add Employee') }}</x-primary-button>

                    <!-- Modal Add Employee -->
                    <div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                        <div class="relative w-full h-full max-w-2xl md:h-auto">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow">
                                <form action="{{ route("employees.store") }}" method="POST">
                                    @csrf
                                    <!-- Modal header -->
                                    <div class="flex items-start justify-between p-4 border-b rounded-t">
                                        <h3 class="text-xl font-semibold text-gray-900">
                                            Add Employee
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="defaultModal">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-6 space-y-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-3">
                                                <x-input-label for="name" :value="__('Name')" />
                                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"  required autofocus/>
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <x-input-label for="email" :value="__('Email')" />
                                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"  requireds/>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-3">
                                                <x-input-label for="password" :value="__('Password')" />
                                                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" required/>
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                                <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="block mt-1 w-full" required />
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-6 gap-6" >
                                            <div class="col-span-6 sm:col-span-3">
                                                <x-input-label for="gender" :value="__('Gender')" />
                                                <select name="gender" id="gender" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                </select>
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <x-input-label for="phone" :value="__('Phone Number')" />
                                                <x-text-input id="phone" name="phone" type="tel" class="mt-1 block w-full"/>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-3">
                                                <x-input-label for="address" :value="__('Address')" />
                                                <x-text-input id="address" name="address" type="text" class="mt-1 block w-full"/>
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <x-input-label for="joined_on" :value="__('Joined on')" />
                                                <x-text-input id="joined_on" name="joined_on" type="date" class="mt-1 block w-full"/>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-3">
                                                <x-input-label for="role" :value="__('Role')" />
                                                <select name="role" id="role" :value="old('role')" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                                    <option value="staff">Staff</option>
                                                    <option value="super-admin">Super Admin</option>
                                                </select>
                                            </div>
                                        </div>   
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                                        <x-secondary-button data-modal-toggle="defaultModal">{{ __('Cancel') }}</x-secondary-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- End Modal Add Employee  --}}
                </div>
                @endif
                
                {{-- All Search --}}
                <form method="GET" action="{{ route("employees.index") }}">   
                    <div class="px-6 py-4 space-y-2">  

                        {{-- Sort, Order Paginate  --}}
                        <div>
                            <div class="flex items-center">

                                {{-- Sort  --}}
                                <label for="sort" class="sr-only">Sort</label>
                                <select id="sort" name="sort" class="flex-shrink-0 z-10 inline-flex items-center py-1.5 px-7 text-sm font-medium text-center text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-white focus:ring-4 focus:outline-none focus:ring-gray-100 ">
                                    <option value="asc">Asc</option>
                                    <option value="desc">Desc</option>
                                </select>

                                {{-- order  --}}
                                <label for="order" class="sr-only">Choose Order</label>
                                <select id="order" name="order" class="mr-5 bg-white border border-gray-300 py-1.5 text-gray-900 text-sm rounded-r-lg border-l-gray-100 border-l-2 focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                    <option value="name">Name</option>
                                    <option value="role">Role</option>
                                    <option value="gender">Gender</option>
                                    <option value="phone">Phone</option>
                                    <option value="adress">Address</option>
                                    <option value="joined_on">Joined on</option>
                                </select>

                                {{-- Paginate --}}
                                <label for="limit" class="sr-only">Paginate</label>
                                <div class="relative w-full p-1.5">
                                    <input value="{{ old('limit') }}" name="limit" type="number" id="limit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-10" placeholder="Paginate" min="0">
                                </div>
                            </div>
                        </div>

                        {{-- search  --}}
                        <div class="flex items-center">
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <input value="{{ old('search') }}" name="search" type="text" id="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Search">
                            </div>

                            <button type="submit" class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-gray-800 dark:hover:border-gray-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-blue-800">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                <span class="sr-only">Search</span>
                            </button>
                        </div>
                    </div>
                </form>
                {{-- End All Search --}}

                <div class="px-6 pb-0.5 flex flex-wrap first-line:w-full flex-row-reverse">
                    <a href="{{ route("employees.print") }}" target="_blank" class="inline-flex flex-end items-center px-7 py-1 text-sm font-semibold text-center text-gray-800 bg-purple-200 rounded-lg hover:bg-purple-300 focus:ring-4 focus:outline-none focus:ring-white dark:bg-purple-200 dark:hover:bg-purple-300 dark:focus:ring-white">
                        PRINT
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
                                    <th scope="col" class="py-3 px-6"> Name </th>
                                    <th scope="col" class="py-3 px-6"> Email </th>
                                    <th scope="col" class="py-3 px-6"> Role </th>

                                    @if ($role == 'super-admin')
                                    <th scope="col" class="py-3 px-6"> Action </th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if ($employees->count() == 0)
                                <tr>
                                    <td colspan="8" scope="row" class="py-4 px-6 font-medium text-gray-500 whitespace-nowrap" >No Employee to display.</td>
                                </tr>
                                @endif

                                @php $no=1; @endphp
                                @foreach($employees as $employee)
                                <tr class="bg-white border-b">
                                    <td scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $no++ }}
                                    </td>
                                    <td scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $employee->name }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $employee->email }}
                                    </td>
                                    <td class="py-4 px-6">
                                        @if( $employee->role == 'staff')
                                        <span class="bg-gray-100 text-gray-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">{{ $employee->role }}</span>
                                        @elseif($employee->role == 'super-admin')
                                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">Admin</span>
                                        @endif
                                    </td>

                                    @if ($role == 'super-admin')
                                    {{-- toggle  --}}
                                    <td class="py-4 px-6">
                                        <button id="dropdownMenuIconButton" data-dropdown-toggle="dropdownDots{{ $employee->id }}" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50" type="button"> 
                                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path></svg>
                                        </button>
                                        
                                        <!-- Dropdown menu -->
                                        <div id="dropdownDots{{ $employee->id }}" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                            <div class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton">
                                                <button type="button" data-modal-toggle="editModal{{ $employee->id }}" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white w-full">
                                                    Edit
                                                </button>
                                                <button type="button" data-modal-toggle="detailModal{{ $employee->id }}" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white w-full">
                                                    Detail
                                                </button>
                                                <button type="button" data-modal-toggle="deleteModal{{ $employee->id }}" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white w-full">
                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                        <!-- End Dropdown menu -->
                                    </td>
                                    {{-- End toggle  --}}

                                    <!-- Edit Modal -->
                                    <div id="editModal{{ $employee->id }}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                                        <div class="relative w-full h-full max-w-2xl md:h-auto">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow">
                                                <form action="{{ route("employees.update", $employee->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <!-- Modal header -->
                                                    <div class="flex items-start justify-between p-4 border-b rounded-t">
                                                        <h3 class="text-xl font-semibold text-gray-900">
                                                            Edit Employee
                                                        </h3>
                                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="editModal{{ $employee->id }}">
                                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="p-6 space-y-6">
                                                        <div class="grid grid-cols-6 gap-6">
                                                            <div class="col-span-6 sm:col-span-3">
                                                                <x-input-label for="name" :value="__('Name')" />
                                                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="$employee->name" required autofocus/>
                                                            </div>
                                                            <div class="col-span-6 sm:col-span-3">
                                                                <x-input-label for="email" :value="__('Email')" />
                                                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="$employee->email" requireds/>
                                                            </div>
                                                        </div>
                                                        <div class="grid grid-cols-6 gap-6">
                                                            <div class="col-span-6 sm:col-span-3">
                                                                <x-input-label for="password" :value="__('New password')" />
                                                                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"/>
                                                            </div>
                                                            <div class="col-span-6 sm:col-span-3">
                                                                <x-input-label for="password_confirmation" :value="__('Confirm New Password')" />
                                                                <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="block mt-1 w-full"/>
                                                            </div>
                                                        </div>
                                                        <div class="grid grid-cols-6 gap-6" >
                                                            <div class="col-span-6 sm:col-span-3">
                                                                <x-input-label for="gender" :value="__('Gender')" />
                                                                <select name="gender" id="gender" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                                                    @if($employee->gender == "male")
                                                                    <option selected value="male">Male</option>
                                                                    <option value="female">Female</option>
                                                                    @else
                                                                    <option selected value="female">Female</option>
                                                                    <option value="male">Male</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            <div class="col-span-6 sm:col-span-3">
                                                                <x-input-label for="phone" :value="__('Phone Number')" />
                                                                <x-text-input id="phone" name="phone" type="tel" class="mt-1 block w-full" :value="$employee->phone"/>
                                                            </div>
                                                        </div>
                                                        <div class="grid grid-cols-6 gap-6">
                                                            <div class="col-span-6 sm:col-span-3">
                                                                <x-input-label for="address" :value="__('Address')" />
                                                                <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="$employee->address"/>
                                                            </div>
                                                            <div class="col-span-6 sm:col-span-3">
                                                                <x-input-label for="joined_on" :value="__('Joined on')" />
                                                                <x-text-input id="joined_on" name="joined_on" type="date" class="mt-1 block w-full" :value="$employee->joined_on"/>
                                                            </div>
                                                        </div>
                                                        <div class="grid grid-cols-6 gap-6">
                                                            <div class="col-span-6 sm:col-span-3">
                                                                <x-input-label for="role" :value="__('Role')" />
                                                                <select name="role" id="role" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                                                    @if($employee->role == "staff")
                                                                    <option selected value="staff">Staff</option>
                                                                    <option value="super-admin">Super Admin</option>
                                                                    @else
                                                                    <option selected value="super-admin">Super Admin</option>
                                                                    <option value="staff">Staff</option>
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>   
                                                    </div>
                                                    <!-- Modal footer -->
                                                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                                                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                                                        <x-secondary-button data-modal-toggle="editModal{{ $employee->id }}">{{ __('Cancel') }}</x-secondary-button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Edit Modal --}}

                                    <!-- Detail Modal -->
                                    <div id="detailModal{{ $employee->id }}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                                        <div class="relative w-full h-full max-w-2xl md:h-auto">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow">
                                                <!-- Modal header -->
                                                <div class="flex items-start justify-between p-4 border-b rounded-t">
                                                    <h3 class="text-xl font-semibold text-gray-900">
                                                        Detail Employee
                                                    </h3>
                                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="detailModal{{ $employee->id }}">
                                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="p-6 space-y-3">
                                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                                        Name    :   {{ $employee->name }}
                                                    </p>
                                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                                        Email   :   {{ $employee->email }}
                                                    </p> 
                                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                                        Gender   :   {{ $employee->gender }}
                                                    </p> 
                                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                                        Phone    :   {{ $employee->phone }}
                                                    </p> 
                                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                                        Address  :   {{ $employee->address }}
                                                    </p>
                                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                                        Role     :   {{ $employee->role }}
                                                    </p>
                                                </div>
                                                <!-- Modal footer -->
                                                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                                                    <x-primary-button data-modal-toggle="detailModal{{ $employee->id }}">{{ __('Ok') }}</x-primary-button>
                                                    <x-secondary-button data-modal-toggle="detailModal{{ $employee->id }}">{{ __('Cancel') }}</x-secondary-button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- end Detail Modal --}}

                                    {{-- Delete Modal  --}}
                                    <div id="deleteModal{{ $employee->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                                        <div class="relative w-full h-full max-w-md md:h-auto">
                                            <div class="relative bg-white rounded-lg shadow">
                                                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center " data-modal-toggle="deleteModal{{ $employee->id }}">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                                <div class="p-6 text-center">
                                                    <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete {{ $employee->name }}?</h3>
                                                    <form action="{{ route("employees.destroy", $employee->id) }}" method="POST">
                                                        @csrf
                                                        @method("DELETE")
                                                        <button type="submit" data-modal-toggle="deleteModal{{ $employee->id }}" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                            Yes, I'm sure
                                                        </button>
                                                    </form>
                                                    <button data-modal-toggle="deleteModal{{ $employee->id }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 ">No, cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- End Delete Modal  --}}
                                    @endif

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- End Table --}}

                {{-- links  --}}
                <div class="p-6">
                    {{ $employees->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

