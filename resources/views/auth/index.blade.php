@extends('auth.layout')
@section('auth-content')
<div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
            Sign in to your account
        </h1>
        <form class="space-y-4 md:space-y-6" action="{{route('auth.authenticate')}}" method="POST">
            @csrf
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-[#52525b] focus:border-[#52525b] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required>
            </div>
            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-[#52525b] focus:border-[#52525b] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            </div>
            <div class="flex flex-row items-center justify-between">
                <span></span>
                <a href="#" class="text-sm font-medium text-[#52525b] hover:underline dark:text-[#71717a]">Forgot password?</a>
            </div>
            <button type="submit" class="w-full text-white bg-[#52525b] hover:bg-[#3f3f46] focus:ring-4 focus:outline-none focus:ring-[#d4d4d8] font-medium rounded-lg text-sm px-5 py-2.5 text-center">Login</button>
        </form>
    </div>
</div>
@endsection