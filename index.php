<!DOCTYPE html>
<html>
    <head>
        <title>BLM Alert</title>
        <meta name=”viewport” content=”width=device-width, initial-scale=1″>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <?php
        # Set up our Twitter API client
        require "twitter.php";
        $twitter = twitter_init();
        # Locations to pull data from
        $places = array(
            "Los Angeles" => 2442047,
        );
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
        The real-time information part of the site is still a work in progress, so check out the resources page below if you want to help out in other ways.
        Also, I'm not sure how mobile friendly the site is yet, so I apologize for poor appearance/formatting on mobile.
        </p>

        <h4>Locations</h4>
        <a href="#LosAngeles">Los Angeles</a>

        <?php
        echo "<h5>Protest-Related Tweets On " . date("d/m/Y") . "</h5>";
        ?>

        <section id="LosAngeles">
        <?php
        # Code for Los Angeles location
        # Put in a list (https://www.w3schools.com/w3css/w3css_lists.asp)
        # Grab trends from a location
        $trends = get_location_trends($twitter, $places["Los Angeles"]);
        
        # Filter out BlackLivesMatter related trends
        $blm_trends = array();
        for ($i = 0; $i < count($trends); $i++) {
            if (preg_match("/BlackLivesMatter|protest|loot/i", $trends[$i]->{"name"})) {
                array_push($blm_trends, $trends[$i]->{"name"});
            }
        }
        
        if (count($blm_trends) === 0) {
            # No trends for LA area
            echo "No protest trends on Twitter for the Los Angeles area!";
        } else {
            # TODO: Search for BLM related Tweets
            echo "<ul class=\"w3-ul w3-border\">";
            echo "<li><h6>Los Angeles</h6></li>";

            for ($i = 0; $i < count($blm_trends); $i++) {
                $json = search_twitter($twitter, $blm_trends[$i]);

                for ($j = 0; $j < 5; $j++) {
                    $screen_name = "@" . $json->{"statuses"}[$j]->{"user"}->{"screen_name"};
                    $tweet = $json->{"statuses"}[$j]->{"text"};

                    if (strlen($screen_name) < 1 || strlen($tweet) < 1) {
                        continue;
                    }

                    echo "<li>" . $screen_name . ": " . $tweet . "</li>";
                }
            }

            echo "</ul>";
        }
        ?>
        </section>

        <hr>
        <footer class="w3-blue-grey">
        Made with 💙 by <a href="https://github.com/thecodeweaver/">TheCodeWeaver</a>
        </footer>

    </body>
</html>