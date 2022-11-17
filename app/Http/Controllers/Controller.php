<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use function PHPUnit\Framework\throwException;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function razdel(int $id)
    {
        switch($id) {
            case 1:
                return view('razdel 1');
                break;
            case 2:
                return view('razdel 2');
                break;
            case 3:
                return view('razdel 3');
                break;
            case 4:
                return view('razdel 4');
                break;
            default:
                //throw 404
            break;
        }
    }
    
    public function vodogrei(int $id) {
        //подтягиваем водогрей из базы
        //передаем объект во view
        
    }

    public function kotelki() {
        //
        //
    }

}
