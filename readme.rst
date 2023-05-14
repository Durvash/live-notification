###################
Live Table Data
###################

Framework : Codeigniter 3 HMVC
REST API
AJAX
Jquery
socket.io

Project has 2 types of User:
1. Admin
2. Manager

-------------- Description ---------------
Manager can change the value field In table minimum value should be Rank 1 and so on and that table
live update in admin side login with live

The Ranks have to be assigned in according to ascending order and values can be changed. The system
and change in rank must be LIVE.
---------------


To install, follow below steps:

1. Clone Repository
2. Move project into the your local server directory  e.g, wamp/www/
3. open command and type "npm install", to install dependency of Node server
4. after that type "node server.js", to start the node server
5. now, open http://localhost/live-notification

* Using "Admin" user, you can only show the rank data
* Using "Manager" user, you can edit data

while you changing data, you can see in the "admin" user's browser page also appear changes without reload page.
Note: you need to login with both user in the different different browser
