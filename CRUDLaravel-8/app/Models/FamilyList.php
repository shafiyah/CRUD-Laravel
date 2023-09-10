<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyList extends Model
{
    use HasFactory;
    protected $table = 'family_list';
    protected $primaryKey = 'fl_id';
    public $timestamps = false;
    protected $fillable = [
    'fl_relation',
    'fl_name',
    'fl_dob'];
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cst_id', 'cst_id');
    }


}
