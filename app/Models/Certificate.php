<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'program',
        'faculty',
        'originality',
        'similitude',
        'date',
        // 'code',
        'observation',
    ];
    public function authors()
    {
        return $this->belongsTo(Author::class,'author_id');
    }
    public function advisers()
    {
        return $this->belongsTo(Adviser::class,'adviser_id');
    }
}
