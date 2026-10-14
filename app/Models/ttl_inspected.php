<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Support\Str;
use Override;

class ttl_inspected extends Model
{
    protected $table = 'ttl_inspecteds';
    protected $primaryKey = 'id';
    protected $fillable = ['id','kpi_id','inspedted','dispacted_1','persen_dispacted_1','dispacted_2','persen_dispacted_2'];
    public $softDeleted =  true;

    use HasUlids;
    
    #[Override]
    public function uniqueIds()
    {
        return ['id'];
    }

    #[Override]
    public function newUniqueId()
    {
        return strtolower((string) Str::ulid());
    }
}
