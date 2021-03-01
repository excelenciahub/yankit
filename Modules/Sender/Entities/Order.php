<?php

namespace Modules\Sender\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Entities\Airport;
use Modules\Traveller\Entities\Journey;
use Modules\Admin\Entities\JourneyComment;
use Carbon\Carbon;

class Order extends Model
{
    protected $fillable = ['sender_id', 'journey_id', 'departure_airport_id', 'destination_airport_id', 'package_id', 'title', 'weight', 'pickup_date', 'pickup_start_time', 'pickup_end_time', 'description', 'note', 'delevery_date', 'status', 'payment_status', 'custom_address'];

    public function sender(){
        return $this->belongsTo(Sender::class);
    }
    public function journey(){
        return $this->belongsTo(Journey::class);
    }
    public function items(){
        return $this->hasMany(Item::class);
    }
    public function payment(){
        return $this->hasOne(Payment::class);
    }
    public function departure_airport(){
        return $this->belongsTo(Airport::class, 'departure_airport_id');
    }
    public function destination_airport(){
        return $this->belongsTo(Airport::class, 'destination_airport_id');
    }
    public function journey_comment(){
        return $this->hasOne(JourneyComment::class)->whereNull('journey_id');
    }
    public function getPickupTimeAttribute(){
        return $this->pickup_start_time . ' - ' . $this->pickup_end_time;
    }
    public function getOrderDateAttribute(){
        return Carbon::parse($this->created_at)->format('d-m-Y');
    }
    public function getDeleveryDateFormatAttribute(){
        return $this->delevery_date==''?$this->delevery_date:Carbon::parse($this->delevery_date)->format('M d,Y');
    }
    public function getOrderNoAttribute(){
        return 10000000+$this->id;
    }
    public function getWeightsAttribute(){
        return implode(', ', $this->items()->pluck('weight')->toArray());
    }
    public function getPriceWithSymbolAttribute(){
        return $this->items()->first()->currency_symbol.''.$this->items()->sum('price');
    }
    public function getTravellerPriceAttribute(){
        return ($this->items()->sum('price')*TRAVELLER_PACKAGE_PERCENT)/100;
    }
    public function getTravellerPriceWithSymbolAttribute(){
        return $this->items()->first()->currency_symbol.''.$this->traveller_price;
    }
    public function getDescriptionsAttribute(){
        return implode(', ', $this->items()->pluck('description')->toArray());
    }
    public function getPickupStartTimeAttribute($value)
    {
        return Carbon::parse($value)->format('h:i A');
    }
    public function getPickupEndTimeAttribute($value)
    {
        return Carbon::parse($value)->format('h:i A');
    }
    public function setPickupDateAttribute($value){
        $this->attributes['pickup_date'] = Carbon::parse($value)->format('Y-m-d');
    }
    public function setPickupStartTimeAttribute($value){
        $this->attributes['pickup_start_time'] = $this->attributes['pickup_date'].' '.$value;
    }
    public function setPickupEndTimeAttribute($value){
        $this->attributes['pickup_end_time'] = $this->attributes['pickup_date'].' '.$value;
    }
}
