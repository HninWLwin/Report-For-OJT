<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'posts';
    public $timestamps = true;

   /**
     * Get the owner of the post
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function user()
    {
      return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'title', 
        'description', 
        'status',
        'create_user_id',
        'updated_user_id',
        'deleted_user_id',
        'deleted_at',
    ];
}
