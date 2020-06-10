<?php
# Functions for interfacing with the Twitter API

require_once("TwitterAPIExchange.php");

function twitter_init() {

    $twitter_keys = array(
    "oauth_access_token" => $_ENV["ACCESS_TOKEN"],
    "oauth_access_token_secret" => $_ENV["ACCESS_TOKEN_SECRET"],
    "consumer_key" => $_ENV["CONSUMER_KEY"],
    "consumer_secret" => $_ENV["CONSUMER_SECRET"]
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

?>