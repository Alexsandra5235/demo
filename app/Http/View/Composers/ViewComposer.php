<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Session;

class ViewComposer
{
    public function compose(View $view) : void
    {
        $view->with('user', Session::get('user'));
    }

}
