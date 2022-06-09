<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'name', 'email', 'password', 'country_id', 'phone', 'gender', 'profile', 'role', 'status', 'lang', 'store_name', 'store_description', 'store_profile', 'store_cover', 'store_status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
    ];


    public function store_products()
    {
        return $this->hasMany(StoreProduct::class);
    }

    public function vendor_products()
    {
        return $this->hasMany(Product::class, 'vendor_id');
    }


    public function balance()
    {
        return $this->hasOne(Balance::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function fav()
    {
        return $this->hasMany(Favorite::class);
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }


    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function order_notes()
    {
        return $this->hasMany(OrderNote::class);
    }


    public function vendor_orders()
    {
        return $this->hasMany(VendorOrder::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }


    public function scopeWhenSearch($query, $search)
    {
        return $query->when($search, function ($q) use ($search) {
            return $q->where('phone', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->orWhere('name', 'like', "%$search%")
                ->orWhere('id', 'like', "$search");
        });
    }


    public function scopeWhenCountry($query, $country_id)
    {
        return $query->when($country_id, function ($q) use ($country_id) {
            return $q->where('country_id', 'like', "%$country_id%");
        });
    }

    public function scopeWhenStatus($query, $status)
    {
        return $query->when($status, function ($q) use ($status) {
            if ($status == 'active' || $status == 'inactive') {
                return $status == 'active' ? $q->whereNotNull('phone_verified_at') : $q->whereNull('phone_verified_at');
            } else {
                return $q->where('status', 'like', $status);
            }
        });
    }

    public function scopeWhenRole($query, $role_id)
    {
        return $query->when($role_id, function ($q) use ($role_id) {
            return $this->scopeWhereRole($q, $role_id);
        });
    }

    public function scopeWhereRole($query, $role_name)
    {
        return $query->whereHas('roles', function ($q) use ($role_name) {
            return $q->whereIn('name', (array)$role_name)
                ->orWhereIn('id', (array)$role_name);
        });
    }

    public function scopeWhereRoleNot($query, $role_name)
    {
        return $query->whereHas('roles', function ($q) use ($role_name) {
            return $q->whereNotIn('name', (array)$role_name)
                ->WhereNotIn('id', (array)$role_name);
        });
    }


    public static function getUsers($role_id = null, $from = null, $to = null)
    {



        $users = self::select('id', 'created_at', 'name', 'phone', 'email', 'gender')
            ->whereDate('created_at', '>=', $from)
            ->whereDate('created_at', '<=', $to)
            ->whenRole($role_id)
            ->whereRoleNot('superadministrator')
            ->get()
            ->toArray();


        foreach ($users as $index => $user) {
            $user = User::find($user['id']);
            $roles = $user->getRoles();
            $users[$index]['type'] = $roles;
        }

        $description_ar =  'تم تنزيل شيت المستخدمين';
        $description_en  = 'Users file has been downloaded ';
        addLog('admin', 'exports', $description_ar, $description_en);

        return $users;
    }
}
