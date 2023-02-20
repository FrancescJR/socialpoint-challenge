# Review Result

```
Dear Francesc,

We have reviewed your test and, unfortunately, we have decided not to move forward with 
your candidacy for the current opening at Social Point, because the results did not match 
the requirements for this position.

The test has been rejected mostly because of not complying with the technical requirements,
but we're attaching other feedback points that we hope you find useful and that help you 
grow:
```

Oh so the solution here is not good for Social Point, let's review the feedback.

## Feedback

> Do not couple yourself to a specific framework: 

Especifically:

> The team hasn't found the justifications to be enough for coupling to Symfony

Let's review my justifiction here:

```shell
>> Wait! Are you coupling yourself to Symfony Framework?
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
```

As said above I could have made all the instances of the classes by hand,
that wouldn't have been a problem, it's just instantiating the classes through
some "news xxxx()".

Now for the controller, do they really want to write my own http controllers?
Well, that's as equally stupid as dellusional.  

Then: 
> There's a lot of unneeded boilerplate due to the coupling to SF fwk that

I grant this point, I normally only install the Http Foundation. I give you this point.
(and now that I think about it, I was thinking on using symfony messenger for
the buses, but since I didn't put any infra, yes... too much packages here).

I do agree on this one.

> How you test and ensure the overall quality of the solution:

> Tests are not covering the key parts and they go mostly through the happy path.
 
That's very interesting. Because I only covered the Domain, therefore they consider
the domain to NOT be a key part. Meaning: **there's probably no real Domain Driven Development
in this company, or it's greatly missunderstood**.

> The balance in between time invested in code structure and tests is not good. This taking also into account that we've found commented lines along the code

I really put extra careful effort on testing the domain, checking the domain tests you
see how you expect the domain to function. That's the philosophy. You could have seen
this was done via TDD.

The infrastructure and acceptance tests are secondary in nature. Especially with a
time constraint for the challenge, to prioritize the most important things.

And yes you can check here there's a commented line of code. Which I forgot to explain
on the README, but since maybe was already too long, I don't think it would have helped
understand.

> Most of the test depends on the model built for CQRS but this part is not tested as well as the controllers which are not properly covered

That's a weird affirmation. The test are only on the domain. Not on the model 
build on CQRS. That the whole CQRS is not tested that is, well, true, as well 
as controllers are not completely being tested.

Why not? It's all infrastructure tests. They would just amplify the domain error
which is tested at 100% I believe. So I only put one test, just to show that it
actually works.

If you want to test all the controllers, you can do it by "unit testing", which
is kind of useless, since it's basically written by symfony not me (a reason to use
symfony). Or you can acceptance test.  Those tests should be way less than the others.
but somehow **it was expected that I tested way more the infrastructure than the domain,
giving more importance to the infrastructure concerns.**

Infrastructure concerns are valid, but are easily solvable by vendors and using
third party libraries, not the core business.

> Readme is not explaining how can we check the code 'til the line 100. TBH it's been tedious to go through so many justifications such as testing directories, testing coverage, usage of framework, ... They've made the review team to take those points even more into account that they would have initially

Aha aha aha!!! That's the real reason they didn't like this test: **EGO**. They didn't expect
a candidate to explain things as I do in my blog. They didn't like that a candidate was 
treating oh the great correctors at SocialPoint as equal. So let's focus on, oh you coupled
yourself! Well, as a matter of fact, I did not, my domain is free of interferences
it could be even ported to another lanuage without much work. Oh you didn't do
enough feature/integration tests! Well, of course not, I would be an idiot if I did!

I appreciate the sincerity, though.

And finally.

> We have found difficulties justifying your use of CQRS in the way you used it: 

Yes, you are right, but, why not? I could do it in less than 8 hours, so while is not
the best choice, who cares, it's done properly. -- Reading the rest, it looks
like you don't understand the use of CQRS because I didn't use a command bus.
I hope you know CQRS is not about the busses, right?

> Commands and Queries end being DTOs which are handled by "services/handlers"

That's precisely what they are! This is my quoting the "CQRS By Example"

> CQRS By Example -> In essence, we can state that Command are DTOs

I guess you seem more troubled that there is no Command Bus:

> Readme states that you're using CQRS without command or query bus... why having an event bus for the most important of the solution but not for commands and queries, this looks pretty inconsistent from our PoV

I guess you needed an even longer README explaining why I didn't think the 
command bus or query bus are not as important. I think it's quite simple.

The need for "asyncronuosity" in the command is not as important as for the handling
for events. And the need for asnyc queries is even less.

I am not sure if I should try to explain why asynchonous queries are in general not needed.
So I will focus on the commands.

Commands would make for a nice async thing, that's right, instantly return the 200 or
204 accepted and exec the command later. But it's also nice to get the result whether
handling the command was OK or not. And I would say most of the cases you would like that.

And once I am not going to add a lot of infrastructure concerns on the managing
commands that normally fall to the command bus responsibility such as checking
the validity, logging, or ensuring a single transaction, I might as well pass
the command directly. For simplicity. It's a simple version... I said that.

Why I didn't do the same with the events? Because those are important to make them
async. That the whole point CQRS, not command buses or query buses, but actually
joining the two models together.

I didn't make it async because... why? yes! Because I need infra!

I think it's quite simple to understand why queries and commands just go directly
to the specified place and events are pretending to be async.

But apparently the use of the command bus or the even more useless query bus was more
important. I don't think you got your priorities right here.

> You can see an example that could generate an interesting discussion in SubmitScoreCommandHandler. 
> The handler is writing both in the repository and publishing an event 
> which is in fact the most important part of the test who is delegated.
 
I think I already explain why. That the handler writes to the repository and publishes
is inevitable. I repeat, inevitable. How to avoid it? With Event Sourcing.

Which is a whole new level. I can go there too, but I am sure I will be received with 
the same contempt I have been received with this **simple version of CQRS** attempt. 
The points here are basically pointing to the paces that matters the least,
proving that they don't really have the knowledge. (It's available in many books).
It's interesting that you've been confused by those insignificant parts, like
not having a command bus or testing the controller, but not interested
on how cqrs pattern solved this problem by making the view instantly available.

# End

>  we hope you find useful and that help you grow

I found them very useful at calibrating your company, but meaningless in knowledge. 
Missing Integration tests? of course I would try to test it all, I am not goign to on
a test... Totally meaningless, this feedback is either ignorant and arrogant,
or probably both.

I don't think it's me who needs to grow.


 





