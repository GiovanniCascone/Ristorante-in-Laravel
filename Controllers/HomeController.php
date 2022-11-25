<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Session;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;

class HomeController extends BaseController
{
    public function home()
    {
        //Controllo accesso
        if(!Session::get('user_id')){
            return redirect('login');
        }
        //Leggiamo l'utente
        $user = User::find(Session::get('user_id'));
        return view('home')->with('username', $user->username);
    
    }

    //Chiamata da fetch
    public function product()
    {
        //Controllo accesso
        if(!Session::get('user_id')){
            return [];
        }
        //Leggiamo i prodotti
        $products = Product::all();
        return $products;
    }

    //Chiamata da fetch
    public function productById($id, $quantità)
    {
        //Controllo accesso
        if(!Session::get('user_id')){
            return [];
        }
        //Leggiamo i prodotti
        $product = Product::find($id);

        return array($product, $quantità);
    }

    //Carrello
    public function creaCarrello($totale, $tavolo)
    {
        //Controllo accesso
        if(!Session::get('user_id')){
            return [];
        }
        //Creo un nuovo carrello
        $carrello = new Cart;
        $carrello->user_id = Session::get('user_id');
        $carrello->totale = $totale;
        $carrello->tavolo = $tavolo;
        $carrello->save();
        
        //Ritorna id carrello
        return $carrello->id;
    }


    public function do_ordine($cart_id)
    {
        // Controllo accesso
        if(!Session::get('user_id'))
        {
            return redirect('login');
        }
        // Controllo permessi
        $carrello = Cart::find($cart_id);
        if($carrello->user_id != Session::get('user_id'))
        {
            return redirect('home');
        }
        // Crea ordine
        $ordine = new Order;
        $ordine->cart_id = $cart_id;
        $ordine->prodotto = request('prodotto');
        $ordine->prezzo = request('prezzo');
        $ordine->quantità = request('quantità');
        $ordine->save();
        // Restituiamo la lista di ordini
        return $ordine;
    }
}
