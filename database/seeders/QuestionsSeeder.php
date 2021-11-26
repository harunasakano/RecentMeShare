<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = [
            '直近で食べたものは？',
            '今食べたいなと思ってるものは？',
            '最近運動した？',
            '直近で地味にへこんだ出来事は？',
            'よく眠れてる？',
            '体調万全の状態を100点とすると今はどのくらい？',
            '最近言われてなるほどと思ったこと',
            'ストレス、悩み、イライラ無し！爽快の状態を100点とすると今の状態は？',
            '「3年前と比べると、変わったな〜自分。」と思った出来事',
            '最近気付いた生活や仕事のハック',
            '最近の気になるニュースは？',
        ];


        foreach ($questions as $question) {
            DB::table('questions')->insert([
                'category' => 0,
                'content' => $question,
                'created_at' => Carbon::now('Asia/Tokyo'),
                'updated_at' => Carbon::now('Asia/Tokyo'),
            ]);
        }
    }
}
