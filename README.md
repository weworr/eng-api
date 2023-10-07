# Project rewrote from Django to Symfony 5.4
It was diploma project for engineer degree on Gdansk University of Technology. 
We had STM32 development board which was sending measurements to MQTT broker (there was Mosquitto broker).
## FYI
I know that commits are not perfect in this project. I did not use branches and was commiting changes directly to master,
but it was doing in free time for fun and for learning RabbitMQ and symfony/messenger. 
## How to run project:
1. Set Discord Webhook details in .env if you want to get error logs on discord channel.
2. Run project with docker and wait
```shell
docker-compose up -d
```
3. If you want to enable symfony messenger consume run
```shell
docker-compose exec php bin/console messenger:consume
```
## Dependencies:
1. PHP 8.2
2. MongoDB 6.0.8
3. RabbitMQ 3.12.2
4. Discord
