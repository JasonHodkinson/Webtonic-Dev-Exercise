<x-app-layout>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pb-4">
        <x-stat-card :number="$entries['students']">Students Enrolled</x-stat-card>
        <x-stat-card :number="$entries['courses']">Courses Available</x-stat-card>
        <x-stat-card :number="$entries['grades']">Grades Captured</x-stat-card>
    </div>

    <x-responsive-table>
        <thead class="bg-gray-50">
            <tr>
                <x-table-header>Student</x-table-header>
                <x-table-header>Course Code</x-table-header>
                <x-table-header class="text-center">Grade</x-table-header>
                <x-table-header class="hidden sm:table-cell">Last Updated</x-table-header>
                @if(auth()->user()->is_admin)
                <x-table-header class="text-right">Actions</x-table-header>
                @endif
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
                @can('delete', $grade)
                <x-table-data class="text-right">
                    <form action="{{ route('grades.destroy', $grade) }}"
                        method="POST">
                        @csrf
                        @method("DELETE")

                        <button type="button" onclick="confirmDelete(this)" class="text-sm text-red-600 hover:text-red-900">Delete</button>
                    </form>
                </x-table-data>
                @endcan
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

    @push('scripts')
    <script type="text/javascript">
        function confirmDelete(e) {
            Swal.fire({
                icon: 'warning',
                title: 'Are you sure you want to delete this grade? This can\'t be undone.',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                confirmButtonColor: '#ff7851'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.closest("form").submit();
                }
            });
        }
    </script>
    @endpush
</x-app-layout>