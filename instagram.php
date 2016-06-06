<?php

class instagramPhp{

    /*
     * Attributes
     */
    private $username, //Instagram username
            $access_token, //Your access token
            $userid; //Instagram userid

    /*
     * Constructor
     */
    function __construct($username='',$access_token='',$userid='') {
        if(empty($username) || empty($access_token) || empty($userid)){
            $this->error('empty username, access token, or user id');
        } else {
            $this->username=$username;
            $this->access_token = $access_token;
            $this->userid = $userid;
        }
    }

    /*
     * Get the most recent media published by a user.
     * you can use the $args array to pass the attributes that are used by the GET/users/user-id/media/recent method
     */
    public function getUserMedia($args=array()){
        $qs='';
        if(!empty($args)){ $qs = '&'.http_build_query($args); } //Adds query string if any args are specified
        $shots = $this->queryInstagram('https://api.instagram.com/v1/users/'.$this->userid.'/media/recent?access_token='.$this->access_token.$qs); //Get shots
        if($shots->meta->code=='200'){
            return $shots;
        } else {
            $this->error('getUserMedia');
        }
    }

    /*
     * Method that simply displays the shots in a ul.
     * Used for simplicity and demo purposes
     * You should probably move the markup out of this class to use it directly in your page markup
     */
    public function simpleDisplay($shots){
        $simpleDisplay = '';
        if(!empty($shots->data)){
            $simpleDisplay.='<ul class="instagram_shots">';
                foreach($shots->data as $istg){
                    //The image
                    $istg_thumbnail = $istg->{'images'}->{'thumbnail'}->{'url'}; //Thumbnail
                    //If you want to display another size, you can use 'low_resolution', or 'standard_resolution' in place of 'thumbnail'

                    //The link
                    $istg_link = $istg->{'link'}; //Link to the picture's instagram page, to link to the picture image only, use $istg->{'images'}->{'standard_resolution'}->{'url'}

                    //The caption
                    $istg_caption = $istg->{'caption'}->{'text'};

                    //The markup
                    $simpleDisplay.='<li><a class="instalink" href="'.$istg_link.'" target="_blank"><img src="'.$istg_thumbnail.'" alt="'.$istg_caption.'" title="'.$istg_caption.'" /><small class="caption">'.$istg_caption.'</small></a></li>';
                }
            $simpleDisplay.='<ul>';
        } else {
            $this->error('simpleDisplay');
        }
        return $simpleDisplay;
    }

    /*
     * Common mechanism to query the instagram api
     */
    public function queryInstagram($url){
        //prepare caching
        $cachefolder = __DIR__.'/';
        $cachekey = md5($url);
        $cachefile = $cachefolder.$cachekey.'_'.date('i').'.txt'; //cached for one minute

        //If not cached, -> instagram request
        if(!file_exists($cachefile)){
            //Request
            $request='error';
            if(!extension_loaded('openssl')){ $request = 'This class requires the php extension open_ssl to work as the instagram api works with httpS.'; }
            else { $request = file_get_contents($url); }

            //remove old caches
            $oldcaches = glob($cachefolder.$cachekey."*.txt");
            if(!empty($oldcaches)){foreach($oldcaches as $todel){
              unlink($todel);
            }}

            //Cache result
            $rh = fopen($cachefile,'w+');
            fwrite($rh,$request);
            fclose($rh);
        }
        //Execute and return query
        $query = json_decode(file_get_contents($cachefile));
        return $query;
    }

    /*
     * Error
     */
    public function error($src=''){
        echo '/!\ error '.$src.'. ';
    }

}
