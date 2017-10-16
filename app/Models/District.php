<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
	public function deputy()
    {
	    return $this->belongsTo(Deputy::class, 'id', 'district_id');
    }
}
