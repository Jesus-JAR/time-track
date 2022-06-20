<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $table = "business";
    protected $primaryKey ='id';
    protected $fillable = ['id', 'name', 'address', 'description'];

    public function definition()
    {

    }

    public function user() : \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class);
    }

    public function business() {
        return $this->belongsTo(Business::class);
    }

}
