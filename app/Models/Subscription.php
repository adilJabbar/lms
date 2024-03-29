<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model {

    use HasFactory;

    protected $table = 'subscriptions';
    protected $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'plans',
        'discount_percentage',
        'is_access_cource',
        'duration',
        'feedback_video_count',
        'webinar_access',
        'yoodli_access',
        'price'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    public static function saveData($data) {
        $results = Subscription::create($data);
        return !empty($results) ? $results->toArray() : [];
    }

    public static function updateData($data) {
        $update = Subscription::where('id', $data['id'])
                ->update(['plans' => $data['plans'],
            'discount_percentage' => $data['discount_percentage'],
            'is_access_cource' => $data['is_access_cource'],
            'duration' => $data['duration'],
            'feedback_video_count' => $data['feedback_video_count'],
            'webinar_access' => $data['webinar_access'],
            'price' => $data['price'],
            'yoodli_access' => $data['yoodli_access']]);
        return ($update) ? true : false;
    }

    public static function getSubscriptions() {
        $results = Subscription::get();
        return !empty($results) ? $results->toArray() : [];
    }

    public static function getSubscription($id) {
        $results = Subscription::where('id', $id)
                ->first();
        return !empty($results) ? $results->toArray() : [];
    }

}
