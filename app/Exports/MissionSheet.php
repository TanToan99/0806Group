<?php

namespace App\Exports;

use App\Models\Mission;
use App\Models\Semester;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class MissionSheet implements FromQuery, WithTitle, WithHeadings
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return Builder
     */
    public function query()
    {
        return Mission
            ::query()
            ->where('semester_id', $this->id);
    }
    
    public function headings(): array
    {
        return [
            'id',
            'name',
            'description',
            'end_at',
            'semester_id',
            'created_at',
            'updated_at'
        ];
    }
    /**
     * @return string
     */
    public function title(): string
    {
        return 'Missions';
    }
}
