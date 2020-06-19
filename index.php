<!DOCTYPE html>
<html>
    <head>
        <title>BLM Intel</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8" /> 
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">

        <style>
            html {
                /* To make use of full height of page*/
                min-height: 100%;
                margin: 0;
            }
            body {
                min-height: 100%;
                margin: 0;
            }
        </style>
        
        <?php
        # Set up our Twitter API client
        require "twitter.php";
        $twitter = twitter_init();
        # Locations to pull data from
        $places = array(
            "Los Angeles" => 2442047,
            "Sacramento" => 2486340,
            "New York" => 2459115
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
            <div class="w3-card w3-theme-d2">
                <ul class="w3-ul">
                    <li><h6>Los Angeles</h6></li>
                    <?php
                        $tweets = get_tweets_by_location($twitter, $places["Los Angeles"]);

                        if ($tweets[0] === "None") {
                            echo "<li>No protest trends on Twitter for the Los Angeles area!</li>";
                        } else {
                            for ($i = 0; $i < count($tweets); $i++) {
                                echo "<li>" . $tweets[$i] . "</li>";
                            }
                        }
                    ?>
                </ul>
            </div>
            </section>

            <section id="Sacramento">
            <div class="w3-card w3-theme-d2">
                <ul class="w3-ul">
                    <li><h6>Sacramento</h6></li>
                    <?php
                        $tweets = get_tweets_by_location($twitter, $places["Sacramento"]);

                        if ($tweets[0] === "None") {
                            echo "<li>No protest trends on Twitter for the Sacramento area!</li>";
                        } else {
                            for ($i = 0; $i < count($tweets); $i++) {
                                echo "<li>" . $tweets[$i] . "</li>";
                            }
                        }
                    ?>
                </ul>
            </div>
            </section>

            <section id="New York">
            <div class="w3-card w3-theme-d2">
                <ul class="w3-ul">
                    <li><h6>New Yorks</h6></li>
                    <?php
                        $tweets = get_tweets_by_location($twitter, $places["New York"]);

                        if ($tweets[0] === "None") {
                            echo "<li>No protest trends on Twitter for the New York area!</li>";
                        } else {
                            for ($i = 0; $i < count($tweets); $i++) {
                                echo "<li>" . $tweets[$i] . "</li>";
                            }
                        }
                    ?>
                </ul>
            </div>
            </section>
        </div>

    <div class="footer w3-theme-d4" style="margin-top:20px;">
    Made with 💙 by <a href="https://thecodeweaver.github.io/">TheCodeWeaver</a>
    </div>

    </body>
</html>