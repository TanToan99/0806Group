<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class UserSheet implements FromCollection, WithTitle, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $users = User::all();
        $res = [];
        foreach($users as $user){
            $res[] = [
                $user->id,
                $user->name,
                $user->email,
                $user->phone_number,
                $user->role->name,
                ($user->department) ? $user->department->name : "" 
            ];
        }
        return collect($res);
    }

    public function headings(): array
    {
        return ['id','name','email','phone','role','department'];
    }
    /**
     * @return string
     */
    public function title(): string
    {
        return 'Users';
    }
}
