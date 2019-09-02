# Application architecture



## A good application architecture

In his presentation: [architecture the lost years](https://www.youtube.com/watch?v=NeXQEJNWO5w) Robert C Martin explains what a good application architecture is. First Martin explains that one of the major purposes of a good application architecture is immediately showing the application's intent. An application's intent can be seen by looking at it's use-cases. For that reason, the best way of clearly showing an application's intent is by placing the use-cases in their own directory at one of the top directories of that application. One of the advantages of an application that clearly shows it's intent is that it is easy to know what the application does. To illustrate, a new software engineer can join the team, look at the use-cases of the application and should immediately have a good idea of what the application does. Another advantage of clearly showing application intent becomes apparent when communicating the application's requirements to stakeholders. Because the use-cases are made very clear, you can easily check if the application does what the stakeholders expected it to do. A final advantage is that it is easier to locate where the use-cases do not enforce the needed requirements. This make it easy to correct the application when needed.

The second point Robert C. Martin suggests about application architecture is that it allows for major decisions to be deferred. Big choices like what database to choose and what delivery mechanism to use must be deferred for as long as possible. Deferral of big choices has some major benefits. First of all you don't have to concern yourself with the big choices right away and therefor you can focus on implementing the most important part first: The business logic. Second of all, you'll create more flexible code because of two reasons. A: You don't rely on exclusive features that a particular component offers to you. B: You won't be able to mix code from a particular component into your business logic. Components like databases and delivery mechanisms become like plug-ins to the business logic and these plug-ins can easily be swapped out later if needed. Third of all you'll be able to make better decisions on what components to actually use. If you have deferred major decisions and have implemented the business logic of your application you will have a better understanding of what components work most optimal with that business logic. For example: It will be much easier to decide whether to choose for a NOSQL document store or a relational database.

## A word about Model View Controller (MVC)

A Popular application architecture for object oriented programming languages is Model View Controller (MVC). MVC structures applications into triads of models, views and controllers which each have their own responsibilities. 



Models manage the data that resides in your application. The model stores and retrieves data used by the application and apply (business) rules to storing and retrieving that data. Example of such rules are: A user-name may only occur once in the application and: Only a gold pass user may overdraw currency on his bank-account. The view takes the data from the model and displays this in some way to the end user. In web applications this usually means that the data is presented using HTML. The view registers with the model to watch for changes in the data of the model. Whenever the data in the model changes the view changes as well to display the new data to the user. The controller watches for input events from the user, typically from the mouse or keyboard, and uses those input events to sent commands to the model to update its data. MVC separates the concerns of: 1. input to the controller 2. processing to the model and 3. output to the view. 



The view is also the point where actions of the user are captured. This happens for example when a user submits a form or clicks a button. When such an action occurs the view triggers an action in a controller. The controller takes the data that a user submits and passes that data in the appropriate way on to the model. 



... The idea behind MVC was small, the size of a button. One screen would have hundreds of models, views and controllers. 



This looks like a very solid application architecture, at least until we apply the rules of Robert C Martin. Mr. Robert C Martin came along. In his famous presentation: [architecture the lost years](https://www.youtube.com/watch?v=NeXQEJNWO5w) Robert C Martin explains what a good architecture actually is. Mr. Martin explains that one of the major purposes of a good application architecture is immediately showing the application's intent. MVC lacks in showing an application's intent. Whenever you look into the main folder of an MVC application all you can see are the model, view and controller directories. Nothing tells you what the application actually does.



... Cons of MVC

- On a large scale, like application architecture, controller like logic seeps into the models, and model like logic seeps into the view leaving you with no clear separation. In MVC as an application architecture the views know about the models which your business logic resides in. The view should know nothing about the business logic. Controllers should not know about the business objects.
- MVC says nothing about what the application does (looking at the directory structure)
- The controllers group multiple actions together which can make controllers quite big
- With MVC your business logic becomes part of technical implementations like the IO channel (web) and the database. Technical implementations should be plug-ins to the business logic.
- Models hold your business logic, models also read and write to persistence, models may even include tasks related to data management, such as networking and data validation. This couples your business logic to all sorts of tasks it shouldn't be connected to
- View must only know how to present data to the user. They don't know or understand *what* they are presenting.



## A business driven application architecture

... talk about how to setup a business driven application architecture



... Way too often you here lets choose this database, lets use this framework

... instead lets focus on the business requirements first

... BDD with focus on features



An example of this methodology can be seen in the firestark framework...



## Robert C Martin keynotes

- IO  - Device independence
- The web is a delivery mechanism
- The first thing i see: it's a rails app
- Architecture is about intent
- The web should be a plugin to the business rules
- A good architecture allows for (major) decisions to be deferred.