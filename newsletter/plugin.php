<?php
    class newsletterPlugin extends Plugin {


        public function init()
        {
            $this->dbFields = array(
                'sender'=>'',
                'sendername'=>'',
                'passwordsmtp'=>'',
                'smtpserver'=>'',
                'port'=>'',
                'auth'=>'',
                'ssl'=>'',


                'subscribebtn'=>'Subscribe to our Newsletter',
                'successmsg' =>'You have been successfully subscribed!',
                'errormsg'=>'Ouch, something went wrong.'
            );

            $this->customHooks = array(
                'newsletter'
            );
        }
    
        public function form() {
     
        include($this->phpPath().'php/form.php');
        }


 public function post(){

            if(isset($_POST['maillist'])){
                file_put_contents($this->phpPath().'security/emails',$_POST['maillist']);
            };

            if(isset($_POST['messagenewsletter'])){
                file_put_contents($this->phpPath().'security/info',$_POST['messagenewsletter']);
            };
        
            parent::post();

        }


        

        


        public function adminController()
        {
            // Check if the form was sent
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
               
                
                $emailList = file_get_contents($this->phpPath().'security/emails');
                $newlist = explode(",",$emailList);


if(isset($_POST['sendnewsletter'])){

    require($this->phpPath()."PHPMailer/src/PHPMailer.php");
    require($this->phpPath()."PHPMailer/src/SMTP.php");
    require($this->phpPath()."PHPMailer/src/Exception.php");
    
    $subject = $_POST['titlens'];
    $message = $_POST['contentnewsletter'];
    
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    
    $mail->IsSMTP();
    $mail->CharSet="UTF-8";
    $mail->Host = $this->getValue('smtpserver'); /* Zależne od hostingu poczty*/
    $mail->SMTPDebug = 0;
    $mail->Port = $this->getValue('port'); /* Zależne od hostingu poczty, czasem 587 */

    if($this->getValue('ssl') == "1"){
       $mail->SMTPSecure = 'ssl';
    };
    
    
    if($this->getValue('auth') == "1"){
    $mail->SMTPAuth = true;
    };
    
    $mail->IsHTML(true);
    $mail->Username = $this->getValue('sender'); /* login do skrzynki email często adres*/
    $mail->Password = $this->getValue('passwordsmtp') ; /* Hasło do poczty */
    $mail->setFrom($this->getValue('sender'), $this->getValue('sendername')); /* adres e-mail i nazwa nadawcy */
    
    
    $mail->Subject = $subject; /* Tytuł wiadomości */
    $mail->Body = html_entity_decode($message);
    
    foreach($newlist as $email){
    
        if($email !== '' ){
            $mail->addAddress("$email");
            //$success = $mail->Send();
    
            if(!$mail->Send()){
                $sended = false;
                } else {
              $sended = true; 
                }
    
            $mail->clearAllRecipients();
        }
    
    };
    
    if($sended == true){
        echo '<div class="alert alert-success" role="alert">
        Messages have been sent!</div>';
    }else{
        echo '<div class="alert alert-danger" role="alert">
        Messages have not sent! <br>'.$mail->ErrorInfo.'</div>';
    };

    };





            }
        }
    
        public function adminView()
        {
            // Token for send forms in Bludit
            global $security;
            $tokenCSRF = $security->getTokenCSRF();
    
            
            $html = '


<link rel="stylesheet" type="text/css" href="/bl-plugins/tinymce/css/tinymce_toolbar.css">
<script src="/bl-plugins/tinymce/tinymce/tinymce.min.js?version=5.10.5"></script>

                <form method="post">
                <input type="hidden" id="jstokenCSRF" name="tokenCSRF" value="'.$tokenCSRF.'">
                <h3>Send New Newsletter</h3>
			
                <label>Newsletter Title:</label>
                <br>
                <input style="width:100%;padding:10px;box-sizing:border-box;margin-bottom:20px;border:solid 1px #ddd;" name="titlens" type="input" >
                
                <label>Newsletter Content:</label>
                <br>
                <textarea name="contentnewsletter" id="post-content2" 
                style="width:100%;padding:10px;box-sizing:border-box;height:350px;">
                </textarea>
                <input type="submit" name="sendnewsletter" 
    class="btn btn-primary  mt-3"
                value="Send newsletter">
            </form>


            
	<script>

    tinymce.init({
            selector: "#post-content2",
            auto_focus: "post-content2",
            element_format : "html",
            entity_encoding : "raw",
            skin: "oxide",
            schema: "html5",
            statusbar: false,
            menubar:false,
            branding: false,
            browser_spellcheck: true,
            pagebreak_separator: PAGE_BREAK,
            paste_as_text: true,
            remove_script_host: false,
            convert_urls: true,
            relative_urls: false,
            valid_elements: "*[*]",
            cache_suffix: "?version=5.10.5",
            
            plugins: ["code autolink image link pagebreak advlist lists textpattern table"],
            toolbar1: "formatselect bold italic forecolor backcolor removeformat | bullist numlist table | blockquote alignleft aligncenter alignright | link unlink pagebreak image code",
            toolbar2: "",
            language: "en",
            content_css: "/bl-plugins/tinymce/css/tinymce_content.css",
            codesample_languages: [],
        });
        </script>
        
            ';
            return $html;
        }
    
        public function adminSidebar()
        {
            $pluginName = Text::lowercase(__CLASS__);
            $url = HTML_PATH_ADMIN_ROOT.'plugin/'.$pluginName;
            $html = '<a id="current-version" class="nav-link" href="'.$url.'"> <i class="fa fa-envelope"></i>Send newsletter</a>';
            return $html;
        }






        public function newsletter(){

include($this->phpPath().'php/frontForm.php');

        }

    }
?>