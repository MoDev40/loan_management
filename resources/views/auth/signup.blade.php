@extends('auth.layout')
@section('auth-content')
<div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
            Create an account
        </h1>
        <form class="space-y-4 md:space-y-6" action="{{route('auth.store')}}" method="post">
            @csrf
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                <input type="name" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-[#52525b] focus:border-[#52525b] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name" required>
            </div>
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-[#52525b] focus:border-[#52525b] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required>
            </div>
            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-[#52525b] focus:border-[#52525b] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            </div>
            <button type="submit" class="w-full text-white bg-[#52525b] hover:bg-[#3f3f46] focus:ring-4 focus:outline-none focus:ring-[#d4d4d8] font-medium rounded-lg text-sm px-5 py-2.5 text-center">Create an account</button>
            <p class="text-md font-light text-gray-500 dark:text-gray-400">
                Back to dashboard <a href="{{route('dashboard.index')}}" class="font-medium text-[#52525b] hover:underline dark:text-[#71717a]">here</a>
            </p>
        </form>
    </div>
</div>
@endsection