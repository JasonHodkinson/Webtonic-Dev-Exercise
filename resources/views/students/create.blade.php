<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <h1 class="px-6 pt-6">Create Student</h1>
        <hr class="mx-6 my-4">

        <form method="POST" action="{{ route('students.store') }}">
            @csrf
            @include('students._form')
        </form>
    </div>
</x-app-layout>