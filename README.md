# tweet-intel
A web application that displays real time information by scraping tweets. Made with 💙 by TheCodeWeaver

## Running in a Docker container
1. Follow instructions [here](https://www.linode.com/docs/applications/containers/how-to-install-docker-and-deploy-a-lamp-stack/) to install a Docker LAMP stack container.
2. Run the following command to start the container and attach it to the project directory:
`sudo docker run --name=php -v [DIRECTORY WHERE THIS PROJECT IS LOCATED]:/var/www/example.com/public_html/ -p 80:80 -t -i linode/lamp /bin/bash`
3. Once the container is launched, run `service apache2 start` to start the Apache Web Server.
4. Run `ifconfig` to determine the IP address of your container (so you can access the web server)
5. Visit the IP address from step 4 to see the Tweet Intel page.

