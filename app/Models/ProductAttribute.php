<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $table = "product_attributes";
    protected $guarded = [];


    public function attribute(){
        return $this->belongsTo(Attribute::class);
    }
}
