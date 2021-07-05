<?php namespace App\Libraries;

use \App\Models\UsersModel;

class UsersLibrary {
    
    private $usersModel;
    private $userID;
    
    public function __construct() {
        
        $this->userID = session()->get('userid');
        $this->usersModel = new UsersModel();
    }
    
    
    public function check(array $privilegies = []) {
        
        if (!$this->userID) {
            return false;
        }
         
        if (!empty($privilegies)) {
            $user = $this->usersModel
                ->join('groups', 'groups.group_id = users.groups_id')
                ->find($this->userID);
            
            if (!$user->activated) return false;

            if (in_array($user->groups_id, $privilegies)) {
                return true;
            } else {
                return false;
            }
        } else {
            
            $user = $this->usersModel->find($this->userID);
            
            if (!$user->activated) return false;
            
            return $this->userID;
        }
    }
   
}
