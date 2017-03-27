<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Ad;

class AdController extends Controller
{

    public function __construct(Ad $ad)
    {
        $this->ad = $ad;
    }
    public function getRedirect($id)
    {
        $ad = $this->ad->getAd($id);
        if($ad === false){
            return redirect('/');
        }
        return redirect($ad->redirect_url);
    }

}
