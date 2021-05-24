<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class UsersController extends BaseController
{
    
    protected $usersModel;
    protected $validation;
    protected $session;
    private $email;

    public function __construct() {
        $this->usersModel = new UsersModel();
        $this->validation = \Config\Services::validation();
        $this->session = session();
        helper('form');

        // Eamil config
        $this->email = \Config\Services::email();
        $this->email->initialize([
            'SMTPHost' => 'mail.something.ge',
            'SMTPUser' => 'info@something.ge',
            'SMTPPass' => 'test',
            'SMTPPort' => '587',
            'mailType' => 'html',
            'SMTPCrypto' => 'ssl'
        ]);
    }

    
    // All users
    public function index() {
        
        if ($this->session->get('userid'))
            return redirect()->to(base_url('users/profile/' . $this->session->get('userid')));
        else
            return redirect()->to(base_url('users/login'));
	}


    // Activate
    public function activation() {

        $activateionKey = $this->request->getGet('vkey');
        
        $user = $this->usersModel->where('activation_key', $activateionKey)->first();
        
        if (is_null($user)) {
            $this->session->setFlashdata('error', 'Activation key is incorrect');
            
            return redirect()->to(base_url('users/login'));
        }
        
        $this->usersModel->update($user->id, [
            'activation_key' => 0,
            'activated' => 1
        ]);
        
        $this->session->setFlashdata('success', 'Yur accout is activated successfully');
        
        return redirect()->to(base_url('users/login'));
        
    }
    
    
    public function loginView() {
        return view('users/login');
    }
    
    
    public function login() {
        
        $this->validation->setRules([
            'email' => ['label' => '<b>eMail</b>', 'rules' => 'required|min_length[5]|max_length[100]|valid_email'],
            'password' => ['label' => '<b>Password</b>', 'rules' => 'required|min_length[5]|max_length[200]']
        ]);
        $this->validation->withRequest($this->request)->run();
        
        if (!empty($this->validation->getErrors())) {
            session()->setFlashdata('errors', $this->validation->getErrors());
            return redirect()->back()->withInput();
        } else {
            
            // Check email
            $user = $this->usersModel->where('email', $this->request->getPost('email'))->first();
            
            if (!$user) {
                session()->setFlashdata('error', 'Wrong email. User not found.');
                return redirect()->back()->withInput();
            }
            
            if (!$user->activated) {
                session()->setFlashdata('error', 'User is not activated. Please check your email address for activation key');
                return redirect()->back()->withInput();
            }
                
            // Check password
            $pass = $this->request->getPost('password');

            if (!password_verify($pass, $user->password)) {

                session()->setFlashdata('error', 'Wrong password!');
                return redirect()->back()->withInput();
            } else {

                $this->session->set('userid', $user->id);

                return redirect()->to(base_url('users/profile/' . $user->id));
            }
        }
    }
    
    
    public function registerView() {
        
        return view('users/register');
    }
    
    
    public function register() {
        $this->validation->setRules([
            'name' => ['label' => '<b>Name</b>', 'rules' => 'required|min_length[3]|max_length[100]|string'],
            'username' => ['label' => '<b>Username</b>', 'rules' => 'required|min_length[3]|max_length[100]|string'],
            'email' => ['label' => '<b>eMail</b>', 'rules' => 'required|min_length[5]|max_length[100]|valid_email|is_unique[users.email]'],
            'avatar' => ['label' => '<b>Avatar</b>', 'rules' => 'max_size[avatar,1024]|ext_in[avatar,png,jpg,gif]'],
            'password' => ['label' => '<b>Password</b>', 'rules' => 'required|min_length[5]|max_length[200]'],
            'password_repeat' => ['label' => '<b>Password repeat</b>', 'rules' => 'required|min_length[5]|max_length[200]|matches[password]']
        ]);
        $this->validation->withRequest($this->request)->run();
        
        if (!empty($this->validation->getErrors())) {
            session()->setFlashdata('errors', $this->validation->getErrors());
            return redirect()->back()->withInput();
        } else {
            
            $data = $this->request->getPost();
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            
            // Image editor
            $editor = \Config\Services::image();

            $image = $this->request->getFile('avatar');
            if ($image->isValid()) {

                // Get new avatar name
                $newName = $image->getRandomName();
                // Upload avatar
                $image->move(dirname(APPPATH).'/public/images/avatars', $newName);

                // Make image smaller
                $editor
                    ->withFile(dirname(APPPATH).'/public/images/avatars/' . $newName)
                    ->fit(200, 200, 'center')
                    ->save(dirname(APPPATH).'/public/images/avatars/' . $newName, 90);
                
                // Add avatar to the data storage
                $data['avatar'] = $newName;
            }
            
            
            // Add avatar to the data storage
            $data['avatar'] = null;
            
            // Set users group
            $data['users_group'] = 3;
            
            // Set activation key
            $activationKey = time();
            $data['activation_key'] = $activationKey;
            
            // Send activation key to the mail
            $this->email->setFrom(base_url(), ' - textile company');
            $this->email->setTo($this->request->getPost('email'));
            $this->email->setSubject('Validate user account');
            $this->email->setMessage('<a href="'.base_url('users/activation/?vkey='.$activationKey.'').'">Account activateion on '. base_url().'. Follow the link for activation. </a>');
            $this->email->send();
            
            // Store data in to the database
            $res = $this->usersModel->insert($data);
            
            
            if ($res) {
                
                $message = 'You have just registered successfully. To verify account please follow the activation link sent to your eMail. <br> Though, you can use your account without activation, but you never be able to reset your password if email address is wrong!';
                
                // Success message
                $this->session->setFlashdata('message', $message);
                
                return redirect()->to(base_url('users/login'));
            } else {
                session()->setFlashdata('error', '$this->validation->getErrors()');
                return redirect()->back()->withInput();
            }
        }
    }


    public function accountView(int $id) {
        
        $user = $this->usersModel
                ->find($id);
        
        if ($user && $user->id != $this->session->get('userid'))
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        
        if (!$user) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        
        return view('users/account', [
            'user' => $user
        ]);
    }
    
    
    // Update account
    public function account(int $id) {
                
        // Set method as post
        $this->request->setMethod('post');
        
        $user = $this->usersModel
                ->find($id);
        
        if ($user && $user->id != $this->session->get('userid'))
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        
        // If user not found
        if (!$user) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        
        // Validate input
        $this->validate([
            'name' => ['label' => '<b>Name</b>', 'rules' => 'required|min_length[3]|max_length[100]|string'],
            'username' => ['label' => '<b>Username</b>', 'rules' => 'required|min_length[3]|max_length[100]|string'],
            'email' => ['label' => '<b>eMail</b>', 'rules' => 'required|min_length[5]|max_length[100]|valid_email'],
            'avatar' => ['label' => '<b>Avatar</b>', 'rules' => 'max_size[avatar,1024]|ext_in[avatar,png,jpg,gif]'],
            'password' => ['label' => '<b>Password</b>', 'rules' => 'max_length[200]'],
            'password_repeat' => ['label' => '<b>Password repeat</b>', 'rules' => 'max_length[200]|matches[password]']
        ]);
        $this->validation->withRequest($this->request)->run();
        
       
        if (!empty($this->validation->getErrors())) {
            
            $this->session->setFlashdata('errors', $this->validation->getErrors());
            
            return redirect()->to(base_url("users/account/$id"))->withInput();
        } else {
            
            // Get data
            $data = $this->request->getPost();
            
            $data['password'] = empty($data['password']) ? $user->password : password_hash($data['password'], PASSWORD_DEFAULT);
            
            $userByEmail = $this->usersModel->where('email', $this->request->getPost('email'))->first();
            if ($userByEmail && $userByEmail->id != $user->id) {
                $this->validation->setError('email', 'This eMail is already taken');
                
                $this->session->setFlashdata('errors', $this->validation->getErrors());
                return redirect()->to(base_url("users/account/$id"))->withInput();
            } else {
                /// AVATAR ///
                
                // Image editor
                $editor = \Config\Services::image();
                
                // Get avatar
                $image = $this->request->getFile("avatar");

                // if is new image
                if ($image->isValid()) {
                    // Get new avatar name
                    $newName = $image->getRandomName();
                    // Upload avatar
                    $image->move(dirname(APPPATH).'/public/images/avatars', $newName);

                    // Make image smaller
                    $editor
                        ->withFile(dirname(APPPATH).'/public/images/avatars/' . $newName)
                        ->fit(200, 200, 'center')
                        ->save(dirname(APPPATH).'/public/images/avatars/' . $newName, 90);

                    // Add avatar to the data storage
                    $data['avatar'] = $newName;

                } else {
                    $data['avatar'] = $data['avatar_hidden'];
                }
                
                // Update user
                $this->usersModel->update($user->id, $data);
                
                // Set message
                $this->session->setFlashdata('success', 'User updated successfully.');
                return redirect()->to(base_url("users/account/$id"));
            }
        }
    }


    public function profile(int $id) {
               
        $user = $this->usersModel
                ->join('groups', 'groups.group_id = users.groups_id')
                ->find($id);
                
        if (!$user) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        
        return view('users/profile', [
            'user' => $user
        ]);
    }
    
    
    public function reset() {
        
        // Reset password if post request
        if ($this->request->getMethod() == 'post') {
        
            // Get user email
            $email = $this->request->getPost('email');
            $this->validation->setRules([
                'email' => ['label' => '<b>eMail</b>', 'rules' => 'required|min_length[5]|max_length[100]|valid_email|is_not_unique[users.email,email,'.$email.']'],
                'password' => ['label' => '<b>Password</b>', 'rules' => 'required|min_length[5]|max_length[200]'],
            ]);
            $this->validation->withRequest($this->request)->run();
            
            // If validation NOT passed
            if (!empty($this->validation->getErrors())) {

                $this->session->setFlashdata('errors', $this->validation->getErrors());
                return redirect()->back()->withInput();
            } else {
                
                $user = $this->usersModel->where('email', $email)->first();
                $verificationID = time();
                
                // Hash the password and set to the session storage
                $hashedPassword = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
                $this->session->set("key_$verificationID", $hashedPassword);
                                
                $this->usersModel->update($user->id, [
                    'activation_key' => $verificationID
                ]);
                
                $message = 'The verification link has been sent to your email. Password will be changed after following the verification link.';
                
                $emailMessage = 'Click the link to confirm the password update.';
                
                // Send activation key to the mail
                $this->email->setFrom(base_url(), ' - textile company');
                $this->email->setTo($this->request->getPost('email'));
                $this->email->setSubject('Validate user account');
                $this->email->setMessage('<a href="'.base_url('users/reset/?verification='.$verificationID.'').'"> '. $emailMessage .' </a>');
                $this->email->send();

                
                $this->session->setFlashdata('message', $message);
                return redirect()->back();
            }
        }
        
        
        // Load view if get request
        if ($this->request->getMethod() == 'get') {
            
            // If password reset verification key exists
            $verification = $this->request->getGet('verification');
            //dd($this->session->get());
            
            if ($verification) {
                $user = $this->usersModel->where('activation_key', $verification)->first();
                
                if ($user) {
                    $this->usersModel->update($user->id, [
                        'password' => $this->session->get("key_$verification")
                    ]);
                    
                    $this->session->remove("key_$verification");
                    $this->session->setFlashdata('message', 'Password has been changed successfully.');
                    return redirect()->to(base_url('users/login'));
                } else {
                    
                    $this->session->setFlashdata('error', 'Wrong validation key passed.');
                    return redirect()->to(base_url('users/reset'));
                }
            }
            
            return view('users/reset');
        }
    }


    public function logout() {
        $this->session->remove('userid');
        return redirect()->to(base_url('users/login'));
    }
    
    
    // Send email
    public function sendmail() {
        
        $body = $this->request->getPost();
        
        $validation = new \App\ThirdParty\Validation();
        
        $errors = $validation
            ->with($body)
            ->rules([
                'name' => 'required|min[3]|max[100]|valid_input',
                'subject' => 'required|min[3]|max[100]|valid_input',
                'email' => 'required|min[6]|max[100]|valid_email',
                'message' => 'min[4]|max[1000]|valid_input'
            ])
            ->validate();
        
        if (!empty($errors)) {
            $this->session->setFlashdata('errors', $errors);
            return redirect()->back()->withInput();
        }
        
        // Construct message
        $message = "
            <ul>
                <li>
                    <b style=\"margin-right: 5px;\">Name</b><span>{$body['name']}</span>
                    <b style=\"margin-right: 5px;\">Subject</b><span>{$body['subject']}</span>
                    <b style=\"margin-right: 5px;\">Email</b><span>{$body['email']}</span>
                    <b style=\"margin-right: 5px;\">Message</b><span>{$body['message']}</span>
                </li>
            </ul>
        ";
        
        // Send activation key to the mail
        $this->email->setFrom(base_url(), ' - Textile LLC');
        $this->email->setTo(ADMIN_EMAIL);
        $this->email->setSubject('Mail from user contact form');
        $this->email->setMessage($body['message']);
        $this->email->send();
        
        $this->session->setFlashdata('message', 'Message has been sent successfully.');
        
        return redirect()->to(base_url('pages/contact'));
    }
}
