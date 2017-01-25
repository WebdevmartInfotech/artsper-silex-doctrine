# RESTful API for Artsper with Silex & Doctrine ORM

Foundation for RESTful API for Artsper, a contemporary art marketplace where galleries selected across the World can sell their artworks.

The foundation uses silex micro framework to handle requests and responses and doctrine orm to handle data and database.

**25-Jan-2017**
- Prepared route for adding artwork (in `src/controllers.php`)
- Prepared dedicated controller for handling artwork related routes like add, edit etc (in `src/Artsper/Controller/Artwork.php`)
- For adding artwork, call must be placed to `/artwork/add` with json similar to below:
```
{
    "title":"Artwork 01",
    "biography":"This is a description of the artwork.",
    "year":2015,
    "price":102.5,
    "certificated":1,
    "framed":1,
    "numbered":1,
    "artist_id":1,
    "category_id":25,
    "gallery_id":23,
    "width":103.2,
    "height":10.5,
    "length":1.8
}
```
If the creation of artwork is successful, a json response will be returned with the id of the newly created artwork with status code `201 Created`.
```
{
  "success": 1,
  "artwork_id": 137
}
```
If `success` in response is `0`, then there will be an `error` having a message.
All the fields for creating artwork are required except `biography`.
- Until now, two types of error have been worked on. If any required field is not sent through request, a json response will be returned with `success:0` and status code `200 OK`. If any entity is not found like artist or category, then an error will be returned with `404 Not Found`.


**24-Jan-2017**
Until now, the initial setup with doctrine entities has been prepared. Routes are yet to be declared.