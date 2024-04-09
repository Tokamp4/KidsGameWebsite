<?php
<<<<<<< HEAD

=======
require_once'Database.php';
>>>>>>> 646b0f6d1c13b0001bb222645cb19175a5a31fb9
class Create extends Database {
    //Constructor Method 
    public function __construct(){
        $this->createDBnTAB();
    }

    //Method for Database, Tables, and Views Creation 
    private function createDBnTAB(){
        //1-Successful Connect to the DBMS 
        if ($this->connectToDBMS() === TRUE) {  
            //2-Successful Create Database, Tables, and Views
<<<<<<< HEAD
            $userSQLcode= file_get_contents("../../db/database-entity.sql");
=======
            $userSQLcode= file_get_contents("database-entry.sql");
>>>>>>> 646b0f6d1c13b0001bb222645cb19175a5a31fb9
            if ($this->executeMultiQuery($userSQLcode) === TRUE){
                return TRUE;
            //2-Failed Create Database, Tables, and Views
            } else {
                die($this->messages()['error']['creatEntity']."<br/>".($this->lastErrMsg));
            }    
        //1-Failed Connect to the DBMS
        } else {
            die($this->messages()['error']['conDBMS']."<br/>".($this->lastErrMsg));
        }
    }
}
