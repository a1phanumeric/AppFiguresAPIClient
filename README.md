AppFiguresAPIClient
===================

A PHP client for the AppFigures RESTful API


Setup
-----

Setup is simple, just simply include the AppFiguresAPIClient.php file into your page, and have your AppFigures username and password handy!


Usage
-----

Firstly, create a new instance of the AppFiguresAPIClient class (using your AppFigures account username and password):

`$AppFiguresClient = new AppFiguresAPIClient('USERNAME', 'PASSWORD');`

This will automatically perform a connection to the AppFigures API, and retrieve your user data (for faster access later). If there is a problem retrieving this, the code will die (and let you know).

All returned data is stored as a multi-dimensional array in `$AppFiguresClient->lastResponse`.

Example
-------

This example will print the array of reviews for a particular product ID. *(Note, you can get the product ID from the `$AppFiguresClient->GetProducts()` call)*:

```
include_once 'AppFiguresAPIClient.php';
$AppFiguresClient = new AppFiguresAPIClient('USERNAME', 'PASSWORD');
print_r($AppFiguresClient->GetReviewsForProductId(88512));
```


API Calls
---------

Every API call will return the response data if successful, or false if unsuccessful. If any API call is unsuccessful, you can print `$AppFiguresClient->error` to see why it failed.

There are only a few API calls right now, but more to be added shortly.

They are as follows:

- **GetUserData()** - This is automatically called on the class constructor, but can be called anytime if you need to refresh anything.
- **GetProducts()** - Returns an array of your apps on AppFigures.
- **GetReviewsForProductId((int)productId, (bool, optional)compressed)** - Returns an array of a particular product's reviews. The compressed BOOL is optional, but recommended (so the default is true). Compressing the array removes much of the review response packet, to give you a simple array of reviews.


License
--------

Copyright (C) 2012 edrackham.com

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.