# A new application architecture in PHP

The most popular PHP architecture nowadays is model view controller (MVC). PHP frameworks like laravel and symfony use it to structure applications into triads of models views and controllers. At first i really liked this architecture. The MVC architecture was a nice way to separate the gross of my code into 3 parts. The most obvious of those parts was the view.  In the view goes all your HTML and any stuff that had to do with printing things on the screen. Second to the view you have the model. The model was a little trickier than the view. Models were like some kind of entities extending a base class. This extending gave your entities the capabilities of talking via an object relational mapping (ORM) to the database. So models were kind of like where your state resides. Finally you had the controller. The controller glued everything together and did the remaining necessary logic to make the application work. I was happy having this separation so i could structure my applications better, until Mr. Robert C Martin came along. In his famous presentation: [architecture the lost years](https://www.youtube.com/watch?v=WpkDN78P884) Robert C Martin explained what a good architecture actually is. He explained that one of the major purposes of a good application architecture is immediately showing the application's intent. MVC lacks in showing an application's intent. Whenever you look into the main folder of an MVC application all you can see are the model, view and controller directories. Nothing tells you what the application actually does.





## Robert C Martin keynotes

- IO  - Device independence
- The web is a delivery mechanism
- The first thing i see: it's a rails app
- Architecture is about intent
- The web should be a plugin to the business rules
- A good architecture allows for (major) decisions to be deferred.