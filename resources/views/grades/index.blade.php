<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <x-table-header>Student</x-table-header>
                                        <x-table-header>Course Code</x-table-header>
                                        <x-table-header class="text-center">Grade</x-table-header>
                                        <x-table-header>Last Updated</x-table-header>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($grades as $grade)
                                        <tr>
                                            <x-table-data>
                                                <div class="text-sm font-medium text-gray-900">
                                                    <a class="text-indigo-600 hover:text-indigo-900" href="{{ route('students.show', [$grade->student]) }}">{{ $grade->student->full_name }}</a>
                                                </div>
                                                <div class="text-sm text-gray-500">{{ $grade->student->student_number }}</div>
                                            </x-table-data>
                                            <x-table-data>
                                                <div class="text-sm text-gray-900">
                                                    <a class="text-indigo-600 hover:text-indigo-900" href="{{ route('courses.show', [$grade->course]) }}">{{ $grade->course->description }}</a>
                                                </div>
                                                <div class="text-sm text-gray-500">{{ $grade->course->code }}</div>
                                            </x-table-data>
                                            <x-table-data class="text-center">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $grade->color }}-100 text-{{ $grade->color }}-800">
                                                    {{ $grade->letter }}
                                                </span>
                                            </x-table-data>
                                            <x-table-data>
                                                <div class="text-sm text-gray-500">{{ $grade->updated_at->diffForHumans() }}</div>
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
                                            {{ $grades->links() }}
                                        </x-table-header>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>