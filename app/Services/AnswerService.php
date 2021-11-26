<?php

namespace App\Services;
use App\Models\Answer;

class AnswerService
{
    /**
     * アンサーモデルインスタンス
     */
    protected $answers;

    public function __construct(Answer $answers)
    {
        $this->answers = $answers;
    }

    /**
     *
     * @throws \Exception
     */
    public function store($answer,$share_id)
    {
        $answer_ids = $this->answers->store($answer,$share_id);

        foreach ($answer_ids as $answer_id){
            if(!is_numeric($answer_id)){
                throw new \Exception("$answer_id Failed to save answers");
                return;
            }
        }
        return $answer_ids;
    }

    /**
     * @param $share_id
     * @return null
     */
    public function get($share_id)
    {
        return $this->answers->get($share_id);
    }

    public function processingAnswer($question_ids,$question_contents)
    {
        dump($question_ids);
        dd($question_contents);
    }
}
