<?php

namespace App\Models;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier_Detail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'supplier__details';
    protected $guarded = [];

    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

}
