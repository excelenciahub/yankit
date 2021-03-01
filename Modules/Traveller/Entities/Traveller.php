<?php

namespace Modules\Traveller\Entities;

use App\User;

class Traveller extends User
{
    public function newQuery($excludeDeleted = true) {
        return parent::newQuery($excludeDeleted)->where([$this->table.'.user_type'=>'Traveller']);
    }
}
