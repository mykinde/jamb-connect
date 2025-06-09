<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            'Mathematics', 'English Language', 'Physics', 'Chemistry', 'Biology',
            'Further Mathematics', 'Economics', 'Government', 'Literature-in-English',
            'Christian Religious Studies', 'Islamic Religious Studies', 'Geography',
            'Agricultural Science', 'Civic Education', 'Data Processing', 'Technical Drawing'
        ];

        foreach ($subjects as $subjectName) {
            Subject::firstOrCreate(['name' => $subjectName]);
        }
    }
}