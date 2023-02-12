# SocialPoint technical test

## The challenge

I prioritized development speed in most of my decision.

The test is done in PHP (I wanted Rust, but since you specified you preferred PHP or Go I went for PHP, 
I have no idea of GO, but with PHP I feel quite comfortable).

The test is done using CQRS architecture (which is based in hexagonal architecture).
Supported by the Symfony framework.

> Wait! Are you coupling yourself to Symfony Framework?

Well, I am, in two key points:
* I am using Symofony Dependency Injection system

So I don't need to go instantiating all of my services and having to do all by myself.
It's way faster using Symfony's autowire and other tools.

* I am using Symfony Kernel

Since in the task description there were "endpoints suggested", I assumed I would
have to have some kind of web server and http controllers. This is already at the
very infrastructure level, It's better to use something that already exists like
Symfony controllers.

If the access point had been through terminal, I would have avoided Symfony all together.
(or maybe not, to use the Symfony Commands).

In any case you will see is quite framework agnostic, apart from the points above
everything related to symfony is relegated to teh infrastructure layer.

> What are you using for the web server?

For the main reason to go fast, I am using the main Symfony Server as web server,
so no need to have two dockers with nginx and php-fpm.

yes, it's not for production, but this is a test, it's not going to go to production.

> Why there's no docker compose?

Since I am using a single docker, there is no need for a docker compose (even though
it simplifies the commands... sorry you have to write all the long docker run xxx
commands)

> Directory Structure?

Since I am using Symfony's Dependency Injection System (it's container) and
as the web server, I didn't
want to start customizing too many things, so I kept a typical Symfony 
framework directory structure modifying mainly the /src directory to
have a proper hexagonal architecture, but still
the config/ directory where I specify all the services and it's dependencies it's very
well much needed.

> Is it really CQRS?

Yes it is. But everything is synchronous, and I am almost not using any bus.
it's like the minimal expression of CQRS. CQRS Lite you can call it.

If we should use in memory persistence to avoid using external persistence mechanisms,
it makes even less sense to rely on the need of infrastructure to mount a real
asynchronous system, so there's no queues everywhere and everything is being
called directly.

The only bus I explicitly added is the event bus. It also happens synchronously
but that one is important to add to show the distinction between commands and queries
and how are they glued together. That would be the very first piece to make
async if we were to continue with this project.

> Your testing directories are weird

Yes, my way to see testing is all together with a pipeline when deploying to 
production (it all comes from the Continuous Integration Book).

So I divide the tests into unit testing, but I call them "commit", since they
should be executed at every commit.

Then I would have integration tests (mainly to check env variables) and acceptance
tests (I still haven't found an appropriate name for them, because a unit
test can almost become acceptance test if most of the logic is in the domain
which is quite often). The acceptance test are supposed to test the whole system.

Inside each type then it's a typical testing directory.

The acceptance test here is mainly to have a kernel symfony alive for more than
one request, so 

> So testing code coverage

Well, to go fast, I've mainly only tested the Domain, I made sure that the
task would work by using the acceptance test pretending to be a client.

So it's not as desirable as it should be. I normally strive for 100%, but I took
maybe other worse decisions for the sake of fast development (using
symfony, avoiding some pattern or checking some user input) , so not having
100% coverage is not the worst here.

> How should I check the code?
 
You should start with the domain tests and see how the domain is supposed to work.

There are a couple of places in the domain that I approached the problems with a functional programming
mindset (not all the way to use higher order functions, but keeping immutability as
much as possible -inside the sanity- and using higher order arguments).

Since I haven't spent much time adding integration or acceptance tests, you can 
as well follow the instruction to start the application below.



## Installation

You need docker installed in your machine. Composer PHP is a nice to have but not mandatory.


### With Composer PHP
If you have composer (PHP) installed in your machine do the following.

### Without Composer PHP
Execute this commands at the root of this project:

xx
xx

## Testing

### With PHP installed

(if you have composer installed chances are that you have also php installed)

execute:
`bin/phpunit --testsuite=unit`

### With Composer PHP


execute:
`bin/phpunit --testsuite=unit`

### With Docker


execute:
`bin/phpunit --testsuite=unit`


> Why when using Postman always returns an empty rank board?
 
Because Symfony Kernel is booted for every request. Meaning, the
process is alive until the request is done. Since I am using in memory
persistence (basically a PHP array), this array gets removed at every request.

> Then how can I check it actually works
 
I have added in the acceptance test a beautiful script that prints in the terminal
the result of some random queries.

It works because the kernel is booted at the beginning of the test and kept alive
until the test finishes, so you can see how the ranking board is being modified.

There are some helper functions, so you might want to modify them and try other things.

You might be able to break the application, since I haven't tested all the edge
cases.



