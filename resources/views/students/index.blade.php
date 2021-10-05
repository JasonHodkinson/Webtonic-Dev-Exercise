<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <h1 class="px-6 pt-6">All Students</h1>
        <hr class="mx-6 my-4">

        {{-- Table --}}
        <div class="p-6">
            <x-responsive-table>
                <thead class="bg-gray-50">
                    <tr>
                        <x-table-header>Student Number</x-table-header>
                        <x-table-header>First Name</x-table-header>
                        <x-table-header>Surname</x-table-header>
                        <x-table-header class="hidden sm:table-cell">Last Updated</x-table-header>
                        @if(auth()->user()->is_admin)
                        <x-table-header class="text-right">Actions</x-table-header>
                        @endif
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($students as $student)
                    <tr>
                        <x-table-data>
                            <a class="text-indigo-600 hover:text-indigo-900"
                                href="{{ route('students.show', ['student' => $student]) }}">{{ $student->student_number }}</a>
                        </x-table-data>
                        <x-table-data>
                            <div class="text-sm text-gray-500">{{ $student->first_name }}</div>
                        </x-table-data>
                        <x-table-data>
                            <div class="text-sm text-gray-500">{{ $student->surname }}</div>
                        </x-table-data>
                        <x-table-data class="hidden sm:table-cell">
                            <div class="text-sm text-gray-500">{{ $student->updated_at->diffForHumans() }}</div>
                        </x-table-data>
                        @if(auth()->user()->is_admin)
                        <x-table-data class="text-right">
                            @can('update', $student)
                            <a class="text-sm text-indigo-600 hover:text-indigo-900"
                                href="{{ route('students.edit', ['student' => $student]) }}">Edit</a>
                            @endcan
                            @can(['update', 'delete'], $student)<span class="text-sm text-gray-500">|</span>@endcan
                            @can('delete', $student)
                                <form class="inline" action="{{ route('students.destroy', $student) }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                            
                                    <button type="button" onclick="confirmDelete(this)" class="text-sm text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            @endcan
                        </x-table-data>
                        @endif
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
                            {{ $students->links() }}
                        </x-table-header>
                    </tr>
                </tfoot>
            </x-responsive-table>
        </div>

        {{-- Action Button --}}
        @can('create', \App\Models\Student::class)
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                <x-button-link href=" {{ route('students.create') }}" class="bg-indigo-500 hover:bg-indigo-700">Add a Student</x-button-link>
            </div>
        @endcan
    </div>

    @push('scripts')
    <script type="text/javascript">
        function confirmDelete(e) {
            Swal.fire({
                icon: 'warning',
                title: 'Are you sure you want to delete this student? This can\'t be undone.',
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