<x-app-layout>
    <x-responsive-table>
        <thead class="bg-gray-50">
            <tr>
                <x-table-header>Student</x-table-header>
                <x-table-header>Course Code</x-table-header>
                <x-table-header class="text-center">Grade</x-table-header>
                <x-table-header class="hidden sm:table-cell">Last Updated</x-table-header>
                <x-table-header class="text-right">Actions</x-table-header>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($grades as $grade)
            <tr>
                <x-table-data>
                    <div class="text-sm font-medium text-gray-900">
                        <a class="text-indigo-600 hover:text-indigo-900"
                            href="{{ route('students.show', ['student' => $grade->student]) }}">{{ $grade->student->full_name }}</a>
                    </div>
                    <div class="text-sm text-gray-500">{{ $grade->student->student_number }}</div>
                </x-table-data>
                <x-table-data>
                    <div class="text-sm text-gray-900">
                        <a class="text-indigo-600 hover:text-indigo-900"
                            href="{{ route('courses.show', ['course' => $grade->course]) }}">{{ $grade->course->description }}</a>
                    </div>
                    <div class="text-sm text-gray-500">{{ $grade->course->code }}</div>
                </x-table-data>
                <x-table-data class="text-center">
                    <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $grade->color }}-100 text-{{ $grade->color }}-800">
                        {{ $grade->letter }}
                    </span>
                </x-table-data>
                <x-table-data class="hidden sm:table-cell">
                    <div class="text-sm text-gray-500">{{ $grade->updated_at->diffForHumans() }}
                    </div>
                </x-table-data>
                <x-table-data class="text-right">
                    <a class="text-sm text-red-600 hover:text-red-900"
                        href="{{ route('grades.destroy', ['grade' => $grade]) }}">Delete</a>
                </x-table-data>
            </tr>
            @empty
            <tr>
                <x-table-data colspan="5">
                    <div class="text-sm text-gray-900">There are no entries recorded in the database.</div>
                </x-table-data>
            </tr>
            @endforelse
        </tbody>
        <tfoot class="bg-gray-50">
            <tr>
                <x-table-header colspan="5" class="normal-case">
                    {{ $grades->links() }}
                </x-table-header>
            </tr>
        </tfoot>
    </x-responsive-table>
</x-app-layout>