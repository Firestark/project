# A new application architecture in PHP

## A good application architecture

In his presentation: [architecture the lost years](https://www.youtube.com/watch?v=NeXQEJNWO5w) Robert C Martin explains what a good application architecture is. Martin explains that one of the major purposes of a good application architecture is immediately showing the application's intent. Whenever you look at the top directory structures you should immediately see the use-cases of the application. These use-cases tell you about what the application does, in other words it shows you it's intent. Another important point Robert C. Martin suggests about application architecture is that it allows for major decisions to be deferred. Big choices like what database to choose and what delivery mechanism to use to deliver the application to the end user must be able to be deferred for as long as possible. This deferral of big choices has some major benefits. First of all you don't have to concern yourself with the big choices right away and therefor you can focus on implementing the most important part first: The business logic. A second benefit is that when deferring choices you'll automatically create more flexible code. You'll create more flexible code because you don't rely on features that a particular package brings with them. The databases and delivery mechanisms become like plug-ins to the business logic that you can easily swap out later if you desire. Third of all you'll be able to make better decisions on what packages to actually use. If you have deferred major decisions and have implemented the business logic of your application you will have a better understanding of what package works most optimal with that business logic. An example of that is that it will be much easier to choose whether to use a NOSQL document store or a relational database.

## A word about Model View Controller (MVC)

The most popular PHP architecture nowadays is model view controller (MVC). PHP frameworks like laravel and symfony use it to structure applications into triads of models views and controllers. The MVC architecture is a nice way to separate the gross of code into 3 parts. The most obvious of those parts is the view.  In the view goes all your HTML and any stuff that has to do with printing things on the screen. Second to the view you have the model. The model is a little trickier than the view. Models are like entities extending a base class. This extending gives your entities the capabilities of talking via an object relational mapping (ORM) to the database. So models are kind of like where your state resides. Finally you have the controller. The controller glues everything together and does the remaining necessary logic to make the application work. This looks like a very solid application architecture, at least until Robert C. Martin came along. In his famous presentation: [architecture the lost years](https://www.youtube.com/watch?v=NeXQEJNWO5w) Robert C Martin explains what a good architecture actually is. Martin explains that one of the major purposes of a good application architecture is immediately showing the application's intent. MVC lacks in showing an application's intent. Whenever you look into the main folder of an MVC application all you can see are the model, view and controller directories. Nothing tells you what the application actually does. Besides the lack of showing application intent MVC also has the tendency to mix your business logic with technical logic. When placing business logic in classes that extend a model you tie the business logic to the technical implementation that talks to the database.



## Requirements for a business driven application architecture

What we can make up out of the previous sections is that, to build a business driven architecture, we need to ensure 2 major things. First we need to make sure that the use-cases from the business logic are communicated very clearly. In other words we need to make an architecture in which the application clearly shows it's intent. The second thing we need is an architecture that allows for major decisions to be deferred. We want to ensure that we can work on our business logic for as long as possible without having to make big decisions that can have a great impact on our application. 



### Separating business logic from implementation logic

By separating the business logic from implementation logic the business logic will be easier to understand. It will be easier to understand because with the separation we don't have to be bothered with the implementation logic when we look at the business logic. Next to being easier to understand the separation is a required starting point to making the technical implementations behave as a plugin to the business logic. When implementations are mixed with business logic we have no easy way to replace those implementations.



### Dependency free business logic

An important thing about business logic is that it is self sufficient. Business logic must have no dependencies to the outside world. Everything that the business logic depends upon must be inside of the business logic layer itself. One reason to make business logic self sufficient is the ability to easily build I/O channels that implement that business logic. If the business logic has some outside dependencies in another layer it would be hard to take that business logic and build another I/O channel around it. Another reason to make the business logic dependency free is clarity. When everything that the business logic depends upon can be found in the business logic layer itself it is easier to understand the business logic. In other words you don't have to go search in technical stuff to find out what a thing in the business logic actually does.



### Deferral of choices with plugins

For a good business driven architecture we need the ability to defer major decisions. We can do this with the flexibility of plugins. Plugins are technical components to fulfill various kind of technical requirements. As an example we take the problem of persistence. The simplest way of solving this persistence problem is with an in-memory implementation. The in-memory implementation will remember the results of the business logic in memory. This will only remember the results for one request which might be sufficient for you to continue on working on the business logic. Undoubtedly there will come a point in time where you need the results to be persisted for more than one request. In that case the simplest solution to this problem is to create a flat-file persistence implementation. The flat-file implementation stores the results as serialized data in a file. This solution is very easy to implement and allows you to quickly start working again on the business logic. With this flat-file persistence implementation you can probably finish working on the business logic. At some point in time the flat-file implementation might become slow. This is the time to create an implementation that talks to a database system to persist and fetch the results. 

As you can see we gradually move up the complexity of implementations but only when we need it. We start out with simple implementations that just fulfill the needs we had to continue to work on our business logic. Later, when we have a working application, we might need to switch to other implementations for technical reasons. These technical reasons could be related to performance or maybe security. It is also possible however to not have to switch at all. Maybe the working implementation you ended up with proves to be sufficient. In this case you spared yourself the trouble of setting up complex solutions which proved to be not needed anyway. In the case you do have to switch to a more complex solution, you'll be able to make a better decision. This is the case because you have already worked out the business logic and seen all it's data structures. For this reason you'll be able to decide whether a NOSQL or relational database is a better fit.



## Robert C Martin keynotes

- IO  - Device independence
- The web is a delivery mechanism
- The first thing i see: it's a rails app
- Architecture is about intent
- The web should be a plugin to the business rules
- A good architecture allows for (major) decisions to be deferred.