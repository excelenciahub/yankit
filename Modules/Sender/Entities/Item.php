<?php

namespace Modules\Sender\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Entities\Package;

class Item extends Model
{
    protected $fillable = ['order_id', 'package_id', 'weight', 'description', 'delevery_date', 'payment_date', 'currency_symbol', 'currency_code', 'price', 'status', 'payment_status'];

    public function package(){
        return $this->belongsTo(Package::class);
    }

    public function getPriceWithSymbolAttribute(){
        return $this->currency_symbol.''.$this->price;
    }
}
