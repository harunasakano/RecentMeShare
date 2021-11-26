<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    /**
     * guarded
     */
    protected $guarded = [
        'id',
    ];

    public function getAll()
    {
        return $this->get();
    }

    /**
     * question_idを複数配列形式で与えられ、合致するレコードを返す
     * @param $question_ids
     */
    public function getByQuestionIds($question_ids)
    {
        return $this->whereIn('id', $question_ids);
    }
}
