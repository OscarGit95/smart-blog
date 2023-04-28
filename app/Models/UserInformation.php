<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    use HasFactory;

    protected $table = 'user_information';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id', 'name', 'last_name', 'username', 'age', 'profile_picture', 'created_at', 'updated_at'
    ];



    public function user(){
        return $this->hasOne(User::class);
    }

}
