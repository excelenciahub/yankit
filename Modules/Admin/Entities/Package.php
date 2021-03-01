<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = ['weight', 'price', 'currency_symbol', 'currency_code'];

    public function getPriceWithSymbolAttribute(){
        return $this->currency_symbol.''.$this->price;
    }
    public function getTravellerPriceAttribute(){
        return ($this->price*TRAVELLER_PACKAGE_PERCENT)/100;
    }
    public function getTravellerPriceWithSymbolAttribute(){
        return $this->currency_symbol.''.$this->traveller_price;
    }
}
