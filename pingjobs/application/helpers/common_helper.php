<?php

function common_date_format($data)
{
  return date('m/d/Y h:s A',strtotime($data));
}
function time_elapsed_string($datetime) 
  {
    $today = time();    
    $createdday= strtotime($datetime); 
    $datediff = abs($today - $createdday);  
    $difftext="";  
    $years = floor($datediff / (365*60*60*24));  
    $months = floor(($datediff - $years * 365*60*60*24) / (30*60*60*24));  
    $days = floor(($datediff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));  
    $hours= floor($datediff/3600);  
    $minutes= floor($datediff/60);  
    $seconds= floor($datediff);  
    //year checker  
    if($difftext=="")  
    {  
      if($years>1)  
      $difftext=$years." years ago";  
      elseif($years==1)  
      $difftext=$years." year ago";  
    }
    //month checker  
    if($difftext=="")  
    {  
      if($months>1)  
      $difftext=$months." months ago";  
      elseif($months==1)  
      $difftext=$months." month ago";  
    }

    if($difftext=="")  
    {  
      // if($days>7)  
      $difftext=$days." days ago";  
      if($days ==0)
      {
         $difftext="Today";  
      }
      // else
      // $difftext=date('d F Y',$createdday);  
    }

    /*//day checker  
    if($difftext=="")  
    {  
      if($days>1)  
      $difftext=$days." days ago";  
      elseif($days==1)  
      $difftext=$days." day ago";  
    }  
    //hour checker  
    if($difftext=="")  
    {  
      if($hours>1)  
      $difftext=$hours." hours ago";  
      elseif($hours==1)  
      $difftext=$hours." hour ago";  
    }  
    //minutes checker  
    if($difftext=="")  
    {  
      if($minutes>1)  
      $difftext=$minutes." minutes ago";  
      elseif($minutes==1)  
      $difftext=$minutes." minute ago";  
    }  
    //seconds checker  
    if($difftext=="")  
    {  
      if($seconds>1)  
      $difftext=$seconds." seconds ago";  
      elseif($seconds==1)  
      $difftext=$seconds." second ago";  
    }*/
    // echo $difftext;
    return $difftext;  
  }
  function days_ago($datetime) 
  {
    $today = time();
    $createdday= strtotime($datetime); 
    $datediff = abs($today - $createdday);  
    $difftext="";  
    $years = floor($datediff / (365*60*60*24));  
    $months = floor(($datediff - $years * 365*60*60*24) / (30*60*60*24));  
    $days = floor(($datediff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));  
    // $hours= floor($datediff/3600);  
    // $minutes= floor($datediff/60);  
    // $seconds= floor($datediff);  
    return $days;  
  }
    
function clean($string) {
   $string = str_replace(array('\'', '"'), '', $string); // Replaces all spaces with hyphens.
   return $string;

   //return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function encrypt_lsa_pass($password){
  $cost = LSA_ENCRYPTION_COST;

  // Create a random salt
  $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');

  // Prefix information about the hash so PHP knows how to verify it later.
  // "$2a$" Means we're using the Blowfish algorithm. The following two digits are the cost parameter.
  $salt = sprintf(LSA_ENCRYPTION_SALT, $cost) . $salt;

  // Hash the password with the salt
  return crypt($password, $salt);
}

function compare_lsa_pass($data){
  $user_hash = $data['user_hash'];
  $user_pass = $data['user_pass'];
  $return=false;

  if(hash_equals($user_hash,crypt($user_pass, $user_hash)))
  {
    $return=true;
  }
  return $return;
}





  function get_dropdown_str_by_array($array)
  {
    $str = array();

    if(is_array($array))
    {
      foreach($array as $rs)
      {
        $rs['k']=$rs['zone_id'];
        $rs['v']=$rs['description'];
        $str[] = $rs["k"].":".$rs["v"];
      }
    }

    $str = implode($str,";");
    return $str;
  }

  function getSession($key='')
  {
    $CI  = &get_instance();
    $session_obj=$CI->session;
      // echo '<pre>';
      // print_r($session_obj); die;
    if($session_obj->userSession['con_tz']!='')
    {
      date_default_timezone_set($session_obj->userSession['con_tz']);
    }

    if($key!='')
    {
      return $session_obj->userSession[$key];
    }else
    {
      return $session_obj->userdata;
    }
  }

  function setSession($sess_key, $sess_value)
  {
    $CI  = &get_instance();
    $session_obj=$CI->session;
    $session_obj->set_userdata($sess_key, $sess_value);
  }

  function currentGMT($data)
  {
    if($data =='timestamp')
    {
      return  strtotime(gmdate("Y-m-d H:i:s", time())." GMT");
    }
    else if($data =='datetime')
    {
      //return  date_format(strtotime(gmdate("Y-m-d H:i:s", time())." GMT"), 'Y-m-d H:i:s');
      return  gmdate("Y-m-d H:i:s");
    }
  }

  function GMTtoLocal($timestamp)
  {
    if($timestamp>0)
    {
    }
  }



function send_mail_test()
  {
    $to_mail='varatharaj102@gmail.com'; //'sudalaimca87@gmail.com';
    $subject="test mail from pingjobs"; //'Thanks for registering';
    $message="test mail from pingjobs"; //'Thank you!';
     $attachement=''; //'Thank you!';

    $CI =& get_instance();
    $CI->load->library('email');
    $config['protocol'] = PROTOCOL;
    $config['smtp_host'] = SMTP_HOST;
    $config['smtp_port'] = SMTP_PORT;
    $config['smtp_user'] = SMTP_USER;
    $config['smtp_pass'] = SMTP_PASS;
    $config['charset'] = "utf-8";
    $config['mailtype'] = "html";
    $config['newline'] = "\r\n";
    $CI->email->initialize($config);

     if($attachement != ''){
    $CI->email->attach($attachement);

    //echo "inside attached";die();
    }

    /*$CI->load->library('parser');
    $CI->email->clear();*/
    //$this->load->library('email');
    //$CI->email->set_mailtype("html");
    $CI->email->from(APP_EMAIL, APP_EMAIL_NAME);
    $CI->email->to($to_mail);
    //$CI->email->bcc('varatharaj102@gmail.com');
    $CI->email->subject($subject);
    $CI->email->message($message);
    $CI->email->send();
    $CI->email->print_debugger();
  }

  
  function send_mail($data)
  {
    $to_mail=$data['to_mail']; //'sudalaimca87@gmail.com';
    $subject=$data['subject']; //'Thanks for registering';
    $message=$data['message']; //'Thank you!';
     $attachement=@$data['attachement']; //'Thank you!';

    $CI =& get_instance();
    $CI->load->library('email');
    $config['protocol'] = PROTOCOL;
    $config['smtp_host'] = SMTP_HOST;
    $config['smtp_port'] = SMTP_PORT;
    $config['smtp_user'] = SMTP_USER;
    $config['smtp_pass'] = SMTP_PASS;
    $config['charset'] = "utf-8";
    $config['mailtype'] = "html";
    $config['newline'] = "\r\n";
    $CI->email->initialize($config);

     if($attachement != ''){
    $CI->email->attach($attachement);

    //echo "inside attached";die();
    }

    /*$CI->load->library('parser');
    $CI->email->clear();*/
    //$this->load->library('email');
    //$CI->email->set_mailtype("html");
    $CI->email->from(APP_EMAIL, APP_EMAIL_NAME);
    $CI->email->to($to_mail);
    //$CI->email->bcc('varatharaj102@gmail.com');
    $CI->email->subject($subject);
    $CI->email->message($message);
    $CI->email->send();
    $CI->email->print_debugger();
  }


  function send_mail_byaster($data)
  {
    $to_mail=$data['to_mail']; //'sudalaimca87@gmail.com';
    $subject=$data['subject']; //'Thanks for registering';
    $message=$data['message']; //'Thank you!';
    //$attachement=@$data['attachement']; //'Thank you!';
    $CI =& get_instance();
    $CI->load->library('email');
    $config['protocol'] = ASTER_PROTOCOL;
    $config['smtp_host'] = ASTER_SMTP_HOST;
    $config['smtp_port'] = ASTER_SMTP_PORT;
    $config['smtp_user'] = ASTER_SMTP_USER;
    $config['smtp_pass'] = ASTER_SMTP_PASS;
    $config['charset'] = "utf-8";
    $config['mailtype'] = "html";
    $config['newline'] = "\r\n";
    $CI->email->initialize($config);
     /*if($attachement != ''){
    $CI->email->attach($attachement);
    }*/
    $CI->email->from(ASTER_APP_EMAIL, ASTER_APP_EMAIL_NAME);
    $CI->email->to($to_mail);
    //$CI->email->bcc('varatharaj102@gmail.com');
    $CI->email->subject($subject);
    $CI->email->message($message);
    $CI->email->send();
    $CI->email->print_debugger();
  }


  function getEmailTemplate($data)
  {
    $emailContent ='';


switch($data['type'])
{
          case 'asterhrregister':
              //$sent_url_data = rtrim(base64_encode(trim($data['usr_id'])),'=');
              $emailContent ='Thanks for submitting your resume with us, we will ping you at the very earliest, please keep in touch with us.';
        break;
            case 'activate':
              $sent_url_data = rtrim(base64_encode(trim($data['usr_id'])),'=');
              $emailContent ='<!DOCTYPE html>
              <html>
              <head>
                <title>Ruf note </title>
                <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
              </head>
              <body style="font-family:Open Sans, sans-serif;">
              <div class ="containner" style="margin:0 auto;border:1px solid rgba(0, 0, 0, 0.16);width:100%;max-width:746px;padding:20px;font-size: 13px; color:#666666;background: #fff">
                <div class ="head-left" style="float:left">
                <!--head-left  here-->
                </div>
                <div class ="head-right" style="float:right">
                <!--head-right  here-->
                </div>
                <div style ="clear:both"></div>
              <p>
              Welcome aboard '.$data['usr_name'].'!
              </p>
              <p>
              Thanks for signing up with RufNote. Your account has been created and you are ready to start creating your online notes
              which can be access anytime.
              </p>
              <p>
              Once you login to RufNote you are ready to go. Create your notes and assign to folders based on your priority. And most
              important share note with your friends, family members for a collaborative information exchange.
              Get started on a simple and incredible experience on RufNote. You can use RufNote to save information, notes, contacts
              online.
              </p>
              <p>
              Verify your email address and enjoy additional security in your RufNote account
              </p>
              <a href="'.base_url().'user/activate/'.$sent_url_data.'" style=" font: bold 11px Arial;  text-decoration: none;  background-color: #009afd;  color: #fff;  padding: .6em .8em;  border: 1px solid #1777b7;      border-radius: 3px;  ">Verify Account Now</a>
              </div>
              <div class ="footer-div" style="background-color:#E6E6E6; width:100%; max-width:746px; bottom:0; width: 100%; height: 30px;line-height: 30px; margin:0 auto; padding: 10px 20px;font-size: 12px;">
                <div class="footer-left" style="float:left; width:50%;">
                 <a href="'.base_url().'about"  >About Note</a> | <a href="'.base_url().'terms">Terms</a> | <a href="'.base_url().'privacy-policy">Privacy Policy</a> | <a href="'.base_url().'support">Support</a> | <a href="'.base_url().'">Signin</a>
                </div>
                <div class="footer-right" style="float:right; width:50%;">
                &copy;Rufnote.com 2016. All Rights Reserved
                </div>
                <div style="clear:both"></div>
              </div>
              </body>
              </html>';
        break;

        case 'forgetpassword':
            $sent_url_data = rtrim(base64_encode(trim($data['email'])),'=');
            //$sent_url_data = rtrim(base64_encode(trim($email)),'=');
            $emailContent ='<!DOCTYPE html>
                  <html>
                  <head>
                    <title>Ruf note </title>
                    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
                  </head>
                  <body style="font-family:Open Sans, sans-serif">
                  <div class ="containner" style="margin:0 auto;border:1px solid rgba(0, 0, 0, 0.16);width:100%;max-width:746px;padding:20px;font-size: 13px; color:#666666;background: #fff">
                    <div class ="head-left" style="float:left">
                    <!--head-left  here-->
                    </div>
                    <div class ="head-right" style="float:right">
                    <!--head-right  here-->
                    </div>
                    <div style ="clear:both"></div>
                  <p>
                  We received a request to reset the password for your account,'.$data['usr_name'].'!
                  </p>
                  <p>
                  If you made this request, click the button below. If you didn\'t make this request, you can ignore this email.
                  </p>

                  <a href="'.base_url().'forgotpassword/change_password/'.$sent_url_data.'" style=" font: bold 11px Arial;  text-decoration: none;  background-color: #009afd;  color: #fff;  padding: .6em .8em;  border: 1px solid #1777b7;      border-radius: 3px;  ">Reset Password</a>


                  <p>
                  Or use this link to reset your password:
                  </p>

                   <a style ="text-decoration: none; color: #4a90e2; "   href="'.base_url().'forgotpassword/change_password/'.$sent_url_data.'">'.base_url().'forgotpassword/change_password/'.$sent_url_data.'</a>

                   <p>
                    If you\'re getting a lot of password reset emails you didn\'t request, you can change your account settings to require personal
    information to reset your password.
                   </p>

                   <p style="color:#bcbcbc">If you have more questions about password reset, please visit our <a  style ="text-decoration: none; color: #4a90e2;" href="">Help Center </a></p>
                  </div>
                  <div class ="footer-div" style="background-color:#E6E6E6; width:100%; max-width:746px; bottom:0; width: 100%; height: 30px;line-height: 30px; margin:0 auto; padding: 10px 20px;font-size: 12px;">
                    <div class="footer-left" style="float:left; width:50%;">
                    <a href="'.base_url().'about"  >About Note</a> | <a href="'.base_url().'terms">Terms</a> | <a href="'.base_url().'privacy-policy">Privacy Policy</a> | <a href="'.base_url().'support">Support</a> | <a href="'.base_url().'">Signin</a>
                    </div>
                    <div class="footer-right" style="float:right; width:50%;">
                    &copy;Rufnote.com 2016. All Rights Reserved
                    </div>
                    <div style="clear:both"></div>
                  </div>
                  </body>
                  </html>';
              break;
            case 'share':

            $contoller = ($data['user_id'] == 0)?'signup':'login';
            $note_id = base64_encode($data['note_id']);
           $url = base_url().''.$contoller.'?email='.($data['email']).'&id='.$note_id;
            $emailContent ='<html>
              <head>
                <title>Ruf note </title>
                <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
              </head>
              <body style="font-family:Open Sans, sans-serif;">
              <div class ="containner" style="margin:0 auto;border:1px solid rgba(0, 0, 0, 0.16);width:100%;max-width:746px;padding:20px;font-size: 13px; color:#666666;background: #fff; box-shadow: 1px 2px 10px rgba(0,0,0,0.2);">
                <div class ="head-left" style="float:left">
                <!--head-left  here-->
                </div>
                <div class ="head-right" style="float:right">
                <!--head-right  here-->
                </div>
                <div style ="clear:both"></div>
              <p>
             <strong>'.$data['usr_name'].'</strong> has invited you to work in the following shared note:
              </p>
              <p>

                Works to complete '.$data['note_title'].' in Rufnote<br>
                shared on '.date('l, jS F, Y \a\t h:i A ',$data['curr_GMT']).'
              </p>
              <p>'.$data['comment'].' </p>

              <a href="'.$url.'" style=" font: bold 11px Arial;  text-decoration: none;  background-color: #009afd;  color: #fff;  padding: .6em .8em;  border: 1px solid #1777b7;border-radius: 3px;  ">Open Note</a>
              </div>
              <div class ="footer-div" style="background-color:#E6E6E6; width:100%; max-width:746px; bottom:0; width: 100%; height: 30px;line-height: 30px; margin:0 auto; padding: 10px 20px;font-size: 12px;">
                <div class="footer-left" style="float:left; width:50%;  text-align:left;">
                 <a href="'.base_url().'about"  >About Note</a> | <a href="'.base_url().'terms">Terms</a> | <a href="'.base_url().'privacy-policy">Privacy Policy</a> | <a href="'.base_url().'support">Support</a> | <a href="'.base_url().'">Signin</a>
                </div>
                <div class="footer-right" style="float:right; width:50%; text-align:right;">
                &copy;Rufnote.com 2016. All Rights Reserved
                </div>
                <div style="clear:both"></div>
              </div>
              </body>
              </html>';
	       break;


        default:
        break;
    }

return $emailContent;

  }




