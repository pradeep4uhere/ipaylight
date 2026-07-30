<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'subject', 'description', 'status','document_file'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }




    public static function getLatestSupportTickets($user=null){
        if($user){
            if($user->role=='distributor'){
                $userIds = User::where('parent_id', getAuthValue('id'))->pluck('id');
                $ticketList = Ticket::with('Replies','Replies.user')
                ->whereIn('user_id',$userIds)
                ->orderBy('id','DESC')->paginate(10);
            }else{
                $ticketList = Ticket::with('Replies','Replies.user')
                ->where('user_id',getAuthValue('id'))
                ->orderBy('id','DESC')->paginate(10);
            }
        }else{
            $ticketList = Ticket::with('Replies','Replies.user')->orderBy('id','DESC')->paginate(10);
        }
        return $ticketList;

    }
}
