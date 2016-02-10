<?php


require ('openid.php');

function logoutbutton() {

   echo "<form action=\"Authentification/logout\" method=\"post\"><input value=\"Logout\" type=\"submit\" class='steamlogout' /></form>"; //logout button

}

function steamlogin()
{
try {
    require_once("settings.php");
    $session = SessionModel::getInstance();
    $openid = new LightOpenID($steamauth['domainname']);
    $button['small'] = "small";
    $button['large_no'] = "large_noborder";
    $button['large'] = "large_border";
    $button = $button[$steamauth['buttonstyle']];

    if(!$openid->mode) {
        if(isset($_GET['login'])) {
            $openid->identity = 'http://steamcommunity.com/openid';
            header('Location: ' . $openid->authUrl());
        }

    return "<form action=\"?login\" method=\"post\"><input value=\"Sign in with Steam\" type=\"submit\" class='steamlogout' /></form>";
    }

     elseif($openid->mode == 'cancel') {
        echo 'User has canceled authentication!';
    } else {
        if($openid->validate()) { 
                $id = $openid->identity;
                $ptn = "/^http:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/";
                preg_match($ptn, $id, $matches);

                $session->set('steamid',$matches[1]);

                // First determine of the $steamauth['loginpage'] has been set, if yes then redirect there. If not redirect to where they came from
                if($steamauth['loginpage'] !== "") {
                    $returnTo = $steamauth['loginpage'];
                } else {
                    //Determine the return to page. We substract "login&"" to remove the login var from the URL.
                    //"file.php?login&foo=bar" would become "file.php?foo=bar"
                    $returnTo = str_replace('login&', '', $_GET['openid_return_to']);
                    //If it didn't change anything, it means that there's no additionals vars, so remove the login var so that we don't get redirected to Steam over and over.
                    if($returnTo === $_GET['openid_return_to']) $returnTo = str_replace('?login', '', $_GET['openid_return_to']);
                }
                header('Location: '.$returnTo);
        } else {
                echo "User is not logged in.\n";
        }

    }
} catch(ErrorException $e) {
    echo $e->getMessage();
}
}

?>
