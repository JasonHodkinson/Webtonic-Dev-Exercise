<div class="pb-6 px-6">
    <div class="grid grid-cols-1 mb-4">
        <div class="col-span-1">
            <label for="student_number" class="block text-sm font-medium text-gray-700">Student Number</label>
            <x-input type="number" name="student_number" :invalid="$errors->has('student_number')"
                value="{{ old('student_number') ?? $student->student_number }}" />
            @error('student_number')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="grid grid-cols-3 gap-4">
        <div class="col-span-3 sm:col-span-1">
            <label for="first_name" class="block text-sm font-medium text-gray-700">First name</label>
            <x-input type="text" name="first_name" autocomplete="given-name"
                value="{{ old('first_name') ?? $student->first_name }}" />
            @error('first_name')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-span-3 sm:col-span-2">
            <label for="surname" class="block text-sm font-medium text-gray-700">Surname</label>
            <x-input type="text" name="surname" autocomplete="family-name"
                value="{{ old('surname') ?? $student->surname }}" />
            @error('surname')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
    <x-button type="submit" class="bg-indigo-600 hover:bg-indigo-700">
        Submit
    </x-button>
</div>