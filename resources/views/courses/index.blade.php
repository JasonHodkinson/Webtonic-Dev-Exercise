<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <h1 class="px-6 pt-6">All Courses</h1>
        <hr class="mx-6 my-4">

        {{-- Table --}}
        <div class="p-6">
            <x-responsive-table>
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
            </x-responsive-table>
        </div>

        {{-- Action Button --}}
        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
            <x-button-link href=" {{ route('courses.create') }}" class="bg-indigo-500 hover:bg-indigo-700">Add a Course</x-button-link>
        </div>
    </div>
</x-app-layout>