<?php
    session_start();
    session_regenerate_id(true);
     require_once 'C:\xampp\htdocs\web2\MODEL\Database.php';
     require_once 'Facebook/autoload.php';
     $FBOject = new \Facebook\Facebook([
         'app_id' =>'827729482526836',
         'app_secret' => '970d19a8df54b866f087029a193df2dc',
         'default_app_vesion' => 'v19.0' 
     ]);
     $handler = $FBOject -> getRedirectLoginHelper();

     try{
        $accessToken = $handler->getAccessToken();
     }catch(\Facebook\Exceptions\FacebookResponseException $e){
        echo 'Response Exception: '.$e->getMessage();
     }catch(\Facebook\Exceptions\FacebookSDKException $e){
        echo 'SDK Exception'.$e->getMessage();
        exit();
     }
     if(!$accessToken){
        header('Location: signup.php');
        exit();
     }
     $oAuth2Client = $FBOject->getOAuth2Client();
     if(!$accessToken->isLongLived())
    {
        $accessToken= $oAuth2Client->getLongLivedAccessToken($accessToken);
    }
    $response= $FBOject->get("/me?fields=id,name,email,picture",$accessToken);
    $userData = $response->getGraphUser();
    $fbid= $userData->getId();
    $fbEmail = $userData->getEmail();
    $fbName = $userData->getName();
    $fbPictureUrl = $userData->getPicture()->getUrl();
    $db = new Database();
    $conn = $db->getConnection();
    $get_user = mysqli_query($conn, "SELECT `facebook_id` FROM `users` WHERE `facebook_id`='$fbid'");
            if(mysqli_num_rows($get_user) > 0){
                header('Location: sign_up.php');
                exit;
            }
            else
            {
                $insert=mysqli_query($conn, "INSERT INTO `users`(`ten`,`email`,`src`,`facebook_id`,`usertype`) VALUES('$fbName','$fbEmail','$fbPictureUrl','$fbid','KH')");
                if($insert)
                {
                    header('Location: sign_up.php');
                    exit;
                }
                else
                {
                    echo "Sign up failed!(Something went wrong).";
                }
            }
?>