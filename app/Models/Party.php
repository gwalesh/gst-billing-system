<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;

     // Table Name
    protected $table = "parties";

    // Primary key
    protected $primaryKey = "id";

    // Fillable columns
    protected $fillable = array(
        "party_type",
        "full_name",
        "phone_no",
        "address",
        "account_holder_name",
        "account_no",
        "bank_name",
        "ifsc_code",
        "branch_address",
        "gstin",
        "pincode"
    );

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($party) {
            if (is_null($party->account_holder_name)) {
                $party->account_holder_name = $party->full_name;
            }
        });
    }
    
    public function gstBills()
    {
        return $this->hasMany(GstBill::class);
    }

    
}
