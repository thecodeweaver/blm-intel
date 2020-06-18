<?php
# Functions for interfacing with the Twitter API

require_once("TwitterAPIExchange.php");

function twitter_init() {

    /*
    $twitter_keys = array(
    "oauth_access_token" => $_ENV["ACCESS_TOKEN"],
    "oauth_access_token_secret" => $_ENV["ACCESS_TOKEN_SECRET"],
    "consumer_key" => $_ENV["CONSUMER_KEY"],
    "consumer_secret" => $_ENV["CONSUMER_SECRET"]
    ); */

    $twitter_keys = array(
        "oauth_access_token" => "1212840451243331584-NHMZHA1X7jb5u5W7q9yHpfKVyb1j52",
        "oauth_access_token_secret" => "nGi7M7cM2AeoSAIK87lIK9qZMkQbuw4EOypq05EUphxG9",
        "consumer_key" => "KSTAn1OedA9fjfGUmOyNFJOlF",
        "consumer_secret" => "gQZAXcihrdKaAhzw5VCYcnVrD9Ah2njs12cduTZ68hLV51qklV"
    );

    return new TwitterAPIExchange($twitter_keys);
}

# Get trends for a specific location via WOEID
function get_location_trends($twitter_client, $woeid) {
    $fields = "?id=" . $woeid;
    $response = $twitter_client->setGetfield($fields)
                ->buildOauth("https://api.twitter.com/1.1/trends/place.json", "GET")
                ->performRequest();

    $json = json_decode($response);

    $trends = $json[0]->trends;

    return $trends; # Return the JSON array of trends
}

# Search twitter for a search term
# TODO: Test?
function search_twitter($twitter_client, $search) {
    $fields = "?q=" . urlencode($search) . "&result_type=recent";
    $response = $twitter_client->setGetfield($fields)->buildOauth("https://api.twitter.com/1.1/search/tweets.json", "GET")->performRequest();
    $json = json_decode($response);
    
    return $json; # Return JSON object of the result
}

# Get the trends from a location and return a list of the latest tweets from each trend
function get_tweets_by_location($twitter_client, $woeid) {
    # Grab trends from a location
    $trends = get_location_trends($twitter_client, $woeid);
            
    # Filter out BlackLivesMatter related trends
    $blm_trends = array();
    for ($i = 0; $i < count($trends); $i++) {
        if (preg_match("/BlackLivesMatter|protest|loot/i", $trends[$i]->{"name"})) {
            array_push($blm_trends, $trends[$i]->{"name"});
        }
    }

    $tweets = array();
    if (count($blm_trends) === 0) {
        # No trends for LA area
        array_push($tweets, "None");
        return $tweets;
    } else {
        for ($i = 0; $i < count($blm_trends); $i++) {
            $json = search_twitter($twitter_client, $blm_trends[$i]);

            $screen_name = "@" . $json->{"statuses"}[$j]->{"user"}->{"screen_name"};
            $tweet = $json->{"statuses"}[$j]->{"text"};

            if (strlen($screen_name) < 1 || strlen($tweet) < 1) {
                continue;
            }

            array_push($tweets, $screen_name . ": " . $tweet);
        }
    }

    return $tweets;
}

?>