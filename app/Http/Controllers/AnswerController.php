<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnswerPassword;
use App\Http\Requests\Password;
use App\Services\AnswerService;
use App\Services\QuestionService;
use App\Services\ShareService;
use Illuminate\Support\Facades\URL;

class AnswerController extends Controller
{
    /**
     * @param AnswerService $answerService
     * @param ShareService $shareService
     * @param AnswerPassword $request
     * @return array|string
     */
    public function saveAndCreateUrl(AnswerService $answerService, ShareService $shareService, AnswerPassword $request)
    {
        $pass = $request->input('pass');
        $answer = $request->input('answers');

        try {
            $share_id = $shareService->store($pass);
            $answer_ids = $answerService->store($answer, $share_id);
        } catch (\Exception $e) {
            report($e);
            return ($e->getMessage());
        }

        $pass_count = mb_strlen($pass);

        //パスワードニュアンスお知らせ用
        $replace = '*';
        for ($i = 1; $i <= $pass_count - 3; $i++) {
            $replace .= '*';
        }
        $pass_mosaic = substr_replace($pass, $replace, 1, -1);

        //閲覧期限お知らせ用
        $show_limit = now()->addHours(24)->format('Y年m月d日 H時i分s秒');;

        //share_id発行後にURLを返却
        $url = URL::temporarySignedRoute(
            'answer_show', now()->addHours(24), [$share_id]
        );

        return [
            'show_url' => $url,
            'show_limit' => $show_limit,
            'pass_mosaic' => $pass_mosaic,
        ];
    }

    /**
     * パスワードとIDの組み合わせが照合するかチェックし,結果をbooleanで返す
     * @param Password $request
     * @param ShareService $shareService
     * @return bool
     */
    public function checkPassGetAnswer(Password $request, ShareService $shareService, AnswerService $answerService, QuestionService $questionService)
    {
        $share_id = $request->input('share_id');
        $pass = $request->input('pass');
        $res = $shareService->existPassCheck($share_id,$pass);

        if (!$res) {
            return 'not exist pass';
        }

        $answer_res = $answerService->get($share_id);

        if (!$answer_res) {
            return 'error';
        }

        $question_ids = array_keys($answer_res);
        $question_res = $questionService->getQuestion($question_ids);

        if (!$question_res) {
            return 'error';
        }

        return ['questions' => $question_res,
            'answers' => $answer_res
        ];
    }
}
