# Excellence in application architecture

This article should give you a good idea of what an application architecture is and is supposed to achieve.



## Key principles of application architecture

In his presentation: [architecture the lost years](https://www.youtube.com/watch?v=NeXQEJNWO5w) Robert C Martin explains what an application architecture is supposed to achieve. First Martin explains that one of the major purposes of application architecture is immediately showing the application's intent. In other words the application should clearly show what it is supposed to do. One of the advantages of an application that clearly shows application intent is that it is easy for new software engineers to know what the application does. This will help new software engineers a tremendous amount in understanding the business of the application and therefor also the company to an extend. This understanding of the business in turn, makes it easier for new software engineers to work on the application because they have more context on what they application is supposed to achieve. Another advantage of clearly showing application intent becomes apparent when communicating the application's requirements to stakeholders. It is not always the case that the expected requirements from the stakeholders is perfectly understood by the engineers that are building the application. This mismatch of understanding in requirements can be overcome with the help of an application that clearly shows it's intent. Because the use-cases of the application are made very clear, the engineers can easily explain to the stakeholders what the application does. The stakeholders in turn can give the engineers accurate feedback on were the functionality differs from what they expected. With this feedback the software engineers can correct the functionality of the application. A final advantage of clearly showing application intent is that the application requirements become easier to reason about. Maybe there are some requirements that don't make sense. Maybe there are requirements that conflict with each other. An architecture that clearly shows application intent is an architecture that allows that intent to be evaluated. In other words the application requirements are easy to understand. These easy to understand requirements make it possible for the engineers to evaluate the requirements and give feedback on these requirements to the business stakeholders where needed. Engineers become more than just 'code builders', they understand the business, think with the business and collaborate with the stakeholders to create the best possible application (requirements).



Second Robert C. Martin suggests that application architecture should give the ability to defer major decisions. Big choices like what database to choose and what framework to use must be deferred for as long as possible. Deferral of big choices has some major benefits. First of all you don't have to concern yourself with the big choices right away and therefor you can focus on implementing the most important part first: The business logic. Second of all, you'll create more flexible and easier to understand code because of two reasons. A: You don't rely on exclusive functionality that a particular component offers to you. B: You won't be able to mix code from a particular component, package or framework into your business logic. Databases, delivery mechanisms and even frameworks become like plug-ins to the business logic and these plug-ins can easily be swapped out later if needed. Third of all you'll be able to make better decisions on what components, packages or frameworks to actually use. If you have deferred major decisions and have implemented the business logic of your application you will have a better understanding of what components, packages or frameworks work most optimal with that business logic.



Following the previous two noted points you will end up with a flexible application architecture that separates business logic from technical logic. This flexible application architecture allows you to adapt to quickly changing application requirements. Whether it's the stakeholders that change the requirements to act on a change in the market or some changes in law regulations that force the application to change, the application is ready to adapt.



## Model View Controller (MVC)

A popular application architecture nowadays is model, view, controller (MVC). Originally MVC is not meant to be an application architecture but is first invented as a UI related pattern that separates user input, data and output into their own components. MVC originates at small talk and is developed to structure small components, like for example a radio button or a check-box, into triads of models, views and controllers. The model, view and controller each have their own responsibility. The model holds data related to the component, knows about some basic (business) rules to manipulate that data and knows how to persist that data. The view consist of code to format the data from the model into something the input output (IO) device can understand and render on the screen. The view listens for changes in the model and changes it's output (making the rendered view change) when the model's data changes. The controller listens for user input and translate those inputs into commands for the model with which the model can change it's data if applicable. To illustrate, a button on the screen could have an MVC triplet:

-  A controller that listens for user input that corresponds to the button
- A model with some data and basic (business) rules that has something to do with that button
- A corresponding view that makes up the button on the screen based on the model

When for example the user clicks on that button the controller receives a click event. The controller takes this click event and tells the model to update it's data. The view sees that the model has updated it's data and in response updates it's view of that data on the screen. 

In MVC the model is not allowed to know where it gets it input from, in other words the model is not allowed to know what device is delivering the input, that is the job of the controller. Also the model is not allowed to know anything about the format that is used to deliver the data to the end user, that is the job of the view. The model is only allowed to know about the data and how to manipulate and persist that data. With this separation the model is a reusable piece of code that can be used no matter what IO device is being used. 





<img src="./MVC/MVC.png" width="500" align="center" vertical-align="top">

> [RegisFrey](https://commons.wikimedia.org/wiki/User:RegisFrey). (Designer). (2010).  *The model, view, and controller (MVC) pattern relative to the user.* [Digital image]. Retrieved from https://commons.wikimedia.org/wiki/File:MVC-Process.svg



### MVC as application architecture

MVC is a great pattern for what it is originally meant to do, namely separating data from input and output, making it so you can reuse the models (data) for different input and output devices. Because MVC excels so much at what it does some developers think that MVC would also be a good fit to use as application architecture. Some frameworks implement MVC as an overarching application architecture. Within these frameworks all the application logic is separated into models, views and controllers. The model stores and retrieves data used by the application and applies (business) rules to storing and retrieving that data. The view takes data from the models and displays this in some way to the end user. The controller takes in a user request and commands the model to update its state based on that request. There are however some differences when compared to the traditional MVC pattern. The first difference is that a controller acts as a bridge between the model and a view. The controller takes some user request, gathers all the data from that user request, then commands a model to update it's state using that gathered data, receives the updated state from that model and then commands the view to render with that updated state. The second difference is that a view no longer is one small component like a button or a check-box but instead is the entire screen. The view being the entire screen also means that there are multiple models being used to show that screen. So in conclusion we end up with a controller that talks to multiple models to receive some updated data and then passes that updated data into a view which is the entire screen.



#### Pros of using MVC as an application architecture

Even though there are some differences when compared to the traditional MVC pattern, MVC as an application architecture has some benefits. The first benefit is that MVC gives you a general structure to split up a large part of your application code. Your application is divided into 3 separate tasks, namely: model, view and controller. Because of this generic structure you, and other developers that work with your code, will have a general understanding of how your application is build. The second benefit is that MVC is very widely used as an application architecture. A lot of frameworks chose to implement MVC as their application architecture. Because of the popularity of MVC a lot of people will understand how your application is build. A third advantage of MVC is that it is easier to collaborate with multiple developers working on the same project. Because of the separation of model, view and controller a front-end developer can work on the view without being bothered by a back-end developer who works on the model and controller and vice-versa.



#### Cons of using MVC as an application architecture

One of the major downsides of using MVC as an application architecture is not clearly showing application intent. When using MVC as application architecture you will see 3 directories in your application's project namely: models, views and controllers. This setup shows you that the application is build with the MVC architecture but tells you little to nothing about what the application is intended to do. The MVC architecture scatters the application's use-cases throughout the models, views and controllers. To figure out something about what the application is intended to do you need to take a clear look through all the technical clutter which are the models, views and controllers. To illustrate: we could have the following files: a model file: `Todo`, a view file: `todos-list` and a controller file: `TodoController`. Here only the view tells us that we should be able to list out to-dos. The model and controller only tell us that we have some kind of todo. Only now that we have looked through all the models, views and controllers do we know that there is some kind of todo listing feature. The `todos-list` view is likely to be reused for every type of todo list we have in the application. We could for example have a feature that shows only 'done' to-dos. Nothing in the filenames of the model, view or controllers tells us about that we could have a 'done' to-dos list.

Another downside of MVC as application architecture is the tendency to get large controllers. Controllers group different actions for one specific resource together. To illustrate: You could have a `TodoController`. That controller keeps all sorts of different actions about to-dos. Listing to-dos, creating to-dos, updating to-dos, viewing to-dos and deleting to-dos all are grouped together in this one controller.

A third con of using MVC as application architecture is that models group business logic together with implementation logic to persist application state. Models usually communicate via an Object Relational Mapping (ORM) to a database or other persistence mechanism. Models are also the place to put business rules for that application state. With this setup your business rules are very tightly coupled to the technical persistence implementation.

A fourth downside of MVC as application architecture is that boundaries between models, views and controllers are not well enough defined. Controllers and views both want to call methods on the models. Because the models live so closely to the controllers and the view, it becomes very easy to write controller and view logic into the models, which clutter the business logic with even more technical code. Although it is possible to keep an MVC application organized correctly, it is very difficult to keep the separations between model, view and controller right.



## A business driven application architecture (Guidelines to implement a good application architecture)

An easy to make mistake, when starting up a new application, is to start building right away. To illustrate: The first step that would be on your mind is gathering the tools you need to kick-start your application. It is at this moment that you'll likely debate on what framework and database to use. In your decisions you'll weigh off some technical considerations, for example if you are building a web application, you'll pick a web framework or if you're building an API, you'll pick a framework focused on building API's. However, all these decisions and technical considerations are distractions. They distract you from the real important thing which are the application requirements. The first thing you should do when starting a new project is gathering all the minimal needed requirements to create a minimum viable product (MVP). Gathering requirements is an important and difficult step that is often underestimated or even skipped entirely. Gathering requirements is the process of understanding what you are going to build and why you are building it. This process may seem like an easy step at first but in reality it is not. First of all there can be a lot of people with different roles involved in defining and implementing of the requirements. A customer explains what he wants from the application, a project leader listens to the customers application desires and tries to understand what the customer needs. The programmers hear from the project leader what needs to be built and each programmer will have his own interpretation of the explanation of the project leader. As you can see this already introduces multiple layers of communication that can effect the understanding of the application's requirements. Even if the requirements are perfectly clear at the start of the project, the customer might change his mind later on. Maybe the customer found a more effective way to solve the application problem or maybe a change in law regulations or the market might make the customer change the requirements.



---

Requirements on themselves are already difficult to get right alone, having an architecture that supports them make it easier to get the requirements right and deliver the right application. 

---





When you have gathered all the minimal needed requirements you'll have a good idea of what the application is going to do and then you're ready for the second step. The second step is translating the requirements into code. The requirements will give you some use-cases that the application needs to fulfill. An example of such a use-case is create order:

---------------





# Create order

## Data

<Customer-id>,												<Customer-contact-info>,
<Shipment-destination>,					<Shipment-mechanism>
<Payment-information>,



## Primary course

1. Order clerk issues "Create order" command with above data
2. System validates all data
3. System creates order and determines order-id
4. System delivers order-id to clerk



## Exception course

1. System delivers error message to clerk





--------------



Within these use-cases there are likely to be some business rules. Business rules tell what you may, may not do or must do. Examples of such (business) rules are: Items that drop below a minimum amount in stock must be re-ordered and: Only a gold pass user may overdraw currency on his account. all these use-cases and business rules form the business logic of your application. 



It is important to keep this business logic as dependency free as possible. Ideally you want to code all the business logic using only the chosen programming language and thus not include third party packages, libraries and frameworks. This means that this layer doesn't know anything about data persistence, IO channels and any other technical implementations.



The last step is coding all the technical requirements needed to create a working application. Until now the business logic is kind of like pseudo code. On it's own it doesn't deliver any value to your end users because they cannot use it without any technical knowledge. In this last step you will bridge that gap and create a user interface as well as a persistence mechanism that implement the business logic to create a working application. This is the point where you can decide on what framework and database to use. The wisest decision you can make here is choosing a framework and database that is easiest to implement the business logic with. Whenever you need some more sophisticated tools you can easily replace them later because they are plugins to the business logic.



`Some of these technical requirements will have to do with speed, yet others with consistency or way of delivery to the end user`



 

------

Drafts

------

it is possible to build a good application using the MVC architecture, but you need a lot of disciplined engineers. It'd better if we choose for an architecture that 'hard separates' business logic from technical implementation.



An application's intent can be seen by looking at it's use-cases. For that reason, the best way of clearly showing an application's intent is by placing the use-cases in their own directory at one of the top directories of that application.



**Knowing when your done with the application (requirements).**



`Example of such (business) rules are: A user-name may only occur once in the application and: Only a gold pass user may overdraw currency on his bank-account.`



The model is not allowed to know where it gets it input from, the model is not allowed to know what device is delivering the input, that is the job of the controller.



... Cons of MVC

- On a large scale, like application architecture, controller like logic seeps into the models, and model like logic seeps into the view leaving you with no clear separation. In MVC as an application architecture the views know about the models which your business logic resides in. The view should know nothing about the business logic. Controllers should not know about the business objects.
- MVC says nothing about what the application does (looking at the directory structure)
- The controllers group multiple actions together which can make controllers quite big
- With MVC your business logic becomes part of technical implementations like the IO channel (web) and the database. Technical implementations should be plug-ins to the business logic.
- Models hold your business logic, models also read and write to persistence, models may even include tasks related to data management, such as networking and data validation. This couples your business logic to all sorts of tasks it shouldn't be connected to
- Business procedures are better modeled using closures instead of objects
- View must only know how to present data to the user. They don't know or understand *what* they are presenting.
- ... Some logic doesn't clearly fit in either the model, view or controller. The result is that that code ends up in the controller.
- ... The boundaries between Business logic and Technical / Implementation logic are not well enough defined to keep the business logic separated from the Technical / Implementation logic
- The controller has a lot of responsibilities:
  - Unpack all the parameters that came from a request
  - Find the right model and pass the found parameters to the model
  - Take the models response and call the right view with the right parameters
  - Group all related actions on a resource together
- Not focused on the business logic
- No code reuse



You can gather these requirements by creating user-stories, user scenarios and use-cases.



Business rules need to be flexible, business people and law change and when they change, the business rules change and so does our code that encapsulate business rules



With a clear separation between business rules and technical implementation it becomes easier to port the application into an entire other programming language. The [programming language](https://en.wikipedia.org/wiki/Programming_language) would be different. The [source code](https://en.wikipedia.org/wiki/Source_code) would be entirely different. The tools ([IDE](https://en.wikipedia.org/wiki/Integrated_development_environment)s, [compilers](https://en.wikipedia.org/wiki/Compiler), and such) might be entirely different. The [user interface](https://en.m.wikipedia.org/wiki/User_interface) might be entirely re-organized or have a different [look-and-feel](https://en.wikipedia.org/wiki/Look-and-feel). The [documentation](https://en.m.wikipedia.org/wiki/Documentation) would probably be different. But the purpose of the two projects, the end results of work performed / goals accomplished, would be the same, the business logic stays the same.



Way too often developers want to start coding on a project right away. Without paying too much attention to what the application's requirements are these developers start gathering their dependencies. First they decide what framework to use. Looking through the most popular to date frameworks they pick one they were interested in and install it. Second they decide to use a particular database. Hmm MYSQL seems like a fine option, it served me well in the past so it will serve me for this application as well. And off they go, writing business code mixed with framework and MYSQL code. This violates all the rules we have specified for a good application architecture. Major decisions are immediately taken at the cost of flexibility and clearly separated business rules. The intent of the application get's lost in the abundance of technical decisions that take over the application's architecture. We can do this better.



A nice way of gathering requirements is using feature files. Feature files are written in a structured human readable language called gherkin. 



Or we even decide that this application is for the web, and start coding and testing this application in a web driven environment. But at the beginning stages of development the web is a distraction (from the business logic).



A good way to start is by figuring out the application's requirements. First figure out what the application is supposed to do. Is it a large or a small application? What business rules are involved with this application?





... talk about how to setup a business driven application architecture



... Way too often you hear lets choose this database, lets use this framework

... instead lets focus on the business requirements first

... BDD with focus on features

... Create a very clear separation between business logic and implementation/technical logic



An example of this methodology can be seen in the firestark framework...



Hard to make changes because there is no documentation in place

use-cases are great documentation

use-cases are what developers can use to build from, testers can use to test from and tells the stakeholders what the system is doing for them.

use-cases help you changing an existing system by showing you what new things get added and what effects that has on current functionalities. 



## Robert C Martin keynotes

- IO  - Device independence
- The web is a delivery mechanism
- The first thing i see: it's a rails app
- Architecture is about intent
- The web should be a plugin to the business rules
- A good architecture allows for (major) decisions to be deferred.



## References

Robert C. Martin. (Software engineer, Software Instructor). (2018). [architecture the lost years](https://www.youtube.com/watch?v=NeXQEJNWO5w)

(Business Rules) https://www.youtube.com/watch?v=CEHbId7Icng

https://medium.com/@smartgamma/user-scenarios-user-stories-use-cases-what-s-the-difference-75bf75d4bb60



Requirements gathering

https://www.phase2technology.com/blog/successful-requirements-gathering





(Business rule vs business requirement)http://www.requirementsnetwork.com/rule-requirements.htm



https://cocoacasts.com/what-is-wrong-with-model-view-controller



https://www.youtube.com/watch?v=Y1WknmP0HEk

https://www.youtube.com/watch?v=RHdGn7WMWos



[RegisFrey](https://commons.wikimedia.org/wiki/User:RegisFrey). (Designer). (2010).  *The model, view, and controller (MVC) pattern relative to the user.* [Digital image]. Retrieved from https://commons.wikimedia.org/wiki/File:MVC-Process.svg