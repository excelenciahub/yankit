<?php

namespace Modules\Sender\Entities;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['order_id', 'payment_method', 'payment_date', 'currency_symbol', 'currency_code', 'price', 'description', 'note', 'payment_data', 'payment_status'];

    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function getPriceWithSymbolAttribute(){
        return $this->currency_symbol.''.$this->price;
    }
}
