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
---
The specific feedback:

* Do not couple yourself to a specific framework: 
  * The team hasn't found the justifications to be enough for coupling to Symfony
  * There's a lot of unneeded boilerplate due to the coupling to SF fwk that
* How you test and ensure the overall quality of the solution:
  * Tests are not covering the key parts and they go mostly through the happy path.
  * The balance in between time invested in code structure and tests is not good. This taking also into account that we've found commented lines along the code
  * Most of the test depends on the model built for CQRS but this part is not tested as well as the controllers which are not properly covered
* Readme is not explaining how can we check the code 'til the line 100. TBH it's been tedious to go through so many justifications such as testing directories, testing coverage, usage of framework, ... They've made the review team to take those points even more into account that they would have initially
* We have found difficulties justifying your use of CQRS in the way you used it:
  * Commands and Queries end being DTOs which are handled by "services/handlers"
  * Readme states that you're using CQRS without command or query bus... why having an event bus for the most important of the solution but not for commands and queries, this looks pretty inconsistent from our PoV
  * You can see an example that could generate an interesting discussion in SubmitScoreCommandHandler. The handler is writing both in the repository and publishing an event which is in fact the most important part of the test who is delegated.

---

Oh, so the solution here is not good for Social Point, let's review the feedback point by point

## "Coupling to the framework"

> Do not couple yourself to a specific framework: 

Specifically:

> The team hasn't found the justifications to be enough for coupling to Symfony

Let's review my justification here:

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

I normally only install the Http Foundation and the dependency Injection, I did that
in other challenges. I could have tried that, even though
it would have taken more time to fine grain the packages. I agree with that, but keep in mind
that this is a context of a tech challenge with a time constraint, 

## Am I really coupling to the framework ?

Well, the question is that NO, I am not. It has been an unfortunate use of my words
assuming that whoever corrected the test would see it in the code.

Obviously that person, nor anybody in the chain going to the very top of SocialPoint
didn't actually see that I am not coupling to the framework.

I am using Hexagonal Architecture totally clean, there's no leakage of infrastructure
on the other layers. That's how I keep myself uncoupled to the framework.

What I should have said instead is that **I used Symfony framework**. But my assuming
that other people would know about hexagonal architecture, I described it in a demeaning
way to my interests.

The conclusion that one can get here is that **the corrector didn't realize that this was
done in hexagonal architecture**. That's very telling. **If you check the code is plain
obvious.**


# Missing Tests

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

And about that: `test depends on the model built for CQRS` again they seem to be totally
clueless to the fact that CQRS is based on hexagonal architecture. That's the actual model
in the code. **The corrector not only doesn't know about hexagonal architecture but
is totally clueless to CQRS too.**

## Are tests really missing ?

If you consider infrastructure tests to be crucial, yes they are missing. But
**considering infrastructure tests to be crucial is a wrong approach** which undermines
the philosophy of DDD.

I did write an infrastructure test, whole acceptance tests that proves the correctness
of the whole system. It didn't seem they actually found that. But since they don't know
about hexagonal architecture, is expected that they don't know either about DDD, nor
testing conventions. Or deploying pipelines, the ONLY place where tests actually matter!

The conclusion that I could get here is that the corrector misses the point of both DDD
and hexagonal architecture by asking infrastructure tests.

# README too long

> Readme is not explaining how can we check the code 'til the line 100. TBH it's been tedious to go through so many justifications such as testing directories, testing coverage, usage of framework, ... They've made the review team to take those points even more into account that they would have initially

I am not sure whether to appreciate the honesty, taking into account the lack of knowledge
oozed from this feedback. This sentence is a plain attack to me. It has nothing to do
with the technical test and yet you have the courage to say that it made you to be stricter
when correcting the test.

"That you correct a test" it's kind of an oxymoron since it's obvious that you've never read
any book about coding, patterns or software architecture. The feedback so far has 
been useless plus this lack of respect.

You say reading about testing directories has been tedious? I thought we could have a 
discussion as equals. Justifications about the directory structure? Well I think
it's important, don't you? It gives intention and shows how the layers
of hexagonal architecture properly. Did I write about testing coverage? I don't
think I did.

So reading about justifying decision has been tedious. That implies something. You were
bored correcting it, and you don't think those justifications are important. You are 
dismissing me saying it's not worth your time to understand my reasoning. 

I am not worth your time.

This is a clear lack of respect and honestly, now it's my honesty, that you decide it's OK
to send back this feedback to me with a lack of respect tells a lot about your culture and
about you as a person, not only the ones that "gave feedback", but the one who click the send
button for that email. It makes me wonder heavily what are your values and your standards.

Despite being treated disrespectfully, I will try to engage on the following discussions:

# Use of CQRS

> We have found difficulties justifying your use of CQRS in the way you used it: 

Yes, you are right, but, why not? I could do it in less than 8 hours, so while is not
the best choice, who cares, it's done properly. -- Reading the rest, it looks
like you don't understand the use of CQRS because I didn't use a command bus.
I hope you know CQRS is not about the busses, right?

> Commands and Queries end being DTOs which are handled by "services/handlers"

That's precisely what they are! This is my quoting the "CQRS By Example"

> CQRS By Example -> In essence, we can state that Command are DTOs

Are you sure you know about CQRS? It doesn't look like you know. The book above
is a great way to start reading about it!

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
 
I think I already explain why. And that the handler writes to the repository and publishes
is inevitable. I repeat, inevitable. How to avoid it? With Event Sourcing.

Which is a whole new level. I can go there too, but I am sure I will be received with 
the same contempt I have been received with this **simple version of CQRS** attempt. 
The points here are basically pointing to the places that matters the least,
proving that they don't really have the knowledge. (It's available in many books).
It's interesting that you've been confused by those insignificant parts, like
not having a command bus or testing the controller, but not interested
on how cqrs pattern solved this problem by making the view instantly available.

And the interesting discussion is where? Above is my saying, where's yours? You don't
write any discussion because you are afraid that you won't hold being correct? or
of course since I am wasting your time, it's not worth your time to actually
engage in it.

 





