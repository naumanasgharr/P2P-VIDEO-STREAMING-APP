@extends('add_friend')
@section('searchbar')
    <form action="{{route('sendRequest')}}" method="POST" class="max-w-md mx-auto mt-8 p-6 rounded-xl shadow-md space-y-4">
        @csrf

        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
            Search by your friend's unique User ID
        </h2>
        <div class="flex items-center space-x-4">
            <input
                name="friend_id"
                type="number"
                min="1"
                step="1"
                placeholder="Enter User ID"
                class="w-full sm:flex-1 px-5 py-3 rounded-lg border border-neutral-300 dark:border-neutral-700 bg-neutral-200 dark:bg-neutral-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200"
            >

            <button
                type="submit"
                class="px-6 py-3 rounded-lg bg-blue-600 hover:bg-blue-700 active:scale-95 text-white font-medium transition-all duration-200 shadow border border-blue-700"
            >
                Send
            </button>
        </div>
    </form>
    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error1'))
        <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
            {{ session('error1') }}
        </div>
    @endif
    @if(session('error2'))
        <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
            {{ session('error2') }}
        </div>
    @endif
    @if(session('error3'))
        <div class="bg-red-500 text-white p-4 rounded-lg mb-4">
            {{ session('error3') }}
        </div>
    @endif

    @if(session('info'))
        <div class="bg-blue-500 text-white p-4 rounded-lg mb-4">
            {{ session('info') }}
        </div>
    @endif
@endsection