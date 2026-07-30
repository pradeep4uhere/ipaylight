<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Settlement extends Model
{
    use HasFactory;

      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * Get the transaction associated with the settlement.
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }


    /**
     * Get the transaction associated with the settlement.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Method Name: 
     */
    public static function getUpcomingSettalment($user_id=null,$type){
        if($user_id!=''){
            $earliestScheduledRecord = DB::table('settlements')
            ->where('scheduled_at', '>', now())
            ->where('user_id', $user_id)
            ->where('is_settled', 0)
            ->orderBy('scheduled_at')
            ->first();
        }else{
            $earliestScheduledRecord = DB::table('settlements')
            ->where('scheduled_at', '>', now())
            ->where('is_settled', 0)
            ->orderBy('scheduled_at')
            ->first();
        }
         // Access the details of the last settled record
         if ($earliestScheduledRecord) {
            if($type=='Time'){
                return $earliestScheduledRecord->scheduled_at;
            }
            if($type=='Amount'){
                return $earliestScheduledRecord->net_amount;
            }
        }else{
            return "0.00";
        }
    }



     /**
     * Method Name: 
     */
    public static function getPreviousSettalment($user_id=null,$type){
        if($user_id!=''){
            $lastSettledRecord = DB::table('settlements')
            ->where('scheduled_at', '<', now())
            ->where('user_id', $user_id)
            ->where('is_settled', 1)
            ->orderBy('scheduled_at','DESC')
            ->first();
        }else{
            $lastSettledRecord = DB::table('settlements')
            ->where('scheduled_at', '<', now())
            ->where('is_settled', 1)
            ->orderBy('scheduled_at','DESC')
            ->first();
        }
        // Access the details of the last settled record
        if ($lastSettledRecord) {
            if($type=='Time'){
                return $lastSettledRecord->scheduled_at;
            }
            if($type=='Amount'){
                return $lastSettledRecord->net_amount;
            }
        }else{
            return "0.00";
        }
    }





    /**
     * Get Today Total Settalment Amount 
     * @param $user_id
     * @return mixed
     */
    public static function getTodaySettalment($user_id){
        $todayDate = Carbon::today();
        $records = Settlement::whereDate('scheduled_at', $todayDate)
        ->where('user_id', $user_id)
        ->where('is_settled', 0)
        ->orderBy('scheduled_at','DESC');
        if($records->count()>0){
            $totalSum = $records->sum('net_amount');
        }else{
            $totalSum = '0.00';
        }
        return $totalSum;
    }




     /**
     * Get Today Total Settalment Amount 
     * @param $user_id
     * @return mixed
     */
    public static function getTodaySettalmentForDs($user_id){
        $todayDate = Carbon::today();
        $records = Settlement::whereDate('scheduled_at', $todayDate)
        ->whereIn('user_id', $user_id)
        ->where('is_settled', 0)
        ->orderBy('scheduled_at','DESC');
        if($records->count()>0){
            $totalSum = $records->sum('net_amount');
        }else{
            $totalSum = '0.00';
        }
        return $totalSum;
    }
}
