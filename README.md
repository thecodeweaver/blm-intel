# blm-alert
This is a fork of [tweet-intel](https://github.com/thecodeweaver/tweet-intel) to provide information on Black Lives Matter protests.
Made with 💙 by TheCodeWeaver.
Thanks J7mbo for creating the [twitter-api-php](https://github.com/J7mbo/twitter-api-php) library!

## Running in a Docker container
1. Pull the Apache PHP Docker container from webdevops: `docker pull webdevops/php-apache`
2. Run the following command to start the container: `docker run -v [tweet-intel source directory]:/app/ -p 80:80 -i webdevops/php-apache`
3. Setup your environment variables according to the code
`ACCESS_TOKEN="[Twitter API Access Token]"`
`ACCESS_TOKEN_SECRET="[Twitter API Access Token Secret]"`
`CONSUMER_KEY="[Twitter API Key]"`
`CONSUMER_SECRET="[Twitter API Secret Key]"`

3. Run `ifconfig` to determine the IP address of your container (so you can access the web server)
4. Visit the IP address from step 4 to see the Tweet Intel page.