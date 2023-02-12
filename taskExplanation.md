# 1. your task is to implement a service that maintains a "real-time" ranking of a user
----

Your task is to implement a service that maintains a "real-time" ranking of users playing a specific game.

## REquirements

* Clients submit user scores when they achieve important milestones in the game
* Clients can submit absolute scores or relative scores, for example: {"user":123, "total":250}, or {"user":456, "score": "+10"}, or {"user":789, score:"-20"}
* Any client can request the ranking at anytime, using one of the following requests:
* Absolute ranking, for example: Top100, Top200, Top500
* Relative ranking, for instance: At100/3, meaning 3 users around position 100th of the ranking, that is positioned 97th, 98th, 99th, 100th, 101st, 102nd, 103rd.
We propose that it have the following endpoints:
* [POST] user/{user_ud}/score
* [GET] ranking?type=1op100
* [GET] ranking?type=At100/3

## TEchnical requirements

* We prefer you to develop the test in one of the main languages we use at SP (PHP or Golang_ but if you don't feel comfortable enough with them, feel free to choose any other
* Do not couple yourself to a specific framework, as the test is pretty simple we prefer to see how big is your knowledge of what goes under the hood
* Do not use any database or external storage system, just keep the ranking in-memory (NB if you use a stateless language there's no need to keep this storage anywhere after the process dies)
* The code must work and sort as specified in this document

## Goals to evaluate

* How you approach teh project (we left some stuff intentionally open, so you have to evaluate trade-ofs and mae some decisions)
* How you apply SOLID principles, design patterns, and best practices in your approach
* How you design and architecture the system
* How you test and ensure the overall quality of the solution

## Nice to have
* Docker with docker-compose
* Readme to explain how we can check the code
* Testing with full code coverage or important code for you.

## What to deliver
* Create a zip file containing all the source code files you needed for your implementation
* Your code must compile and run, we won't accept a partial or a non-working solution.