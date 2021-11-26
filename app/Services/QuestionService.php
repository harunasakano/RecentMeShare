<?php

namespace App\Services;
use App\Models\Question;

class QuestionService
{
    /**
     * クエスチョンモデルインスタンス
     */
    protected $questions;

    public function __construct(Question $questions)
    {
        $this->questions = $questions;
    }

    /**
     * 質問を配列で返す
     * @return array
     */
    public function getAllAndShuffle()
    {
        return $this->questions->getAll()->pluck('content','id')->toArray();
    }

    /**
     * questionインスタンスを加工して配列で返す
     * @param $question_ids
     */
    public function getQuestion($question_ids)
    {
        return $this->questions->getByQuestionIds($question_ids)->pluck('content','id')->toArray();;
    }
}
