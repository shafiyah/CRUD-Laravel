<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    use HasFactory;
    protected $table = 'customer';
    protected $primaryKey = 'cst_id';
    public $timestamps = false;
    protected $fillable = ['cst_name',
    'nationality_id',
    'cst_dob' ,
    'cst_email' ,
    'cst_phoneNum'];

    public function nationality()
    {
        return $this->hasOne(Nationality::class, 'nasionality_id', 'nasionality_id');
    }

    public function familyList()
    {
        return $this->hasMany(FamilyList::class, 'cst_id', 'cst_id');
    }

}
