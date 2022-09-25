<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['shortContent'];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['book'];

    protected $casts = [
        'created_at'  => 'date:Y',
        'updated_at'  => 'date:Y',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    protected function getShortContentAttribute(){
        return mb_substr($this->content, 0, 100) . '...';
    }
}
