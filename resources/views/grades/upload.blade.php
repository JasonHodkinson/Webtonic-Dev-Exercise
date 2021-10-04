<x-app-layout>
    <div class="py-12 px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('grades.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-span-6">
                            <label for="grades" class="block text-sm font-medium text-gray-700">Upload Grades</label>
                            <input type="file" accept=".csv" name="grades" class="mt-1">
                        </div>
                        <div class="text-right">
                            <x-button type="submit" class="text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Submit</x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>