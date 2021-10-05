<x-app-layout>
    <div class="py-12 px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{ route('grades.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h1>Grades Uploader</h1>
                        <hr class="my-4">
                        <div class="mb-4">
                            <label class="mb-1 block text-sm font-medium text-gray-800" for="csv_document">
                                Upload a .csv file
                            </label>
                            <div class="relative">
                                <x-file-input required name="csv_document" accept=".csv" />
                            </div>
                            @error('csv_document')
                            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                            <div class="mt-1 text-sm text-gray-500">
                                Please note that the delimeter of the .csv should be the <code>;</code> symbol.
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Import
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>