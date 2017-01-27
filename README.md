# RESTful API for Artsper with Silex & Doctrine ORM

Foundation for RESTful API for Artsper, a contemporary art marketplace where galleries selected across the World can sell their artworks.

The foundation uses silex micro framework to handle requests and responses and doctrine orm to handle data and database.

**27-Jan-2017**

- Implemented HTTP Basic Authentication for all routes under `/artwork/`. The configuration is applied in `resources/config/dev.php`. For now, only Basic Authentication has been applied. All calls under route `/artwork/` must be called with HTTP Authorization header. For now, the authorization is set to `admin` as username and `pwd` as password.

```
POST /artwork/search
Authorization: Basic YWRtaW46cHdk
Content-Type: application/json
{
	"order":"desc",
	"category_id":26
}
```

**26-Jan-2017**

- Prepared routes for editing and removing artworks.
- Editing:

Request:
```
POST /artwork/edit
Content-Type: application/json
{
   "artwork_id":145,
   "title":"Artwork 04 E",
   "biography":"This is a description of the artwork.",
   "year":2015,
   "price":666.66,
   "certificated":1,
   "framed":1,
   "numbered":1,
   "artist_id":1,
   "category_id":26,
   "gallery_id":23,
   "width":103.2,
   "height":10.5,
   "length":1.8
}
```
`artwork_id` is required for editing.

Response:
```
{
  "success": 1,
  "artwork_id": 145
}
```

- Removing:

Request:
```
POST /artwork/del
Content-Type: application/json
{
   "artwork_id":145
}
```

Response:
```
{
  "success": 1
}
```
If artwork is not found, it will send `404 Not Found` with following response:
```
{
  "success": 0,
  "error": "Artwork not found"
}
```

- For adding, editing and removing artworks, all validations are handled with **Symfony Validator** which is implemented in `src/Artsper/Controller/Artwork.php`.

For example, calling the `artwork/edit` without any parameter will give response with `400 Bad Request` as follows:
```
{
  "success": 0,
  "error": {
    "title": "This field is missing.",
    "biography": "This field is missing.",
    "year": "This field is missing.",
    "price": "This field is missing.",
    "certificated": "This field is missing.",
    "framed": "This field is missing.",
    "numbered": "This field is missing.",
    "width": "This field is missing.",
    "height": "This field is missing.",
    "length": "This field is missing.",
    "artist_id": "This field is missing.",
    "category_id": "This field is missing.",
    "gallery_id": "This field is missing.",
    "artwork_id": "This field is missing."
  }
}
```

- Prepared routes for artwork search:

Request:
```
POST /artwork/search
Content-Type: application/json
{
   "per_page": 60,
   "order": "asc",
   "category_id": 26,
   "page": 1
}
```
If no options are provided, it will return all artworks.

Response:
```
{
  "success": 1,
  "artworks": [
    {
      "id": 136,
      "title": "Artwork 01",
      "biography": "This is a description of the artwork.",
      "year": 2015,
      "price": 333.33,
      "dimensions": {
        "w": 103.2,
        "h": 10.5,
        "l": 1.8
      },
      "is_certificated": true,
      "is_framed": true,
      "is_numbered": true,
      "artist": {
        "id": 1,
        "firstname": "John",
        "lastname": "Doe",
        "birthday": 1980,
        "biography": "This is some biography",
        "country": {
          "id": 73,
          "label_fr": "France",
          "label_en": "France",
          "seo_url_fr": "/france",
          "seo_url_en": "/france"
        }
      },
      "category": {
        "id": 26,
        "label": "Photography",
        "seo_url": "/photography"
      },
      "gallery": {
        "id": 23,
        "name": "Artsper Gallery",
        "email": "artsper@gallery.com"
      }
    },
    ...
    {
      "id": 198,
      "title": "Artwork 01 edited",
      "biography": "This is a description of the artwork.",
      "year": 2015,
      "price": 444.44,
      "dimensions": {
        "w": 103.2,
        "h": 10.5,
        "l": 1.8
      },
      "is_certificated": true,
      "is_framed": true,
      "is_numbered": true,
      "artist": {
        "id": 1,
        "firstname": "John",
        "lastname": "Doe",
        "birthday": 1980,
        "biography": "This is some biography",
        "country": {
          "id": 73,
          "label_fr": "France",
          "label_en": "France",
          "seo_url_fr": "/france",
          "seo_url_en": "/france"
        }
      },
      "category": {
        "id": 26,
        "label": "Photography",
        "seo_url": "/photography"
      },
      "gallery": {
        "id": 23,
        "name": "Artsper Gallery",
        "email": "artsper@gallery.com"
      }
    }
  ],
  "current_page": 1,
  "total_pages": 4,
  "total_artworks": 200
}
```


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