@extends('dashboard.layout')
@section('dashboard-content')
<div class="flex flex-col space-y-10 justify-between md:flex-row md:space-y-0">
    <div class="bg-white shadow rounded h-40 w-auto md:w-48 flex flex-col justify-center items-center">
        <h1 class="uppercase font-bold">total customers</h1>
        <h1 class="uppercase font-medium">{{$totalCustomers}}</h1>
    </div>
    <div class="bg-white shadow rounded h-40 w-auto md:w-48 flex flex-col justify-center items-center">
        <h1 class="uppercase font-bold">sum of loans</h1>
        <h1 class="uppercase font-medium">${{$sumOfLoans}}</h1>
    </div>
    <div class="bg-white shadow rounded h-40 w-auto md:w-48 flex flex-col justify-center items-center">
        <h1 class="uppercase font-bold">sum of received</h1>
        <h1 class="uppercase font-medium">${{$sumOfReceived}}</h1>
    </div>
</div>
@endsection