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
        <span class="text-sm font-medium text-gray-500 ms-1 md:ms-2 dark:text-gray-400">Pay</span>
        </div>
    </li>
    </ol>
</nav> 

<div class="mt-8">
    <div class="grid grid-cols-2 gap-6">
        <div>
            <Label class="font-semibold">Name</Label>
            <p class="font-light text-gray-500">{{$data->customer->name}}</p>
        </div>
        <div>
            <Label class="font-semibold">Email</Label>
            <p class="font-light text-gray-500">{{$data->customer->email}}</p>
        </div>
        <div>
            <Label class="font-semibold">Phone</Label>
            <p class="font-light text-gray-500">{{$data->customer->phone}}</p>
        </div>
        <div>
            <Label class="font-semibold">Address</Label>
            <p class="font-light text-gray-500">{{$data->customer->address}}</p>
        </div>
    </div>
        <hr class="mt-8">
    <div class="grid grid-cols-3 gap-4 mt-4">
        <div>
            <Label class="font-semibold">Paid</Label>
            <p class="text-green-600">${{$totalPayed}}</p>
        </div>
        <div>
            <Label class="font-semibold">Remaining</Label>
            <p class="text-red-600">${{$data->amount-$totalPayed}}</p>
        </div>
        <div>
            <Label class="font-semibold">Total Loan</Label>
            <p>${{$data->amount}}</p>
        </div>
    </div>
</div>
<button 
    type="button"
    {{$data->status == 'paid'  ? "disabled" : "hidden" }}
    data-modal-target="default-modal" 
    data-modal-toggle="default-modal" 
    class="text-white mt-10 w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
>
Pay
</button>

<!-- Main modal -->
<div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full p-4">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Payment
                </h3>
                <button type="button" class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 space-y-4 md:p-5">
                <form action="{{route('accounts_receive.store')}}" method="post">
                    @csrf
                    <input type="hidden" name="accounts_receivable_id" value="{{$data->id}}">
                    <div class="max-w-sm mt-3">
                        <label for="payment_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Payment_date</label>
                        <input id="datepicker-autohide" value="{{now()}}" datepicker-format="yyyy-mm-dd" name="payment_date" datepicker datepicker-autohide type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select due date" required>
                    </div>
                    <div  class="max-w-sm mt-3">
                        <label for="amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>
                        <input type="number" min="1" max="{{$data->amount - $totalPayed}}"  name="amount" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required />
                    </div> 
                    <button type="submit" class="text-white mt-3 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Save</button>  
                </form>
        </div>
    </div>
</div>

@endsection