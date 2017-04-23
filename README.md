# Youtube Stream Status
Simple class to check youtube stream status. It supports youtube link contains /channel/{id} and /user/{name}.

# Example route
```
Route::get('/youtube/{url?}', 'YoutubeStreamStatus@checkUrl')->where('url', '(.*)');
```
### Supported links
http://host/youtube/https://www.youtube.com/user/NewerDocumentaries
https://www.youtube.com/channel/UCtu2v8rnsF05S4M5sWAr0RwV
