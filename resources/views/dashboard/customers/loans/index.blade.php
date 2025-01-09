@extends('dashboard.layout')
@section('dashboard-content')
<button type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
    <a href="{{route('receivable.create')}}" class="decoration-none">+</a>
</button>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Phone
                </th>
                <th scope="col" class="px-6 py-3">
                    Amount
                </th>
                <th scope="col" class="px-6 py-3">
                    Due
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                <th scope="col" class="px-6 py-3">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loans as $loan)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                   {{$loan->customer->name}}
                </th>
                <td class="px-6 py-4">
                    {{$loan->customer->phone}}
                </td>
                <td class="px-6 py-4">
                    ${{$loan->amount}}
                </td>
                <td class="px-6 py-4">
                    {{$loan->due_date}}
                </td>
                <td class="px-6 py-4">
                    {{$loan->status}}
                </td>
                <td class="flex flex-col items-start px-6 py-5 text-start">
                    <a href="{{route('receivable.show',$loan->id)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Pay</a>
                    <a href="{{route('receivable.edit',$loan->id)}}" class="font-medium text-yellow-500 hover:underline">Edit</a>
                    <form action="{{route('receivable.destroy',$loan)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Are you sure you want to delete this loan record? All related payments will be deleted')" type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">
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
    {{$loans->links()}}
</div>
@endsection