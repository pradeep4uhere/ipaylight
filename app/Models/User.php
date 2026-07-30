<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\UserContact;
use App\Models\PaymentLink;
use App\Models\UserCommissionSetting;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

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
        'password' => 'hashed',
    ];

    /**
     * User Has Many Contacts
     */
    public function contacts()
    {
        return $this->hasMany(UserContact::class);
    }



    /***
     * Relation with PaymentLink Model
     */
    public function paymentLinks(): HasMany
    {
        return $this->hasMany(PaymentLink::class);
    }






    /**
     * Save Profile Data
     */
    public static function saveProfileData(Array $data){
        $user = User::find(Auth::user()->id);
        foreach($data as $k=>$v){
            $user->$k = $v;
        }
        $user->save();
    }


    /**
     * Get All Customer List From User Table
     */
    public function getAllCustomerList(){
        $user = User::orderBy('id', 'desc')->get();
        return $user;
    }



    /**
     * Get All Retailer List From User Table
     */
    public function getAllRetailerList(){
        $user = User::where('role','user')->get();
        return $user;
    }



    /**
     * Get the login history entries associated with the user.
     */
    public function loginHistories()
    {
        return $this->hasMany(LoginHistory::class);
    }


     /**
     * Get the login history entries associated with the user.
     */
    public function Wallet()
    {
        return $this->hasOne(Wallet::class);
    }



    public function resolveRouteBinding($value, $field = null)
    {
        $decryptedId = Crypt::decryptString($value);
        return $this->with('Wallet')->where('id', $decryptedId)->firstOrFail(); // Decrypt and find the user
    }


    /**
     * Get the transactions associated with the user.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }


    /**
     * Method Name: Get Distributor User Object
     * Get Distributor Details based on Agent User  ID
     * @param int $agentUserID - Agent User Id
     * Returns object of distributor details if found otherwise returns false
     */
    public function distributor()
    {
        return $this->belongsTo(User::class, 'parent_id'); // Assuming 'parent_id' is the foreign key in the users table referencing the distributor's id
    }





    /**
     * Method Name: UserCommissionRate()
     * @param int $user_id
     * @param int $gatewayId 
     * @param string $paymentType
     */
    public static function UserCommissionRate(int $user_id, int $gatewayId, string $paymentType)
    {
       $userCommissionDetails =  UserCommissionSetting::with('Gateway')->where('user_id',$user_id)
        ->where('gateway_id',$gatewayId)
        ->where('payment_type',$paymentType)
        ->first();
        if($userCommissionDetails){
            return $userCommissionDetails;
        }else{
            return null;
        }
    }


    /**
     * Get the settlements for the user.
     */
    public function settlements()
    {
        return $this->hasMany(Settlement::class);
    }

    public function settlementSetting()
    {
        return $this->hasOne(SettlementSetting::class);
    }



    /**
     * Method Name: UserCommissionRate()
     * @param int $user_id
     * @param int $gatewayId 
     * @param string $paymentType
     */
    public static function isUserCommissionConfigured(int $user_id)
    {
        $userCommissionCount = UserCommissionSetting::where('user_id', $user_id)->count();
    
        return $userCommissionCount > 0 ? $userCommissionCount : null;
    }
    


    /**
     * Get the login history entries associated with the user.
     */
    public function userContacts()
    {
        return $this->hasMany(userContact::class);
    }



    /**
     * Get the login history entries associated with the user.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }



    // Other model properties and methods
 /**
     * Define a relationship to get all distributors under a specific superdistributor.
     */
    public function distributors()
    {
        return $this->hasMany(User::class, 'parent_id')->where('role', 'distributor');
    }

    /**
     * Define a relationship to get all retailers under a specific superdistributor.
     */
    public function retailers()
    {
        return $this->hasManyThrough(
            User::class, // Final model to reach (retailers)
            User::class, // Intermediate model (distributors)
            'parent_id', // Foreign key on intermediate model (distributor's parent_id)
            'id', // Local key on final model (retailer's id)
            'id', // Local key on intermediate model (distributor's id)
            'parent_id' // Foreign key on superdistributor model (superdistributor's id)
        )->where('users.role', 'retailer'); // Filter by role 'retailer'
    }

    
}
