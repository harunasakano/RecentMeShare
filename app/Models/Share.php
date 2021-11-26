<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Share extends Model
{
    use HasFactory;

    /**
     * guarded
     */
    protected $guarded = [
        'id',
    ];

    public function store($password)
    {
        $res = DB::transaction(function () use($password) {
            return $this->create(['password' => $password]);
        });

        return $res;
    }

    /**
     * @param $share_id
     * @param $pass
     * @return bool
     */
    public function existPass($share_id,$pass)
    {
        if ($this->where('id', $share_id)->where('password', $pass)->exists()) {
            return true;
        }
        return false;
    }
}
