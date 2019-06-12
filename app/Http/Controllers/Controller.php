<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function counts($micropost) {
        $count_microposts = $micropost->microposts()->count();
        $count_favorites = $micropost->favorites()->count();

        return [
            'count_microposts' => $count_microposts,
            'count_favorites' => $count_favorites,
        ];
    }
}
