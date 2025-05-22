# P2P-VIDEO-STREAMING-APP
P2P-VIDEO-STREAMING APP
# Components

The application was made using PHP and laravel. The frontend is primarily based on blade templated even though some livewire components have also been used. The backend is based on laravel entirely and uses laravels MVC framework.

# Working of the application
Clone the application. Install PHP (I used PHP 8.3) and Laravel. Install Laragon and update the .env file with database credentials. Set up a pusher account and set .env credentials accordingly. Install all npm and composer dependencies. run the command 'php artisan migrate' in the root directory of the application to migrate all tables to the configured database. you can change the database driver inside the config files, i am using MySQL as the primary database.

The app only allows p2p video streaming, which means only 1 user can join the room other  than the leader of the room. The user can join using the invite link, which is available to the leader of the room. Make sure u only upload .mp4 videos. friends can be added using their unique ids which are available on the Profile page.  

It is recommended to serve the files through apache2/nginx. Serving using artisan, will lead to video seeking not working. It will also cause other video sync issues, since artisan does not send headers to the browser. An easy fix for this is using laragon.

Install laragon (version 6 is free), move the app folder to the /www directory inside laragon. Make sure to enable Virtual Hosts. You can now access the website using http://p2p-video.test (depending on the name of the folder).
