<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <h1 class="px-6 pt-6">Displaying Student</h1>
        <hr class="mx-6 my-4">

        <div class="pb-6 px-6">
            <div class="grid grid-cols-3 gap-4 pb-4">
                <div class="col-span-3 sm:col-span-3">
                    <label class="block text-sm font-medium text-gray-700">Student Number</label>
                    <x-input type="text" readonly disabled value="{{ $student->student_number }}" />
                </div>

                <div class="col-span-3 sm:col-span-1">
                    <label class="block text-sm font-medium text-gray-700">First Name</label>
                    <x-input type="text" readonly disabled value="{{ $student->first_name }}" />
                </div>

                <div class="col-span-3 sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Surname</label>
                    <x-input type="text" readonly disabled value="{{ $student->surname }}" />
                </div>

                <div class="col-span-3 sm:col-span-3">
                    <label class="block text-sm font-medium text-gray-700">Last Updated</label>
                    <x-input type="text" readonly disabled value="{{ $student->updated_at->toDayDateTimeString() }}" />
                </div>

                <div class="col-span-3 sm:col-span-3">
                    <label class="block text-sm font-medium text-gray-700">Grades for Student</label>
                    {{-- Table --}}
                    <x-responsive-table class="mt-1">
                        <thead class="bg-gray-50">
                            <tr>
                                <x-table-header>Course Code</x-table-header>
                                <x-table-header>Description</x-table-header>
                                <x-table-header class="text-center">Grade</x-table-header>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($student->grades as $grade)
                            <tr>
                                <x-table-data>
                                    <div class="text-sm text-gray-500">{{ $grade->course->code }}</div>
                                </x-table-data>
                                <x-table-data>
                                    <div class="text-sm text-gray-500">{{ $grade->course->description }}</div>
                                </x-table-data>
                                <x-table-data class="text-center">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $grade->color }}-100 text-{{ $grade->color }}-800">
                                        {{ $grade->letter }}
                                    </span>
                                </x-table-data>
                            </tr>
                            @empty
                            <tr>
                                <x-table-data colspan="3">
                                    <div class="text-sm text-gray-900">There are no grades yet for this student.</div>
                                </x-table-data>
                            </tr>
                            @endforelse
                        </tbody>
                    </x-responsive-table>
                </div>
            </div>
        </div>

        {{-- Button --}}
        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
            <x-button-link href="{{ route('students.index') }}">
                Back to Students
            </x-button-link>
            @can('update', $student)
                <x-button-link href="{{ route('students.edit', ['student' => $student]) }}" class="bg-indigo-600 hover:bg-indigo-700">
                    Edit
                </x-button-link>
            @endcan
        </div>
    </div>
</x-app-layout>