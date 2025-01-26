<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    use HasFactory;

    protected $table = 'relationships';

    protected $fillable = [
        'created_by',
        'parent_id',
        'child_id',
    ];

    /**
     *  get parent
     */
    public function parent()
    {
        return $this->belongsTo(Person::class, 'parent_id');
    }

    /**
     *  get child
     */
    public function child()
    {
        return $this->belongsTo(Person::class, 'child_id');
    }
}
