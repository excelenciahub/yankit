<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;

class JourneyComment extends Model
{
    protected $fillable = ['order_id', 'journey_id', 'comment'];
}
