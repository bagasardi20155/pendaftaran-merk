<?php

namespace App\Models\Applicant;

use App\Models\Applicant\Brand;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class BrandStatus extends Model
{
    use HasFactory, Notifiable, HasRoles;

    protected $table = "brand_status";
    protected $primary_key = "id";
    protected $fillable = ['id_brand', 'status', 'message'];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'id_brand', 'id');
    }
}
