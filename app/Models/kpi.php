<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Support\Str;
use Override;

class kpi extends Model
{
    protected $table = 'kpis';
    protected $primaryKey = 'id';
    protected $fillable = ['id','line','style','year','month','week','day','start_date','end_date'];
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
