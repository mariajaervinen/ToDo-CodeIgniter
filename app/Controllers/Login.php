<?php
namespace App\Controllers;

use App\Models\LoginModel; //muista tämä!!!

const REGISTER_TITLE ='Todo - register';
const LOGIN_TITLE = 'Todo - login';

class Login extends BaseController{

    //Contructor starts session
    public function __construct(){
        $session = \Config\Services::session();
        $session->start();
    }
    
    public function index(){
        $data['title'] = LOGIN_TITLE; //näyttää login lomakkeen
        echo view('templates/header');
        echo view('login/login', $data);
        echo view('templates/footer');
    }
    public function register(){ //näyttää lomakkeen rekisteröitymis
        $data['title'] = REGISTER_TITLE;
        echo view('templates/header');
        echo view('login/register', $data);
        echo view('templates/footer');
    }

    public function registration(){ //tallentaa tietokantaan käyttäjän tiedot
        $model = new LoginModel();

        if(!$this->validate([//lomakkeen syötteet
            'user' => 'required|min_length[8]|max_length[30]',
            'password' => 'required|min_length[8]|max_length[30]',
            'passwordagain' => 'required|min_length[8]|max_length[30]|matches[password]'
        ])){
            echo view('templates/header',['title' => REGISTER_TITLE]);
            echo view('login/register');
            echo view('templates/footer');
        }else{
            $model->save([//tietokantaan->lomakkeen syötteet
                'username' => $this->request->getVar('user'),
                'password' => password_hash($this->request->getVar('password'),PASSWORD_DEFAULT),
                'firstname' => $this->request->getVar('firstname'),
                'lastname' => $this->request->getVar('lastname')
            ]);
            return redirect('login');
        }

    }

    public function check(){
        $model = new LoginModel();

        if(!$this->validate([//views lomakkeen syötteet
            'user' => 'required|min_length[8]|max_length[30]',
            'password' => 'required|min_length[8]|max_length[30]'
        ])){
            echo view('templates/header', ['title' => LOGIN_TITLE]);
            echo view('login/login');
            echo view('templates/footer');
        }else{
            $user = $model->check( //use model to check if user exists
                $this->request->getVar('user'),//lomakkeen syötteet
                $this->request->getVar('password')//verrataan tietokannan tietoihin
            );
            if($user){//if user exists, store into session and redirect
                $_SESSION['user'] =$user;
                return redirect('todo');
            }else{ //user is null, redirect to login page
                return redirect('login');
            }
        }
    }
}

