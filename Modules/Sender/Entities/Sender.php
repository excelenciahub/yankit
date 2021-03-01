<?php

namespace Modules\Sender\Entities;

use App\User;

class Sender extends User
{
    public function newQuery($excludeDeleted = true) {
        return parent::newQuery($excludeDeleted)->where([$this->table.'.user_type'=>'Sender']);
    }
}
