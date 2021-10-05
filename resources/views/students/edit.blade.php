<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <h1 class="px-6 pt-6">Edit Student</h1>
        <hr class="mx-6 my-4">

        <form method="POST" action="{{ route('students.update', ['student' => $student]) }}">
            @csrf
            @method('PATCH')
            @include('students._form')
        </form>
    </div>
</x-app-layout>