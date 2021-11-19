<?php
  
namespace App\Exports;
  
use App\Models\Post;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
  
class PostsExport implements FromCollection, WithHeadings, WithColumnFormatting, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Post::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Title', 
            'Description',
            'Status',
            'Create_user_id',
            'Updated_user_id',
            'Deleted_user_id',
            'Created_at',
            'Updated_at',
            'Deleted_at'
        ];
    }

    public function map($post): array
    {
        return [
            $post->id,
            $post->title, 
            $post->description,
            $post->status,
            $post->create_user_id,
            $post->updated_user_id,
            $post->deleted_user_id,
            Date::dateTimeToExcel($post->created_at),
            Date::dateTimeToExcel($post->updated_at),
            $post->deleted_at == null ? "" : date('d/m/Y', strtotime($post->deleted_at)),
        ];
    }

    // Set Date Format
    public function columnFormats(): array
    {
        return [
            'H' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'I' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}