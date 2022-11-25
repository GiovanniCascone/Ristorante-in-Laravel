<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Session;

use App\Models\User;
use App\Models\Menu;

class MenuController extends BaseController
{
    public function menu()
    {
        //Controllo accesso
        if(!Session::get('user_id')){
            return redirect('login');
        }
        //Leggiamo l'utente
        $user = User::find(Session::get('user_id'));
        return view('menu')->with('username', $user->username);
    }

        //Chiamata da fetch
        public function mostra()
        {
            //Controllo accesso
            if(!Session::get('user_id')){
                return [];
            }
            //Leggiamo i prodotti
            $menu = Menu::all();
            return $menu;
        }
}