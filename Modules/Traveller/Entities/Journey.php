<?php

namespace Modules\Traveller\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Entities\Airport;
use Modules\Admin\Entities\Package;
use Modules\Sender\Entities\Order;
use Modules\Admin\Entities\JourneyComment;
use Carbon\Carbon;

class Journey extends Model
{
    protected $fillable = ['traveller_id', 'departure_airport_id', 'destination_airport_id', 'package_id', 'weight', 'currency_symbol', 'currency_code', 'price', 'title', 'pickup_date', 'pickup_start_time', 'pickup_end_time', 'description', 'note', 'status', 'payment_status'];

    public function getJourneyNoAttribute(){
        return 10000000+$this->id;
    }
    public function traveller()
    {
        return $this->belongsTo(Traveller::class);
    }
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
    public function departure_airport()
    {
        return $this->belongsTo(Airport::class, 'departure_airport_id');
    }
    public function destination_airport()
    {
        return $this->belongsTo(Airport::class, 'destination_airport_id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function comment()
    {
        return $this->hasMany(JourneyComment::class);
    }
    public function getOrderComment($order_id)
    {
        return $this->comment()->where(['order_id'=>$order_id])->first();
    }
    public function getPickupTimeAttribute()
    {
        return $this->pickup_start_time . ' - ' . $this->pickup_end_time;
    }
    public function getPickupStartTimeAttribute($value)
    {
        return Carbon::parse($value)->format('h:i A');
    }
    public function getPickupEndTimeAttribute($value)
    {
        return Carbon::parse($value)->format('h:i A');
    }
    public function setPickupStartTimeAttribute($value)
    {
        $this->attributes['pickup_start_time'] = $this->attributes['pickup_date'] . ' ' . $value;
    }
    public function setPickupEndTimeAttribute($value)
    {
        $this->attributes['pickup_end_time'] = $this->attributes['pickup_date'] . ' ' . $value;
    }
    public function setPickupDateAttribute($value){
        $this->attributes['pickup_date'] = Carbon::parse($value)->format('Y-m-d');
    }
    public function getPriceWithSymbolAttribute(){
        return $this->currency_symbol.''.$this->price;
    }
    public function getTotalPriceWithSymbolAttribute(){
        $price = 0;
        $symbol = '';
        foreach($this->orders as $key=>$val){
            $symbol = $val->items->first()->currency_symbol;
            $price += (($val->items->sum('price')*TRAVELLER_PACKAGE_PERCENT)/100);
        }
        return $symbol.''.$price;
    }
    public function getJourneyDateAttribute(){
        return Carbon::parse($this->created_at)->format('d-m-Y');
    }
}
