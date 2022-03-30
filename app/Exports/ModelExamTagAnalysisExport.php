<?php

namespace App\Exports;

use App\Models\ExamTag;
use App\Models\McqTotalResult;
use App\Models\ModelExam;
use App\Models\User;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class ModelExamTagAnalysisExport implements FromCollection, WithHeadings, ShouldAutoSize, WithColumnFormatting, WithMapping
{
    use Exportable;

    private $fileName = 'tagAnalysis.xlsx';

    private $writerType = Excel::XLSX;

    private $headers = [
        'Content-Type' => 'text/csv',
    ];

    protected $examId;

    public function __construct($examId)
    {
        $this->examId = $examId;
    }

    public function headings(): array
    {
        return [
            "Exam",
            "Tag",
            "Questions",
            "Accuracy",
        ];
    }

    public function map($row): array
    {

        return [
            $row->selectedExam,
            $row->name,
            $row->usedInNumberOfQuestions($this->examId),
            $row->accuracy,
        ];
    }

    public function columnFormats(): array
    {
        return [];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $examId = $this->examId;
        $tags =  ExamTag::query()->whereHas('modelMcqTagAnalysis', function ($q) use ($examId) {
            $q->where('model_exam_id',$examId);
        })->with('modelMcqTagAnalysis')->get();
        $selectedExam = ModelExam::query()->find($examId);

        foreach($tags as $tag){
            $individual = $this->individual($tag->modelMcqTagAnalysis);
            $tag->accuracy = $individual['accuracy'];
            unset($tag->modelMcqTagAnalysis);

            $tag->selectedExam = $selectedExam->title;
        }

        return $tags;
    }

    protected function individual($analysis)
    {
        $singleStudent = [];
        $studentIds = [];
        $totalPercentage = 0;
        foreach ($analysis as $key => $value) {
            if (!in_array($value->student_id, $studentIds)) {
                array_push($studentIds, $value->student_id);
            }
        }
        $student_count = count($studentIds);

        foreach ($studentIds as $student) {
            $scored_marks = 0;
            $tags = 0;
            foreach ($analysis as $value) {
                if ($student == $value->student_id) {
                    $tags += 1;
                    $scored_marks += $value->gain_marks;
                }
            }
            $scored_marks = $scored_marks > 0 ? $scored_marks : 0;
            array_push($singleStudent, [
                'id' => $student,
                'marks' => $scored_marks,
                'tags' => $tags,
                'percentage' => $tags > 0 ? round((($scored_marks / $tags) * 100), 2) : 0
            ]);
        }

        foreach ($singleStudent as $data) {
            $totalPercentage += $data['percentage'];
        }

        return [
            'accuracy' => (int)$totalPercentage / $student_count,
            'student_count' => $student_count
        ];
    }
}
