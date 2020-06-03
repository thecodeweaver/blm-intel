<!DOCTYPE html>
<html>
    <head>
        <title>Tweet Intel</title>
        <meta name=”viewport” content=”width=device-width, initial-scale=1″>$_ENV['YOUR_CONSUMER_KEY'],
    </head>

    <body style="background-color:DimGray">
        <h1>The Latest Tweets For the Following Hashtags:</h1>
        <?php
        require_once("TwitterAPIExchange.php");

        $twitter_keys = array(
            "oauth_access_token" => $_ENV["ACCESS_TOKEN"],
            "oauth_access_token_secret" => $_ENV["ACCESS_TOKEN_SECRET"],
            "consumer_key" => $_ENV["CONSUMER_KEY"],
            "consumer_secret" => $_ENV["CONSUMER_SECRET"]
        );

        $search = $_ENV["SEARCH_TERM"]?:"twitter";
        $tweet_count = $_ENV["TWEET_COUNT"]?:5; 

        $twitter = new TwitterAPIExchange($twitter_keys);

        echo $twitter->setGetfield(urlencode("q=" . $search))
                    ->setGetfield(urlencode("result_type=recent"))
                    ->setGetField(urlencode("count=" . $tweet_count))
                    ->buildOath("https://api.twitter.com/1.1/search/tweets.json", "GET")
                    ->performRequest();

        # Grab 5 tweets from the search term
        #for ($i = 0; $i < $tweet_count; $i++) {
        #
        #}
        ?>

        <footer style="font-size:150%">
        Made with 💙 by TheCodeWeaver.<a href="https://github.com/thecodeweaver/tweet-intel/"> Source code</a>
        </footer>
    </body>
</html>