## About Full Stack Developer Dome

This is a very simple dome with separate front-end and back-end
The front end is just an input box and submit button. There is also a table showing the data
The backend has three API interfaces, please see the table below

Api list

ACTION | URL | illustrate
---- | ----- | ------  
GET    | /api/movies        | Show the last 100 pieces of data 
POST   | /api/movies        | Save new data
DELETE | /api/movies/{id}   | Delete a piece of data

I have deployed it on my private server and uploaded it to GitHub. 

Website: <a href="https://maple.chen-ray.cn"> https://maple.chen-ray.cn </a>

gitHub: <a href="https://maple.chen-ray.cn"> https://github.com/chen-ray/maple </a>

This DOME is developed using Laravel, if you want to deploy it to your local viewing. 
Please ensure that your PHP version is greater than or equal to 8.1. 
Please rename the .env.example file to .env in the root directory and set the relevant configuration of MySQL, 
and then run the 'php artisan migrate' and 'npm run build' command to create the data table. 
If you have any questions please contact me on Upwork or email me.
