<!DOCTYPE html>
<html>
    <head>
        <title>BLM Intel</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8" /> 
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
        
        <?php
        # Set up our Twitter API client
        require "twitter.php";
        $twitter = twitter_init();
        # Locations to pull data from
        $places = array(
            "Los Angeles" => 2442047,
            "Sacramento" => 2486340
        );
        ?>

    </head>

    <body class="w3-container w3-theme-d5 w3-mobile">

        <div class="w3-bar w3-theme-d4">
            <h1>BLM Intel: Real time protest information and resources.</h1>
            <a href="/index.php" class="w3-bar-item w3-button">Home</a>
            <a href="/resources.html" class="w3-bar-item w3-button">More Info</a>
        </div>

        <div class="w3-theme-d5">

            <h4>No protests going on? Check out <a href="/resources.html">this link</a> for more info!</h4>

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

            <section id="Sacramento">
            <?php
            # Code for Los Angeles location
            # Put in a list (https://www.w3schools.com/w3css/w3css_lists.asp)
            # Grab trends from a location
            $trends = get_location_trends($twitter, $places["Sacramento"]);
            
            # Filter out BlackLivesMatter related trends
            $blm_trends = array();
            for ($i = 0; $i < count($trends); $i++) {
                if (preg_match("/BlackLivesMatter|protest|loot/i", $trends[$i]->{"name"})) {
                    array_push($blm_trends, $trends[$i]->{"name"});
                }
            }
            
            if (count($blm_trends) === 0) {
                # No trends for LA area
                echo "No protest trends on Twitter for the Sacramento area!";
            } else {
                # TODO: Search for BLM related Tweets
                echo "<ul class=\"w3-ul w3-border\">";
                echo "<li><h6>Sacramento</h6></li>";

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
        </div>

    <div class="footer w3-theme-d4">
    Made with 💙 by <a href="https://github.com/thecodeweaver/">TheCodeWeaver</a>
    </div>

    </body>
</html>