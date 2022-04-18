<?php

namespace App\Exports;

use App\Models\Semester;
use Cog\Laravel\Love\ReactionType\Models\ReactionType;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class IdeaSheet implements FromCollection, WithHeadings, WithTitle
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
                $res[] = [
                    $idea->id,
                    $idea->title,
                    $idea->content,
                    $idea->user_id,
                    $idea->mission_id,
                    $idea->created_at,
                    $idea->updated_at,
                    $idea->view_count,
                    $idea->getLoveReactant()->getReactionCounterOfType(ReactionType::fromName('Like'))->getCount(),
                    $idea->getLoveReactant()->getReactionCounterOfType(ReactionType::fromName('Dislike'))->getCount(),
                    $idea->comments->count()
                ];
            }
        }
        return collect($res);
    }

    public function headings(): array
    {
        return [
            'id',
            'title',
            'content',
            'user_id',
            'mission_id',
            'create_at',
            'updated_at',
            'view_count',
            'like_count',
            'dislike_count',
            'comment_count'
        ];
    }
    /**
     * @return string
     */
    public function title(): string
    {
        return 'Ideas';
    }
}
