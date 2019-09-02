# Application architecture



## A good application architecture

In his presentation: [architecture the lost years](https://www.youtube.com/watch?v=NeXQEJNWO5w) Robert C Martin explains what a good application architecture is. First Martin explains that one of the major purposes of a good application architecture is immediately showing the application's intent. An application's intent can be seen by looking at it's use-cases. For that reason, the best way of clearly showing an application's intent is by placing the use-cases in their own directory at one of the top directories of that application. One of the advantages of an application that clearly shows it's intent is that it is easy to know what the application does. To illustrate, a new software engineer can join the team, look at the use-cases of the application and should immediately have a good idea of what the application does. Another advantage of clearly showing application intent becomes apparent when communicating the application's requirements to stakeholders. Because the use-cases are made very clear, you can easily check if the application does what the stakeholders expected it to do. A final advantage is that it is easier to locate where the use-cases do not enforce the needed requirements. This make it easy to correct the application when needed.

The second point Robert C. Martin suggests about application architecture is that it allows for major decisions to be deferred. Big choices like what database to choose and what delivery mechanism to use must be deferred for as long as possible. Deferral of big choices has some major benefits. First of all you don't have to concern yourself with the big choices right away and therefor you can focus on implementing the most important part first: The business logic. Second of all, you'll create more flexible code because of two reasons. A: You don't rely on exclusive features that a particular component offers to you. B: You won't be able to mix code from a particular component into your business logic. Components like databases and delivery mechanisms become like plug-ins to the business logic and these plug-ins can easily be swapped out later if needed. Third of all you'll be able to make better decisions on what components to actually use. If you have deferred major decisions and have implemented the business logic of your application you will have a better understanding of what components work most optimal with that business logic. For example: It will be much easier to decide whether to choose for a NOSQL document store or a relational database.

## A word about Model View Controller (MVC)

The most popular PHP architecture nowadays is model view controller (MVC). PHP frameworks like laravel and symfony use it to structure applications into triads of models views and controllers. The MVC architecture is a nice way to separate the gross of code into 3 parts. The most obvious of those parts is the view. The view holds all your HTML and any code that has to do with printing things on the screen. Second to the view you have the model. The model is a little trickier than the view. Models are like entities extending a base class. This extending gives your entities the capabilities of talking via an object relational mapping (ORM) to the database. So models are kind of like where your state resides. Finally you have the controller. The controller glues everything together and does the remaining necessary logic to make the application work. This looks like a very solid application architecture, at least until Mr. Robert C Martin came along. In his famous presentation: [architecture the lost years](https://www.youtube.com/watch?v=NeXQEJNWO5w) Robert C Martin explains what a good architecture actually is. Mr. Martin explains that one of the major purposes of a good application architecture is immediately showing the application's intent. MVC lacks in showing an application's intent. Whenever you look into the main folder of an MVC application all you can see are the model, view and controller directories. Nothing tells you what the application actually does.



## A business driven application architecture

... talk about how to setup a business driven application architecture



... Way too often you here lets choose this database, lets use this framework

... instead lets focus on the business requirements first



An example of this methodology can be seen in the firestark framework...



## Robert C Martin keynotes

- IO  - Device independence
- The web is a delivery mechanism
- The first thing i see: it's a rails app
- Architecture is about intent
- The web should be a plugin to the business rules
- A good architecture allows for (major) decisions to be deferred.