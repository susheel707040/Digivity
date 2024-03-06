<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <button class="btn btn-primary"><a href="{{ route('createTenant') }}">Add School</a></button>
        </div>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-12 lg:px-0">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">

                    {{-- table start --}}
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Name</th>
                                    <th scope="col" class="px-6 py-3">Email</th>
                                    <th scope="col" class="px-6 py-3">Domain</th>
                                    <th scope="col" class="px-6 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tenants as $tenant)
                                <tr class="bg-white border-b dark:bg-gray:8000 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$tenant->name}}</th>
                                    <td class="px-6 py-4">{{$tenant->email}}</td>
                                    <td class="px-6 py-4">
                                    @foreach($tenant->domains as $domain)
                                    {{$domain->domain}} {{$loop->last ? '':','}}
                                     @endforeach
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex">
                                        <!-- Edit button -->
                                        <a href="{{ route('tenants.edit', ['id' => $tenant->id]) }}" class="bg-blue-500 text-white px-4 py-2 rounded" style="background-color: rgb(0, 183, 255)">Edit</a>
                                        <!-- Delete button -->
                                         <form action="{{ route('deleteTenant', ['tenant' => $tenant->id]) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                         <button class="bg-red-500 text-white px-4 py-2 rounded ml-2">Delete</button>
                                        </form>
                                    </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
