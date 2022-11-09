<?php 


if(isset($_POST['givemenewsletter'])){



    if($_POST['trap']==null && $_POST['emailnewsletter'] !== null){

        
        $email = $_POST['emailnewsletter'];
        $files = fopen($this->phpPath().'security/emails','a');
        $result = fwrite($files,$email.',');
        fclose($files);


        if($result !== false){
            $status = true;
        }else{
            $status = false;
        }

    }else{
        $status = false;
    };


};
$message = @file_get_contents($this->phpPath().'security/info');

echo '
<style>
.newsletter-invitation{
    width:100%;
    height:auto;
    padding: 15px;
    box-sizing: border-box;
    border:solid 1px #ddd;
    box-shadow: 1px 1px 10px rgba(0,0,0,0.1);
    margin:10px 0;
}

.newsletter-invitation input{
    width: 100%;
    padding: 10px;
    box-sizing: border-box;
    margin:5px 0;
border:none;
border:solid 1px #ddd;
    border-radius:5px;

}

.newsletter-invitation input[type="submit"]{
    background:green;
    color:#fff;
    border:none;

}


.newsletterinfo{
    width: 100%;
    border-radius: 5px;
    background: green;
    display: block;
    padding: 10px;
    box-sizing: border-box;
    color:#fff; margin-bottom: 10px;
    box-shadow: 1px 1px 10px rgba(0,0,0,0.1);
    text-align: center;
    opacity: 0;
    animation: fadeNewsletterInfo 500ms linear;
    animation-fill-mode: forwards;
}

.newsletterinfo-error{
    background: red;
}


.newsletter-trap{
    display: none;
}


@keyframes fadeNewsletterInfo {
    
    from{
        opacity: 0;
    }

    to{
        opacity: 1;
    }

}

</style>


<div class="newsletter-invitation">'.$message.'
    <form action="" method="post">
        <input name="emailnewsletter" placeholder="example@example.com"
         required value="'.@$_POST['emailnewsletter'].'" type="email">
        <input type="text" name="trap" class="newsletter-trap">
        <input name="givemenewsletter" value="'.$this->getValue('subscribebtn').'" type="submit">
    </form>
</div>
';

if(isset($status)){
  if($status == true){
        echo '<div class="newsletterinfo">'.$this->getValue('successmsg').'</div>';
    }else{
        echo '<div class="newsletterinfo newsletterinfo-error">'.$this->getValue('errormsg').'</div>';
    };
};


;?>