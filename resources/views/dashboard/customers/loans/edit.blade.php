@extends('dashboard.layout')
@section('dashboard-content')

    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
        <li class="inline-flex items-center">
            <a href="{{route('dashboard.index')}}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
            Dashboard
            </a>
        </li>
        <li>
            <div class="flex items-center">
            <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <a href="{{route('receivable.index')}}" class="text-sm font-medium text-gray-700 ms-1 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">Loan</a>
            </div>
        </li>
        <li aria-current="page">
            <div class="flex items-center">
            <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
            </svg>
            <span class="text-sm font-medium text-gray-500 ms-1 md:ms-2 dark:text-gray-400">Edit</span>
            </div>
        </li>
        </ol>
    </nav>  
    <form action="{{route('receivable.update',$data)}}" method="POST" class="mt-5">
        @csrf
        @method('PUT')
        <div  class="max-w-sm mt-3">
            <label for="amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>
            <input type="number" min="{{$totalPayed}}" value="{{$data->amount}}" name="amount" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
        </div>    
        <div class="max-w-sm mt-3">
           <label   for="customer" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Customer</label>
            <select required  id="customer" name="customer_id"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @foreach ($customers as $customer) 
                <option 
                value="{{ $customer->id }}" 
                {{ $data->customer_id == $customer->id ? 'selected' : '' }}
                >
                {{ $customer->name }}
                </option> 
            @endforeach
            </select>
        </div>
        <div class="max-w-sm mt-3">
            <label   for="customer" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Customer</label>
            <select required  id="customer" name="status"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @foreach (['pending','paid','overdue'] as $status)
                    <option {{$data->status == $status ? "checked" : ""}} value="{{$status}}">{{$status}}</option>                
                @endforeach
            </select>
        </div>
        <div class="max-w-sm mt-3">
            <label for="due" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Due</label>
            <input id="datepicker-autohide" value="{{$data->due_date}}" datepicker-format="yyyy-mm-dd" name="due_date" datepicker datepicker-autohide type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select due date" required>
        </div>
        <button type="submit" class="text-white mt-3 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit</button>
    
    </form> 

@endsection
