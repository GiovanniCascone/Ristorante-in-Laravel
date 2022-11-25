<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Session;
use App\Models\User;


class LoginController extends BaseController
{
    public function login_form()
    {
        //Se l'utente è già loggato vado alla home
        if(Session::get('user_id')){
            return redirect('home');
        }
        //Controllo se ci sono errori
        $error = Session::get('error');
        //Resetto la variabile di sessione degli errori
        Session::forget('error');
        return view('login')->with('error', $error);
    
    }

    public function do_login()
    { 
        //Se l'utente è già loggato vado alla home
        if(Session::get('user_id')){
            return redirect('home');
        }
        //Validazione dati lato server 
        // Verifica l'esistenza di dati POST
        if (strlen(request("username"))==0 || strlen(request("password"))==0)
        {    
            //Imposto un errore specifico
            Session::put('error', 'empty_fields');
            return redirect('login')->withInput();
        }
        # USERNAME E PASSWORD
        //Controlla se l'utente è presente in db e se la password è corretta
        $user = User::where('username', request('username'))->first();
        if(!$user || !password_verify(request('password'), $user->password)) 
        {
            Session::put('error', 'wrong');
            return redirect('login')->withInput();
        }
        
        //Login
        //Salvo la variabile di sessione per la navigazione all'interno del sito 
        Session::put('user_id', $user->id);

        //Redirect home
        return redirect('home');

    }
    //---------------------------------------------------
    public function register_form()
    {
        //Se l'utente è già loggato vado alla home
        if(Session::get('user_id')){
            return redirect('home');
        }
        //Controllo se ci sono errori
        $error = Session::get('error');
        //Resetto la variabile di sessione degli errori
        Session::forget('error');
        return view('register')->with('error', $error);
    }

    public function do_register()
    {
        //Se l'utente è già loggato vado alla home
        if(Session::get('user_id')){
            return redirect('home');
        }
        //Validazione dati lato server 
        // Verifica l'esistenza di dati POST
        if (strlen(request("username")) ==0 || strlen(request("password")) 
            ==0 || strlen(request("email")) ==0 || strlen(request("nome")) 
            ==0 || strlen(request("cognome")) ==0)
        {    
            //Imposto un errore specifico
            Session::put('error', 'empty_fields');
            return redirect('register')->withInput();
        }
        # USERNAME
        // Controlla che l'username tramite espressione regolare
        else if(!preg_match('/^[a-zA-Z0-9_]{3,15}$/', request('username'))) {
            Session::put('error', 'username_error');
            return redirect('register')->withInput();
        }
        // Controlla se username è già presente in db
        else if(User::where('username', request('username'))->first()) {
            Session::put('error', 'existing');
            return redirect('register')->withInput();
        }
        # PASSWORD
        else if (strlen(request("password")) < 8) {
            Session::put('error', 'password_error');
            return redirect('register')->withInput();
        } 
        # EMAIL
        else if (!filter_var(request('email'), FILTER_VALIDATE_EMAIL)) {
            Session::put('error', 'email_error');
            return redirect('register')->withInput();
        } 
        # PRIVACY
        else if (!request('privacy')) {
            Session::put('error', 'privacy_error');
            return redirect('register')->withInput();
        } 
    
    
        //Creazione utente
        $user = new User;
        $user->username = request('username');
        $user->password = password_hash(request('password'), PASSWORD_BCRYPT);
        $user->email = request('email');
        $user->nome = request('nome');
        $user->cognome = request('cognome');
        $user->save();

        //Login
        //Salvo la variabile di sessione per la navigazione all'interno del sito 
        Session::put('user_id', $user->id);

        //Redirect home
        return redirect('home');

    }
      
    //Logout
    public function logout()
    {
        //Elimina dati di Sessione
        Session::flush();
        return redirect('login');
    }
}
