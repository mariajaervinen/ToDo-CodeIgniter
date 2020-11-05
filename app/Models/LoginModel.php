<?php namespace App\Models;

use CodeIgniter\Model;


class LoginModel extends Model{
    protected $table = 'user'; //tietokannan taulu
    //tietokannan kentät? kyllä
    protected $allowedFields = ['username','password','firstname','lastname'];

    //public function getTodos(){
      //  return $this->findAll();
   // }

    public function check($username, $password){
        $this->where('username',$username); //create where part to the select
        $query = $this->get(); //execute select (with the part defined)
       // print $this->getLastQuery(); //might be used for debuggin
        $row = $query->getRow(); //get row
        if($row){ //if row was returned based on username
            //check if secured password is equal with password entered by the user
            if(password_verify($password,$row->password)){
                return $row;//return row(user object)
            }
        }
        return null;//return null, because username and/or password is incorrect
    }
}