<!DOCTYPE html>
<html>
    <head>
        <title>BLM Alert</title>
        <meta name=”viewport” content=”width=device-width, initial-scale=1″>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <?php
        # Set up our Twitter API client
        require_once("twitter.php");
        /*
        $twitter_keys = array(
            "oauth_access_token" => $_ENV["ACCESS_TOKEN"],
            "oauth_access_token_secret" => $_ENV["ACCESS_TOKEN_SECRET"],
            "consumer_key" => $_ENV["CONSUMER_KEY"],
            "consumer_secret" => $_ENV["CONSUMER_SECRET"]
        );
        */

        # Locations to pull data from
        $places = array(
            "Los Angeles" => 2442047,
            "El Segundo" => 2397975,
            "Hawthorne" => 2418955
        );

        # Harcoded values for development
        $twitter_keys = array(
            "oauth_access_token" => "1212840451243331584-8ho4q0YA6EFg8eaxx2zaWr0qQAFVrh",
            "oauth_access_token_secret" => "c5YGftZUPE0cNtkWftOFaxEOmVtXU0HUBxwkAnx6Asr1T",
            "consumer_key" => "Ba5vOdt1Qty2jngah42aKIq1f",
            "consumer_secret" => "hslcAqjWosWd7YMkUBsa8P453K34YiCwhA3zUYdjbJ8CEf3PJB"
        );

        $twitter = new TwitterAPIExchange($twitter_keys);
        ?>
    </head>

    <body class="w3-container w3-pale-yellow w3-mobile">

        <header class="w3-blue-grey">
            <h1>BLM Alerts: Real time protest information and resources.</h1>
            <a href="/index.php">Home</a>
            <a href="/resources.html">Resources</a>
        </header>
        <hr>

        <h3>Note: this website is far from finished.</h2>
        <p>
        The real-time information part of the site is a bit inconsistent, so check out the resources page below if you want to help out in other ways.
        Also, I apologize for the poor formatting, designing web pages is not my strength. I'll probably fix it over the next few days.
        Finally, this is not so mobile friendly yet, so I apologize to people on their phones. This is also something I'll hopefully fix soon.
        </p>

        <h4>Locations</h4>
        <a href="#LosAngeles">Los Angeles</a>
        <a href="#ElSegundo">El Segundo</a>
        <a href="#Hawthorne">Hawthorne</a>

        <?php
        # TODO: PUT IN LOCATION SECTIONS 
        echo "<h5>Protest Information For " . date("d/m/Y") . "</h5>";

        # Grab trends from a location
        $trends = get_location_trends($twitter, $places["Los Angeles"]);
        
        # Filter out BlackLivesMatter related trends
        $blm_trends = array();
        for ($i = 0; $i < count($trends); $i++) {
            if (preg_match("/BlackLivesMatter/i", $trends[$i]->{"name"})) {
                array_push($blm_trends, $trends[$i]->{"query"});
            }
        }

        if (count($blm_trends) == 0) {
            # No trends for LA area
            echo "No protest trends on Twitter for the LA area!<br>";
        } else {
            # TODO: Search for BLM related Tweets
        }

        /*
        # Display a tweet for each protest trend
        for ($i = 0; $i < count($protest_trends); $i++) {
            $fields = "?q=" . $protest_trends[$i] . "&result_type=recent";
            $response = $twitter->setGetfield($fields)->buildOauth("https://api.twitter.com/1.1/search/tweets.json", "GET")->performRequest();
            $json = json_decode($response);
            
            $screen_name = "@" . $json->{"statuses"}[0]->{"user"}->{"screen_name"} . "<br>";
            $tweet = $json->{"statuses"}[$i]->{"text"};

            if (strlen($screen_name) < 1 || strlen($tweet) < 1) {
                continue;
            }

            echo "<p>";
            echo $screen_name . "<br>";
            echo $tweet;
            echo "</p>";
            echo "<hr>";
        } */
        ?>

        <section id="LosAngeles">
        <?php
        # Code for Los Angeles location
        # Put in a list (https://www.w3schools.com/w3css/w3css_lists.asp)
        ?>
        </section>

        <section id="ElSegundo">
        <?php
        # Code for El Segundo location
        # Put in a list (https://www.w3schools.com/w3css/w3css_lists.asp)
        ?>
        </section>

        <section id="Hawthorne">
        <?php
        # Code for Hawthorne location
        # Put in a list (https://www.w3schools.com/w3css/w3css_lists.asp)
        ?>
        </section>

        <hr>
        <footer class="w3-blue-grey">
        Made with 💙 by <a href="https://github.com/thecodeweaver/">TheCodeWeaver</a>
        </footer>

    </body>
</html>