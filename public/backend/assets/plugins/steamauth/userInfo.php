<?php
    $session = SessionModel::getInstance();
    if($session->steamid != ""){
    	include("settings.php");
        if (empty($session->steam_uptodate) or $session->steam_uptodate == false or empty($session->steam_personaname)) {
            @ $url = file_get_contents("http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".$steamauth['apikey']."&steamids=".$session->steamid);
            $content = json_decode($url, true);
            $session->set(steam_steamid,$content['response']['players'][0]['steamid']);
            $session->set(steam_communityvisibilitystate,$content['response']['players'][0]['communityvisibilitystate']);
            $session->set(steam_profilestate,$content['response']['players'][0]['profilestate']);
            $session->set(steam_personaname,$content['response']['players'][0]['personaname']);
            $session->set(steam_lastlogoff,$content['response']['players'][0]['lastlogoff']);
            $session->set(steam_profileurl,$content['response']['players'][0]['profileurl']);
            $session->set(steam_avatar,$content['response']['players'][0]['avatar']);
            $session->set(steam_avatarmedium,$content['response']['players'][0]['avatarmedium']);
            $session->set(steam_avatarfull,$content['response']['players'][0]['avatarfull']);
            $session->set(steam_personastate,$content['response']['players'][0]['personastate']);
            if (isset($content['response']['players'][0]['realname'])) { 
    	           $session->set(steam_realname,$content['response']['players'][0]['realname']);
    	       } else {
    	           $session->set(steam_realname,"Real name not given");
            }
            $session->set(steam_primaryclanid,$content['response']['players'][0]['primaryclanid']);
            $session->set(steam_timecreated,$content['response']['players'][0]['timecreated']);
            $session->set(steam_uptodate,true);
        }
        $steamprofile['steamid'] = $session->steam_steamid;
        $steamprofile['communityvisibilitystate'] = $session->steam_communityvisibilitystate;
        $steamprofile['profilestate'] = $session->steam_profilestate;
        $steamprofile['personaname'] = $session->steam_personaname;
        $steamprofile['lastlogoff'] = $session->steam_lastlogoff;
        $steamprofile['profileurl'] = $session->steam_profileurl;
        $steamprofile['avatar'] = $session->steam_avatar;
        $steamprofile['avatarmedium'] = $session->steam_avatarmedium;
        $steamprofile['avatarfull'] = $session->steam_avatarfull;
        $steamprofile['personastate'] = $session->steam_personastate;
        $steamprofile['realname'] = $session->steam_realname;
        $steamprofile['primaryclanid'] = $session->steam_primaryclanid;
        $steamprofile['timecreated'] = $session->steam_timecreated;

    }
?>
    
