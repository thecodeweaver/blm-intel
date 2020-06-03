<!DOCTYPE html>
<html>
    <head>
        <title>Tweet Intel</title>
        <meta name=”viewport” content=”width=device-width, initial-scale=1″>
    </head>

    <body style="background-color:DimGray">
        <?php
        require_once("TwitterAPIExchange.php");

        echo "<h1>Recent Tweets For " . $_ENV["SEARCH_TERM"] . "</h1>";

        $twitter_keys = array(
            "oauth_access_token" => $_ENV["ACCESS_TOKEN"],
            "oauth_access_token_secret" => $_ENV["ACCESS_TOKEN_SECRET"],
            "consumer_key" => $_ENV["CONSUMER_KEY"],
            "consumer_secret" => $_ENV["CONSUMER_SECRET"]
        );

        $search = $_ENV["SEARCH_TERM"];
        $tweet_count = $_ENV["TWEET_COUNT"]; 


        $twitter = new TwitterAPIExchange($twitter_keys);

        $fields = "?q=" . urlencode($search) . "&result_type=recent" . "&count=" . urlencode($tweet_count);

        $response =  $twitter->setGetfield($fields)
                    ->buildOauth("https://api.twitter.com/1.1/search/tweets.json", "GET")
                    ->performRequest();

        $json_obj = json_decode($response);
        
        for ($i = 0; $i < $tweet_count; $i++) {
            $screen_name =  "@" . $json_obj->{"statuses"}[$i]->{"user"}->{"screen_name"} . ": ";
            $tweet = $json_obj->{"statuses"}[$i]->{"text"};

            if (strlen($screen_name) < 1 || strlen($tweet) < 1) {
                continue;
            }

            echo "<p>";
            echo $screen_name . $tweet;
            echo "</p>";
            echo "<hr>";
        }

        ?>

        <footer style="font-size:120%">
        Made with 💙 by TheCodeWeaver. <a href="https://github.com/thecodeweaver/tweet-intel/">Source code</a>
        </footer>
    </body>
</html>