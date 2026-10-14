<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Support\Str;
use Override;

class item_detail extends Model
{
    protected $table = 'item_details';
    protected $primaryKey = 'id';
    protected $fillable = ['id','inspected_id','name','code','qty','persen'];
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
