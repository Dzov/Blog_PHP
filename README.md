# Blog [![Codacy Badge](https://api.codacy.com/project/badge/Grade/4818533c96634bda92311e4548c4db79)](https://www.codacy.com/app/amelie.haladjian/Blog_PHP?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=Dzov/Blog_PHP&amp;utm_campaign=Badge_Grade)

An object-oriented Blog using PHP. 

As an admin, you can write, edit and delete blog posts; publish or delete comments; delete users or give them admin access. 
As a regular user, you can create an account, read blog posts, submit comments and send messages through the contact form. 

## Getting Started

### Requirements

PHP 7.1

SQL database 

### Installing

Install the project on your computer.
```
git clone git@github.com:Dzov/Blog_PHP.git
```
Create a new database and import the sql file located in the resources folder.

Rename the Parameters.dist file located in the config folder as Parameters.php and change the class name to Parameters. 
Replace the placeholders with the parameters that match your configuration.   

Check out the [SwiftMailer Documentation](https://symfony.com/doc/current/reference/configuration/swiftmailer.html) if you need help with SwiftMailer's configuration.

Install the dependencies using composer.
```
composer install
```

Check out the blog in your browser ! 

## Resources 

Diagrams can be found here : [UML Diagrams](https://github.com/Dzov/Blog_PHP/tree/master/resources/diagrammes)

Code quality has been analyzed with [Codacy](https://app.codacy.com/project/amelie.haladjian/Blog_PHP/dashboard?branchId=7250899)

The different issues can be found on [Github](https://github.com/Dzov/Blog_PHP/issues?q=is%3Aissue+is%3Aclosed)

## Versioning

I used [GitHub](https://github.com/Dzov/Blog_PHP) for versioning. 

## Authors

**Amélie-Dzovinar Haladjian** 

## Acknowledgments

* Many thanks to my mentor Sébastien Duplessy
