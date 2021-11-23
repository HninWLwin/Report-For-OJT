<?php

namespace App\Imports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DateTime;

class PostsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
       // dd($row['title'], $row['description'],  auth()->user()->id);
        return new Post([
            'title' => $row['title'],
            'description'=> $row['description'],
            'status'=> $row['status'],
            'create_user_id'=> auth()->user()->id,
            'updated_user_id'=> auth()->user()->id,
            'created_date'=> new DateTime(),
            'updated_date'=> new DateTime()
        ]);
    }
}
