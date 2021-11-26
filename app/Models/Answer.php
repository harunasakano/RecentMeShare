<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Answer extends Model
{
    use HasFactory;

    /**
     * guarded
     */
    protected $guarded = [
        'id',
    ];

    /**
     * answerを複数保存、成功の場合保存した分のidを返却
     *
     * @param $answers
     * @param $share_id
     * @return mixed
     */
    public function store($answers, $share_id)
    {
        $sort = 0;
        $ids = DB::transaction(function () use ($answers, $share_id, $sort) {
            foreach ($answers as $qid => $answer) {
                $tmp = $this->create([
                    'question_id' => $qid,
                    'share_id' => $share_id,
                    'sort' => $sort,
                    'answer' => $answer
                ]);
                $sort++;
                $ids[] = $tmp->id;
            }
            return $ids;
        });

        return $ids;
    }

    /**
     * @param $share_id
     * @return null
     */
    public function get($share_id)
    {
        $res = $this->where('share_id',$share_id);
        if($res){
            return $res->pluck('answer','question_id')->toArray();
        }
        return null;
    }

}
