# Calculator

##  How to run?
This project I built with docker in mind so if you don't have it you can get it here:

https://docs.docker.com/docker-for-mac/install/

Once you have docker installed and you've cloned this repo you can run

    $ make
 This will do all that is required to set up the application including creating three docker containers 
- nginx
- php
- redis

## The Make Command   


The Make command uses docker compose and creates a network called challenge.

The make command runs:

    $ cp src/.env.example src/.env
To copy over .env so you can then add any additional secrets.

Then it runs:

    $ docker-compose build && docker-compose up -d
    
This builds the new docker containers based of the docker-compose.yml file then starts them.

Once that complete the make command then will run: 

    $ docker exec -it app composer install

This runs composer install inside the app docker container. This allows you to use this application without having composer installed on your machine.

## Take it down?

So, now you want to take it down? well simply run:

    $ docker-compose down
    
WARNING make sure you do this in the project root.

## What I did?

I built a calculator application using PHP and Laravel as the framework.

I use the redis to store the 10 previous equations for easy quick access.
    
    
## Thank you!

I look forward to hearing your feed back
