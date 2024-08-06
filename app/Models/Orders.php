<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Lumen\Auth\Authorizable;

use App\Traits\RelationActionBy;


/**
 * @property uuid $id 
 * @property uuid $merchant_id 
 * @property uuid $merchant_menu_id 
 * @property uuid $customer_id 
 * @property integer $qty 
 * @property date $tanggal 
 * @property uuid $created_by 
 * @property uuid $updated_by 
 * @property uuid $deleted_by 

 */
class Orders extends Model
{
    use Authenticatable, Authorizable, HasFactory;
    use SoftDeletes, RelationActionBy, Uuid; 

    /**
     * Table Configuration
     * @var string
     */
    protected $table = 'orders';
    protected $primaryKey = 'id';

    /**
     * List of allowed column to insert / update 
     * @var array
     */
    protected $fillable = [
        'merchant_id', 
        'customer_id', 
        'kode', 
        'tanggal', 
        'created_by', 
        'updated_by', 
        'deleted_by'
    ];

    // disabled timestamps data
    public $timestamps = true;

    protected $keyType = 'string';

    public $incrementing = false;

    // disable update col id
    protected $guarded = ['id'];

    public function Columns() {
        return $this->fillable;
    }

    public function searchRelations() {
        return [
            'customer' => (new User())->Columns(),
            'merchant' => (new Merchant())->Columns(),
        ];
    }

    function merchant()
    {   
        return $this->belongsTo(Merchant::class,'merchant_id');
    }

    function customer()
    {   
        return $this->belongsTo(User::class,'customer_id');
    }

    function details()
    {   
        return $this->hasMany(OrderDetails::class,'order_id');
    }
}        
        