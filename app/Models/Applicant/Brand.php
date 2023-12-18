<?php

namespace App\Models\Applicant;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Brand extends Model
{
    use HasFactory, Notifiable, HasRoles;

    protected $table = 'brands';
    protected $primary_key = 'id';
    protected $fillable = ['id_user','name','address','owner','logo','suket_umk','applicant_signature'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status');
    }
}
