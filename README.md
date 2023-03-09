# Samir Wonde Tech Test

## Run the code

This app has been built using laravel sail
Ideally you will have docker installed to make setting up easier

1. clone repo
2. in terminal cd into the app root and run 
```
docker run --rm \
   -u "$(id -u):$(id -g)" \
   -v "$(pwd):/var/www/html" \
   -w /var/www/html \
   laravelsail/php82-composer:latest \
   composer install --ignore-platform-reqs
```
3. copy the .env.example file to .env
4. add an wonde api token to WONDE_API_TOKEN
5. run ./vendor/bin/sail up
6. in a new terminal tab cd back into root of app
7. run ./vendor/bin/sail npm install
8. run ./vendor/bin/sail npm run build
9. go to localhost and it should load
