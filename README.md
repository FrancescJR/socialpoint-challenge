the feedback


```
Dear Francesc,

We have reviewed your test and, unfortunately, we have decided not to move forward with 
your candidacy for the current opening at Social Point, because the results did not match 
the requirements for this position.

The test has been rejected mostly because of not complying with the technical requirements,
but we're attaching other feedback points that we hope you find useful and that help you 
grow:


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
```

This feedback doesn't hold technically, and it comes with a lack of respect: "tbh it's
been tedious" implying that I am not worth their time.

good job.