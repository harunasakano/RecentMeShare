<?php

namespace App\Services;
use App\Models\Share;

class ShareService
{
    /**
     * シェアモデルインスタンス
     */
    protected $shares;

    public function __construct(Share $shares)
    {
        $this->shares = $shares;
    }

    /**
     * @throws \Exception
     */
    public function store($password)
    {
        $shares = $this->shares->store($password);
        if(!$shares){
            throw new \Exception("Failed to save shares");
            return;
        }

        return $shares->id;
    }

    /**
     * パスワードとIDの組み合わせが照合した場合true
     *
     * @param $share_id
     * @param $pass
     * @return bool
     */
    public function existPassCheck($share_id,$pass)
    {
        return $this->shares->existPass($share_id,$pass);
    }
}
