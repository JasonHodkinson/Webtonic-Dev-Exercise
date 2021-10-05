<x-app-layout>
    {{--Actions --}}
    <div class="max-w-max bg-white overflow-hidden shadow sm:rounded-lg p-6 border-b border-gray-200 mb-4"">
        <x-button-link href="{{ route('courses.create') }}" class="bg-indigo-500 hover:bg-indigo-700">Add a Course</x-button>
        <x-button class="bg-red-500 hover:bg-red-700">Truncate Table</x-button>
    </div>

    {{-- Table --}}
    <x-responsive-table class="mb-4">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <x-table-header>Course Code</x-table-header>
                    <x-table-header>Course Description</x-table-header>
                    <x-table-header class="hidden sm:table-cell">Last Updated</x-table-header>
                    <x-table-header class="text-right">Actions</x-table-header>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($courses as $course)
                <tr>
                    <x-table-data>
                        <a class="text-indigo-600 hover:text-indigo-900"
                            href="{{ route('courses.show', ['course' => $course]) }}">{{ $course->code }}</a>
                    </x-table-data>
                    <x-table-data>
                        <div class="text-sm text-gray-500">{{ $course->description }}</div>
                    </x-table-data>
                    <x-table-data class="hidden sm:table-cell">
                        <div class="text-sm text-gray-500">{{ $course->updated_at->diffForHumans() }}</div>
                    </x-table-data>
                    <x-table-data class="text-right">
                        <a class="text-sm text-indigo-600 hover:text-indigo-900"
                            href="{{ route('courses.edit', ['course' => $course]) }}">Edit</a>
                        <span class="text-sm text-gray-500">|</span>
                        <a class="text-sm text-red-600 hover:text-red-900"
                            href="{{ route('courses.destroy', ['course' => $course]) }}">Delete</a>
                    </x-table-data>
                </tr>
                @empty
                <tr>
                    <x-table-data colspan="4">
                        <div class="text-sm text-gray-900">There are no entries recorded in the database.</div>
                    </x-table-data>
                </tr>
                @endforelse
            </tbody>
            <tfoot class="bg-gray-50">
                <tr>
                    <x-table-header colspan="4" class="normal-case">
                        {{ $courses->links() }}
                    </x-table-header>
                </tr>
            </tfoot>
        </table>
    </x-responsive-table>
</x-app-layout>