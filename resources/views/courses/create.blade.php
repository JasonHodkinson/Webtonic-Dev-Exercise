<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <h1 class="px-6 pt-6">Create Course</h1>
        <hr class="mx-6 my-4">

        <form method="POST" action="{{ route('courses.store') }}">
            @csrf
            @include('courses._form')
        </form>
    </div>
</x-app-layout>