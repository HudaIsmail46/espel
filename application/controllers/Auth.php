<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        if($this->exist('login'))
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            if($profil = $this->appauth->isExist($username))
            {
                if($profil->first_login == 'F')
                {
                    $this->appauth->login($username, $password);
                    return redirect('');
                }
                else
                {
                    return $this->renderLoginView('reset',['username' => $username]);
                }
            }
        }
        return $this->renderLoginView('login');
    }

    public function logout()
    {
        $this->appauth->logout();
        return redirect();
    }

    public function hash($password)
    {
        echo password_hash($password,PASSWORD_BCRYPT);
    }

    public function lupa_katalaluan()
    {
        $this->load->model('profil_model','profil');

        $username = $this->input->post('txtUsername');
        $profil = $this->profil->get_by('nokp', $username);

        if($profil)
        {
            $this->load->library('appnotify');
            $slug = md5($username . $profil->email . date('Ymd'));

            $mail = [
                'to' => $profil->email,
                'subject' => '[espel] Reset Katalaluan',
                'body' => $this->load->view('layout/email/reset_katalaluan',['profil' => $profil, 'slug' => $slug], TRUE),
            ];

            if($this->appnotify->send($mail))
            {
                $this->appsess->setFlashSession('success', TRUE);
                redirect('login#signup');
            }
            else
            {
                $this->appsess->setFlashSession('success', FALSE);
                redirect('login#signup');
            }
        }
        else
        {
            $this->appsess->setFlashSession('success', FALSE);
            redirect('login#signup');
        }
    }

    public function first_login()
    {
        if($this->input->method(TRUE) == 'POST')
        {
            $username = $this->input->post('hddUsername');
            $katalaluanAsal = $this->input->post('katalaluanAsal');
            $katalaluanBaru = $this->input->post('katalaluan');
            $reKatalaluan = $this->input->post('reKatalaluan');
            
            if($this->appauth->login($username, $katalaluanAsal) && ($katalaluanBaru == $reKatalaluan))
            {
                if($this->appauth->reset_password($username,$katalaluanBaru))
                {
                    return redirect('/');
                }
            }
            else
            {
                return redirect('login');
            }
        }
        else
        {
            return redirect('login');
        }
    }
    
    public function reset_katalaluan()
    {
        $this->load->model('profil_model', 'profil');

        if(!$this->exist('reset'))
        {
            $this->load->view('reset');
        }
        else
        {
            $user = $this->appsess->getSessionData('username');
            $pass = $this->input->post('katalaluan');
            $rePass = $this->input->post('reKatalaluan');

            if($pass == $rePass)
            {
                $this->load->library('appauth');
                if($this->appauth->reset_password($user,$pass))
                {
                    $this->appsess->setFlashSession('success', TRUE);
                    $this->appauth->logout();
                    redirect('login');
                }
                else
                {
                    $this->appsess->setFlashSession('success', FALSE);
                    $this->appauth->logout();
                    redirect('login');
                }
            }
            else
            {
                $this->appsess->setFlashSession('success', FALSE);
                $this->appauth->logout();
                redirect('login');
            }
        }
    }

    public function reset()
    {
        $this->load->model('profil_model','profil');

        $user_id = $this->uri->segment(2);
		if(!$user_id) show_error('Invalid reset code.');
		$hash = $this->uri->segment(3);
		if(!$hash) show_error('Invalid reset code.');

        $user = $this->profil->get_by('nokp',$user_id);
        if(!$user) show_error('Invalid reset code.');
		$slug = md5($user->nokp . $user->email . date('Ymd'));
		if($hash != $slug) show_error('Invalid reset code.');

        if(!$this->exist('reset'))
        {
            $this->load->view('reset2');
        }
        else
        {
            $pass = $this->input->post('katalaluan');
            $rePass = $this->input->post('reKatalaluan');

            if($pass == $rePass)
            {
                $this->load->library('appauth');
                if($this->appauth->reset_password($user->nokp,$pass))
                {
                    $this->appsess->setFlashSession('success', TRUE);
                    redirect('login');
                }
                else
                {
                    $this->appsess->setFlashSession('success', FALSE);
                    redirect("login");
                }
            }
            else
            {
                $this->appsess->setFlashSession('success', FALSE);
                redirect('login');
            }
        }
    }
}
