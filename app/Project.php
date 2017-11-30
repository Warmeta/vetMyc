<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Project extends Model
{
    protected $fillable = [
        'project_name',
        'description',
        'image',
        'project_type',
        'research_line',
        'publication_date',
        'entity',
        'author_id',
        'project_status',
        'link',
        'file',
    ];

    public function collaborators() {
        return $this->belongsToMany(User::class, 'project_collaborators', 'project_id', 'collaborator_id');
    }
}
