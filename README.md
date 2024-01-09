# Online-Book-Rental-Store
This is the online book rental store where customer can visit page, login, register, add to cart, query, rent books with Stripe and it also have admin  panel where admin can add, delete, update -- book and customer and they can view order, return and feedback status of book. Also we charge certain amount on late return of books.

# Database configuration
We have provided you a database file (.sql) inside database file folder from there you can configure database inside your localhost what you need to do is you just have to go to loacalhost phpmyadmin from there you need to create database with name book-store after creating database go inside that database then go to import section and there you will see select file then select that book-store.sql file then click go button below.It's done congrats.

# Stripe Configuration
We have already provide stripe config file. You have to change the publishable and secret key with your own stripe account key.
And Notice that you may be sufferring from stripe error.
It's because stripe files isn't uploaded to this github due to some issues. So we have provided you zip file of stripe and vendor folder inside stripe.zip. So you need to unzip that stripe.zip file and place that stripe and vendor folder inside root folder. Finally stripe payment gateway will work.
