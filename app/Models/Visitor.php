<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Visitor extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'visitors';
    protected $primary_key = "id";
    protected $fillable = ['ip_address', 'date'];

}
