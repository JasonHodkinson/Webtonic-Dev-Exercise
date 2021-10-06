<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <h1 class="px-6 pt-6">Displaying Course</h1>
        <hr class="mx-6 my-4">

        <div class="pb-6 px-6">
            <div class="grid grid-cols-4 gap-4 pb-4">
                <div class="col-span-4 sm:col-span-1">
                    <label class="block text-sm font-medium text-gray-700">Course Code</label>
                    <x-input type="text" readonly disabled value="{{ $course->code }}" />
                </div>

                <div class="col-span-4 sm:col-span-3">
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <x-input type="text" readonly disabled value="{{ $course->description }}" />
                </div>

                <div class="col-span-4 sm:col-span-4">
                    <label class="block text-sm font-medium text-gray-700">Last Updated</label>
                    <x-input type="text" readonly disabled value="{{ $course->updated_at->toDayDateTimeString() }}" />
                </div>

                <div class="col-span-4 sm:col-span-4">
                    <label class="block text-sm font-medium text-gray-700">Grades for Course</label>
                    {{-- Table --}}
                    <x-responsive-table class="mt-1">
                        <thead class="bg-gray-50">
                            <tr>
                                <x-table-header>Student Number</x-table-header>
                                <x-table-header>Student Name</x-table-header>
                                <x-table-header class="text-center">Grade</x-table-header>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($course->grades as $grade)
                            <tr>
                                <x-table-data>
                                    <div class="text-sm text-gray-500">{{ $grade->student->student_number }}</div>
                                </x-table-data>
                                <x-table-data>
                                    <div class="text-sm text-gray-500">{{ $grade->student->full_name }}</div>
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
                                    <div class="text-sm text-gray-900">There are no grades yet for this course.</div>
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
            <x-button-link href="{{ route('courses.index') }}">
                Back to Courses
            </x-button-link>
            @can('update', $course)
                <x-button-link href="{{ route('courses.edit', ['course' => $course]) }}" class="bg-indigo-600 hover:bg-indigo-700">
                    Edit
                </x-button-link>
            @endcan
        </div>
    </div>
</x-app-layout>