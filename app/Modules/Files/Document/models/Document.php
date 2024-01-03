<?php

namespace App\Modules\Files\Document\models;

use App\Modules\Admin\Client\Models\Client;
use App\Modules\Admin\Project\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{

    protected $table = 'documents';

    protected $primaryKey= 'id';

    protected $fillable = [
        'fk_id_user',
        'fk_id_project',
        'fk_id_country',
        'fk_id_client',
        'initial_date',
        'end_date',
        'year',
        'name',
        'consecutive'
    ];

    public $timestamps = true;

    use SoftDeletes;

}
