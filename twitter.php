<?php
# Functions for interfacing with the Twitter API

require_once("TwitterAPIExchange.php");

# Get trends for a specific location via WOEID
function get_location_trends($twitter_client, $woeid) {
    $fields = "?id=" . $woeid;
    $response = $twitter_client->setGetfield($fields)
                ->buildOauth("https://api.twitter.com/1.1/trends/place.json", "GET")
                ->performRequest();

    $json = json_decode($response);

    $trends = $json[0]->{"trends"};

    return $trends; # Return the JSON array of trends
}

# Search twitter for a search term
# TODO: Test?
function search_twitter($twitter_client, $search) {
    $fields = "?q=" . urlencode($search) . "&result_type=recent";
    $response = $twitter->setGetfield($fields)->buildOauth("https://api.twitter.com/1.1/search/tweets.json", "GET")->performRequest();
    $json = $json_decode($response);
    
    return $json; # Return JSON object of the result
}

?>