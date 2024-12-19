@extends('Auth.layout.body')
@section('title', 'Login')
@section('auth-content')


<div class="bg-gradient-to-r from-rose-100 to-teal-100 dark:from-gray-700 dark:via-gray-900 dark:to-black">


<div class="h-screen w-screen flex justify-center items-center">

    <div class="2xl:w-1/4 lg:w-1/3 md:w-1/2 w-full">
        <div class="card overflow-hidden sm:rounded-md rounded-none">
           <livewire:auth.login>
        </div>
    </div>
</div>

</div>

</div>
@endsection
