#Youtube Stream Status
Simple class to check youtube stream status

#Example route
```
Route::get('/youtube/{url?}', 'YoutubeStreamStatus@checkUrl')->where('url', '(.*)');
http://host/youtube/https://www.youtube.com/user/NewerDocumentaries
```
