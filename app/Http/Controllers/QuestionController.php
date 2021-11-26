<?php

namespace App\Http\Controllers;
use App\Services\QuestionService;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * @param QuestionService $questionService
     * @return array
     */
    public function getAll(QuestionService $questionService)
    {
        return $questionService->getAllAndShuffle();
    }
}
