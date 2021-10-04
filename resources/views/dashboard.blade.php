<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-3 gap-4">
                <x-stat-card :number="$entries['students']">Students Enrolled</x-stat-card>
                <x-stat-card :number="$entries['courses']">Courses Available</x-stat-card>
                <x-stat-card :number="$entries['grades']">Grades Captured</x-stat-card>
            </div>
        </div>
    </div>
</x-app-layout>