<div class="pb-6 px-6">
    <div class="grid grid-cols-4 gap-4">
        <div class="col-span-4 sm:col-span-1">
            <label for="code" class="block text-sm font-medium text-gray-700">Course Code</label>
            <x-input type="text" name="code" :invalid="$errors->has('code')"
                value="{{ old('code') ?? $course->code }}" />
            @error('code')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-span-4 sm:col-span-3">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <x-input type="text" name="description" value="{{ old('description') ?? $course->description }}" />
            @error('description')
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