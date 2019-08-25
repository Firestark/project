# A new application architecture in PHP



## A good application architecture

In his presentation: [architecture the lost years](https://www.youtube.com/watch?v=NeXQEJNWO5w) Robert C Martin explains what a good application architecture is. Mr. Martin explains that one of the major purposes of a good application architecture is immediately showing the application's intent. Whenever you look at the top directory structures you should immediately see the use-cases of the application. These use-cases tell you about what the application can do, in other words it shows you it's intent. Another important point Robert C. Martin suggests about application architecture is that it allows for major decisions to be deferred. Big choices like what database to choose and what delivery mechanism to use to deliver the application to the end user must be able to be deferred for as long as possible. This deferral of big choices has some major benefits. First of all you don't have to concern yourself with the big choices right away and therefor you can focus on implementing the most important part first: The business logic. A second benefit is that when deferring choices you'll create more flexible code. The databases and delivery mechanisms become more like plug-ins to the business logic. This makes it so that you can easily swap them later. Third of all you'll be able to make better decisions on what components to actually use. If you have deferred major decisions and have implemented the business logic of your application you will have a better understanding of what components work most optimal with that business logic. An example of that is that it will be much easier to decide whether to choose for a NOSQL document store or a relational database.

## A word about Model View Controller (MVC)

The most popular PHP architecture nowadays is model view controller (MVC). PHP frameworks like laravel and symfony use it to structure applications into triads of models views and controllers. The MVC architecture is a nice way to separate the gross of code into 3 parts. The most obvious of those parts is the view.  In the view goes all your HTML and any stuff that has to do with printing things on the screen. Second to the view you have the model. The model is a little trickier than the view. Models are like entities extending a base class. This extending gives your entities the capabilities of talking via an object relational mapping (ORM) to the database. So models are kind of like where your state resides. Finally you have the controller. The controller glues everything together and does the remaining necessary logic to make the application work. This looks like a very solid application architecture, at least until Mr. Robert C Martin came along. In his famous presentation: [architecture the lost years](https://www.youtube.com/watch?v=NeXQEJNWO5w) Robert C Martin explains what a good architecture actually is. Mr. Martin explains that one of the major purposes of a good application architecture is immediately showing the application's intent. MVC lacks in showing an application's intent. Whenever you look into the main folder of an MVC application all you can see are the model, view and controller directories. Nothing tells you what the application actually does.



## A business driven application architecture





## Robert C Martin keynotes

- IO  - Device independence
- The web is a delivery mechanism
- The first thing i see: it's a rails app
- Architecture is about intent
- The web should be a plugin to the business rules
- A good architecture allows for (major) decisions to be deferred.