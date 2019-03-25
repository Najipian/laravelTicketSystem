## About Ticket System

Ticket System is a customer help ticket system built with laravel. Its designed for property system where tenants can follow up with their properties landlords.

## Architecture 

#### users

- users table contains all the system users and all of them are considered tenant users.
- landlord table contains reference from users table to demonstrate user who owns properties. 
- landlord can have multiple landlord users attached to his account (like a customer support users) by referencing their parent_landlord_id to his landlord id.
  
#### properies

- A property is owned by one landlord.
- and can be assigned to one tenant.

#### tickets

- A tenant user can create a ticket by choosing only a property assigned to him .The ticket will be automatically assigned to that property landlord , and an email notification is sent to landlord .
- Only property's landlord owner or the assigned landlord user can comment back on this ticket (Tenant user notified by email).
- Only landlord owner can assign one of his landlord users to comment on the ticket.
- Only the property owner can change the ticket status (Tenant user notified by email).

## Constants

- System constants stored under App\Extras\constants.php and config\static_array.php.
- Constants in the constants.php file are for in line PHP coding.
- static_array.php contains rendering data for constants defined in constants.php to be used in views (e.g: names and colors for constants).

## Installation

clone this repository in your web server directory , and run the following commands on that directory :
- composer update
- php artisan migrate
- php artisan db:seed
- php artisan passport:install

## APIs 

- Get /tenant/ticket/statistics
- Get /landlord//ticket/statistics
- API Collection :
    https://documenter.getpostman.com/view/2613551/S17tQ7di

