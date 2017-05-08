<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
