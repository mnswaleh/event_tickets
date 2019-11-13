###################
Ticket Booking App
###################

This application enables users to book tickests to events and admins to manage events

*******************
Technology
*******************

-PHP
-Bootstrap
-JQuery

#### Setting up ####

- use provided sql dump file to create database.
- Sign up new user
- To create admin, change user role from `1` to `2` in  `users` table on the database
- Set up `smtp_user`, `smtp_pass` and `->email->from()` on the `Reservations` controller to be able to send email 
