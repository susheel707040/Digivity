@extends('user.layout')

@section('css')
@endsection

@section('content')

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Add School') }}
            </h2>
        </div>
    </x-slot>

    <div class="row">
        <!-- Combined Form -->
        <div class="col-md-6">
            <div class="m-5">

                <form action="{{ route('store.user') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Name*</label>
                        <input type="text" placeholder="Enter Name" class="form-control" id="name" name="name">
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone*</label>
                        <input type="text" placeholder="Enter Phone No." class="form-control" id="phone" name="phone">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email address*</label>
                        <input type="email" placeholder="Enter Email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="m-5">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" placeholder="Enter Password" class="form-control" name="password" id="exampleInputPassword1">
                    </div>

                    <div class="mb-3">
                        <label for="dname" class="form-label">DomainName</label>
                        <input type="text" placeholder="Enter Domain Name" class="form-control" name="dname" id="dname">
                    </div>

                    <button type="submit" class="btn btn-primary" style="background-color: green;">Submit</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
@endsection

@section('js')

@endsection
