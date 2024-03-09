<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class History extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'histories';
    protected $fillable = [
        'image_id',
        'type',
        'prev_history',
        'next_history',
    ];

    public const int TYPE_START = 0;
    public const int TYPE_GAP = 1;
    public const int TYPE_END = 2;

    /**
     * @return string[]
     */
    public static function getTypes(): array
    {
        return [
            self::TYPE_START => 'Начало',
            self::TYPE_GAP => 'Промежуток',
            self::TYPE_END => 'Конец',
        ];
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(
            Image::class,
            'image_id',
            'id',
        );
    }
}
