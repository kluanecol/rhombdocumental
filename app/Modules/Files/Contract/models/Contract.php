<?php

namespace App\Modules\Invoicing\Contract\models;

use App\Modules\Admin\Client\Models\Client;
use App\Modules\Admin\Project\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Invoicing\ContractConfiguration\models\ContractConfiguration;
use App\Modules\Invoicing\Invoice\models\Invoice;

class Contract extends Model
{

    protected $table = 'contracts';

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


    public function project()
    {
        return $this->belongsTo(Project::class, 'fk_id_project','id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'fk_id_client','id');
    }

    public function configurations()
    {
        return $this->hasMany(ContractConfiguration::class, 'fk_id_contract', 'id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'fk_id_contract', 'id');
    }
}
