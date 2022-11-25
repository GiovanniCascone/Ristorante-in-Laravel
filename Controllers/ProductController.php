<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Session;
use App\Models\User;


class ProductController extends BaseController
{
    public function prodotti()
    {
        // Controllo accesso
        if(!Session::get('user_id'))
        {
            return redirect('login');
        }
        $user = User::find(Session::get('user_id'));
        return view('products')->with('username', $user->username);
    }

    public function cerca($prodotto)
    {
        // Controllo accesso
        if(!Session::get('user_id'))
        {
            return redirect('login');
        }
        // Richiesta API REST per valori nutrizionali tramite key
        $curl = curl_init();
        
        
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://edamam-food-and-grocery-database.p.rapidapi.com/parser?ingr=".$prodotto,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: edamam-food-and-grocery-database.p.rapidapi.com",
                "X-RapidAPI-Key: 5ad589f1famsh18f54894a8d6ff8p151affjsnc10e3f734daf"
            ],
        ]);
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }

    public function cercaImg($prodotto)
    {
        // Controllo accesso
        if(!Session::get('user_id'))
        {
            return redirect('login');
        }
        // Richiesta API REST  per immagini tramite key
        $curl = curl_init();
        
        curl_setopt($curl, CURLOPT_URL, "https://google-image-search1.p.rapidapi.com/v2/?q=".$prodotto."&hl=it");
        $headers = array("X-RapidAPI-Host: google-image-search1.p.rapidapi.com",
		                    "X-RapidAPI-Key: 5ad589f1famsh18f54894a8d6ff8p151affjsnc10e3f734daf");
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }
}