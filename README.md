# Blog

An object-oriented Blog using PHP. 

As an admin, you can write, edit and delete blog posts; publish or delete comments; delete users or give them admin access. 
As a regular user, you can create an account, read blog posts, submit comments and send messages through the contact form. 

## Getting Started

### Requirements

PHP 7.1
SQL database 

### Installing

Clone the GitHub repository in your new folder
```
git clone git@github.com:Dzov/Blog_PHP.git
```

Create a new database and import the sql files

Create a Parameters.php file in the config folder. Copy and paste the content of the Parameters.dist file in the newly created file and replace the placeholders with your parameters. 

Check out the [SwiftMailer Documentation](https://symfony.com/doc/current/reference/configuration/swiftmailer.html) to configure Swiftmailer according to your parameters.

Install the dependencies using composer

```
composer install
```

## Versioning

I used [GitHub](https://github.com/Dzov/Blog_PHP) for versioning. 

## Authors

**Amélie-Dzovinar Haladjian** 

## Acknowledgments

* Many thanks to my mentor Sébastien Duplessy
