<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'people'; 

    protected $fillable = [
        'first_name',
        'last_name',
        'birth_name',
        'middle_names',
        'date_of_birth',
        'created_by',
    ];

    /**
     * Une personne peut avoir plusieurs enfants.
     */
    public function children()
    {
        return $this->belongsToMany(Person::class, 'relationships', 'parent_id', 'child_id');
    }

    /**
     * Une personne peut avoir plusieurs parents.
     */
    public function parents()
    {
        return $this->belongsToMany(Person::class, 'relationships', 'child_id', 'parent_id');
    }

    /**
     * Une personne a un utilisateur-créateur.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
