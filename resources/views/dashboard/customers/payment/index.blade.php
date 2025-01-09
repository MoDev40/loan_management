@extends('dashboard.layout')
@section('dashboard-content')
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    RefNo
                </th>
                <th scope="col" class="px-6 py-3">
                    Amount
                </th>
                <th scope="col" class="px-6 py-3">
                    Date
                </th>
                <th scope="col" class="px-6 py-3">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$payment->accounts_receivable_id}}
                </th>
                <td class="px-6 py-4">
                    ${{$payment->amount}}
                </td>
                <td class="px-6 py-4">
                    {{$payment->payment_date}}
                </td>
                <td class="flex flex-col items-start px-6 py-5 text-start">
                    <a href="{{route('accounts_receive.edit',$payment)}}" class="font-medium text-yellow-500 hover:underline">Edit</a>
                    <form action="{{route('accounts_receive.destroy',$payment)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Are you sure you want to delete this payment record?')" type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-5">
    {{$payments->links()}}
</div>
@endsection