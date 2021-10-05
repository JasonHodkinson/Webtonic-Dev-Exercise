<x-app-layout>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <x-stat-card :number="$entries['students']">Students Enrolled</x-stat-card>
        <x-stat-card :number="$entries['courses']">Courses Available</x-stat-card>
        <x-stat-card :number="$entries['grades']">Grades Captured</x-stat-card>
    </div>
</x-app-layout>