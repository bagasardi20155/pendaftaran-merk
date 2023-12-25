<?php

namespace App\Models\Applicant;

use App\Models\User;
use Carbon\Carbon;
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

    public function brand_status()
    {
        return $this->hasMany(BrandStatus::class, 'id_brand', 'id')->orderBy('updated_at', 'desc');
    }
 
    public function lastStatus() {
        return BrandStatus::where('id_brand', $this->id)->latest()->first();
    }
    
    public static function countStatus(String $id_user = null) {
        
        if ($id_user == null) {
            $brands_daily = Brand::whereDate('created_at', Carbon::today())->get();
            $brands_monthly = Brand::whereMonth('created_at', Carbon::now()->format('m'))->get();
            $brands_annually = Brand::whereYear('created_at', Carbon::now()->format('Y'))->get();
        } else {
            $brands_daily = Brand::where('id_user', auth()->user()->id)->whereDate('created_at', Carbon::today())->get();
            $brands_monthly = Brand::where('id_user', auth()->user()->id)->whereMonth('created_at', Carbon::now()->format('m'))->get();
            $brands_annually = Brand::where('id_user', auth()->user()->id)->whereYear('created_at', Carbon::now()->format('Y'))->get(); 
        }
        
        //insert brands to status
        $status_daily = [];
        $status_monthly = [];
        $status_annually = [];

        foreach ($brands_daily as $brand) {
            $status_daily[] = $brand->lastStatus();
        }
        foreach ($brands_monthly as $brand) {
            $status_monthly[] = $brand->lastStatus();
        }
        foreach ($brands_annually as $brand) {
            $status_annually[] = $brand->lastStatus();
        }
        
        return [
            'total_daily' => collect($status_daily)->count(),
            'total_monthly' => collect($status_monthly)->count(),
            'total_annually' => collect($status_annually)->count(),

            'process_daily' => collect($status_daily)->where('status', 'waiting')->count() + collect($status_daily)->where('status', 'revision')->count() + collect($status_daily)->where('status', 'revised')->count(),
            'process_monthly' => collect($status_monthly)->where('status', 'waiting')->count() + collect($status_monthly)->where('status', 'revision')->count() + collect($status_monthly)->where('status', 'revised')->count(),
            'process_annually' => collect($status_annually)->where('status', 'waiting')->count() + collect($status_annually)->where('status', 'revision')->count() + collect($status_annually)->where('status', 'revised')->count(),
            
            'finish_daily' => collect($status_daily)->where('status', 'accepted')->count() + collect($status_daily)->where('status', 'rejected')->count(),
            'finish_monthly' => collect($status_monthly)->where('status', 'accepted')->count() + collect($status_monthly)->where('status', 'rejected')->count(),
            'finish_annually' => collect($status_annually)->where('status', 'accepted')->count() + collect($status_annually)->where('status', 'rejected')->count(),
        ];
    }
}
