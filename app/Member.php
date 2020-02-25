<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public function payments(){
        return $this->hasMany(MemberDetail::class,'member_id');
    }
}
