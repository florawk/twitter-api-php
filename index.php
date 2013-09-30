<?php
ini_set('display_errors', 1);
require_once('TwitterAPIExchange.php');

/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "1903237716-XhZqg7Yg7NmBh6n5W4DxYihwBKtp0awkoU1brtL",
    'oauth_access_token_secret' => "uMYog5h4qfSBsd5pWnoDqiuRkJiXNrYuxVNTDqwAkc",
    'consumer_key' => "bnPvZVHDS5CErezIeEgg",
    'consumer_secret' => "D2Jd7cz88GHS2ZObYYEzHUhpw2tkrcQ045W3PBzXb6E"
);

/** URL for REST request, see: https://dev.twitter.com/docs/api/1.1/ **/
$url = 'https://api.twitter.com/1.1/blocks/create.json';
$requestMethod = 'POST';

/** POST fields required by the URL above. See relevant docs as above **/
$postfields = array(
    'screen_name' => 'usernameToBlock', 
    'skip_status' => '1'
);

/** Perform a POST request and echo the response **/
$twitter = new TwitterAPIExchange($settings);
// echo 'POST<br />'.$twitter->buildOauth($url, $requestMethod)
//              ->setPostfields($postfields)
//              ->performRequest();

/** Perform a GET request and echo the response **/
/** Note: Set the GET field BEFORE calling buildOauth(); **/
$url = 'https://api.twitter.com/1.1/followers/ids.json';
$getfield = '?screen_name=J7mbo';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
// echo '<br /><br />GET<br />'.$twitter->setGetfield($getfield)
//              ->buildOauth($url, $requestMethod)
//              ->performRequest();

/** Search for hashtags **/
$url = 'https://api.twitter.com/1.1/search/tweets.json';
$getfield = '?q=%23cisco&result_type=mixed&count=4';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);

$result = $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();

$myArray = json_decode($result, true);
echo 'Number of Tweets: '.sizeof($myArray["statuses"]).'<br /><br />';

foreach($myArray["statuses"] as $one_tweet)
{
    // echo '<pre>'; var_dump($one_tweet); echo '</pre>'; 
    echo '<ol>';
    foreach($one_tweet as $key => $value)
    {
        echo '<li>';
        echo $key.': ';
        echo (gettype($value) == 'array')? '<span style="color:red;">array</span>'.'<br />':gettype($value).'<br />';
        echo '</li>';
    }
    echo '</ol>///////////////////////////////////<br />';
}