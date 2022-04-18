<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class SemesterExport implements WithMultipleSheets
{
    private $semester;
    
    public function __construct($semester)
    {
        $this->semester = $semester;
    }

    public function sheets(): array
    {
        $sheets = [];
        $sheets[] = new UserSheet();
        $sheets[] = new MissionSheet($this->semester->id);
        $sheets[] = new IdeaSheet($this->semester->missions);
        $sheets[] = new CommentsSheet($this->semester->missions);
        return $sheets;
    }
}
