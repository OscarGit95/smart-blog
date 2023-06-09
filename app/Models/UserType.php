<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;

    protected $table = 'user_types';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'status_id', 'created_at', 'updated_at'
    ];

    public function status(){
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
    
}
