<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class CommentsSheet implements FromCollection, WithHeadings, WithTitle
{
    private $missions;

    public function __construct($missions)
    {
        $this->missions = $missions;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $res = [];
        foreach($this->missions as $mission){
            foreach($mission->ideas as $idea){
                $res[] = array_merge($res, $idea->comments->toArray());
            }
        }
        return collect($res);
    }
    
    public function headings(): array
    {
        return [
            'id',
            'content',
            'user_id',
            'idea_id',
            'create_at',
            'updated_at'
        ];
    }
    /**
     * @return string
     */
    public function title(): string
    {
        return 'Comments';
    }
}
