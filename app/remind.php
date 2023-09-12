<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class remind extends Model
{
    protected $table = 'reminds';

    protected $fillable= ['title',
                            'description',
                            'remind_type',
                            'day',
                            'date',
                            'time',
                            'user_id',
                            'active_status'];

    protected $primaryKey = 'id';
}
