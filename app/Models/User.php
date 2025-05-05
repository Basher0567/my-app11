<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable=['firstName','lastName','email','mobile','password','otp'];
    //protected $attributes=['otp'=>'0'];
    public function categories()
    {
        return $this->hasMany(Category::class);
    }//end method

    public function products()
    {
        return $this->hasMany(Product::class);
    }//end method

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }//end method

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
    
}
