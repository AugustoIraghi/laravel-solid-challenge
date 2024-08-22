<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class transaction extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'amount', 'author_id'];

    /* public static function boot()
    {
        parent::boot();

        static::created(function ($transaction) {
            Log::info('Transaction created: ' . $transaction->id);
        });
    } */

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
