# Blog

An object-oriented Blog using PHP. 

As an admin, you can write, edit and delete blog posts; publish or delete comments; delete users or give them admin access. 
As a regular user, you can create an account, read blog posts, submit comments and send messages through the contact form. 

## Getting Started

### Requirements

PHP 7.1

SQL database 

### Installing

Clone the GitHub on your computer.
```
git clone git@github.com:Dzov/Blog_PHP.git
```
Create a new database and import the sql file located in the resources folder.

Rename the Parameters.dist file located in the config folder as Parameters.php and change the class name to Parameters. 
Replace the placeholders with the parameters that match your configuration.   

Check out the [SwiftMailer Documentation](https://symfony.com/doc/current/reference/configuration/swiftmailer.html) if you need help with the configuration.

Install the dependencies using composer.
```
composer install
```

Check out the blog in your browser ! 

## Versioning

I used [GitHub](https://github.com/Dzov/Blog_PHP) for versioning. 

## Authors

**Amélie-Dzovinar Haladjian** 

## Acknowledgments

* Many thanks to my mentor Sébastien Duplessy
