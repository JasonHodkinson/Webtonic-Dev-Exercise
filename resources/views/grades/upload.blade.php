<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <form action="{{ route('grades.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="p-6">
                <h1>Grades Uploader</h1>
                <hr class="my-4">

                <div class="bg-yellow-100 text-yellow-900 shadow-sm rounded p-3 mb-4">
                    <label>Things to note:</label>
                    <ul class="list-disc list-inside">
                        <li>The first row must contain the following headers:</li>
                        <ul class="list-disc list-inside ml-4">
                            <li>Student Number</li>
                            <li>Firstname</li>
                            <li>Surname</li>
                            <li>Course Code</li>
                            <li>Course Description</li>
                            <li>Grade</li>
                        </ul>
                        <li>If the student number matches an existing student, they will be updated with the new first name and surname if it differs.</li>
                        <li>If the course code matches an existing course, it will be updated with the new course description if it differs.</li>
                        <li>The available grade letters are: {{ implode(', ', \App\Models\Grade::availableLetters()) }}</li>
                    </ul>
                </div>
                
                <div class="mb-4">
                    <label class="mb-1 block text-sm font-medium text-gray-800" for="csv_document">
                        Upload a .csv file
                    </label>
                    <div class="relative">
                        <x-file-input required name="csv_document" accept=".csv" :invalid="$errors->has('csv_document')" />
                    </div>
                    @error('csv_document')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                    @enderror
                    <div class="mt-1 text-sm text-gray-500">
                        Please note that the delimeter of the .csv should be the <code>;</code> symbol and the file should not exceed 10MB.
                    </div>
                </div>

                @if ($errors->hasBag('csv'))
                    <div class="bg-red-100 text-red-900 shadow-sm rounded p-3 mb-4">
                        <label>Errors in CSV:</label>
                        <ul class="list-disc list-inside">
                            @foreach ($errors->csv->all() as $message)
                            <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Import
                </button>
            </div>
        </form>
    </div>
</x-app-layout>