# Youtube Stream Status
Simple class to check youtube stream status. It supports youtube link contains `/channel/{id}` and `/user/{name}`.

# Example route
```
Route::get('/youtube/{url?}', 'YoutubeStreamStatus@checkUrl')->where('url', '(.*)');
```
### Supported links
https://host/youtube/https://www.youtube.com/user/NewerDocumentaries
http://host/youtube/https://www.youtube.com/channel/UC87iZ03xDe8csLCjWyV2E0AaS

# Output
`$output['title']`

returns stream title

`$output['description']`

returns stream description

`$output['channelTitle']`

returns streaming channel title

`$output['videoId']`

returns video ID

`$output['liveBroadcastContent']`

returns live/offline

`$output['streamUrl']`

returns stream link e.g. https://www.youtube.com/watch?v=`$output['videoId']`

`$output['streamEmbedUrl']`

returns embed link to stream e.g. https://www.youtube.com/embed/`$output['videoId']`

# Object/JSON
You could also use objects e.g.

`$objectOutput->title`

and JSON

`$jsonOutput['title']`
