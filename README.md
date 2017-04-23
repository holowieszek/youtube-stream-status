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

returns stream link e.g. `https://youtube.com/watch?v=$output['videoId']`

`$output['streamEmbedUrl']`

returns embed link to stream e.g. `https://www.youtube.com/embed/$output['videoId']`

# Object/JSON
You could also use objects

`$objectOutput->title`

and JSON

`$jsonOutput['title']`

# Example output
```
array:7 [▼
  "title" => "NASA LIVE: 👽🌎 "EARTH FROM SPACE" ♥ #SpaceTalk (2017) LIVE FEED HDVR | Subscribe now!"
  "description" => "Earth from Space ♥ (2017) NASA Livestream SpaceTalk - 24/7 Rotate ISS HD Camera is presented. Livestream Earth seen from space powered by NASA ..."
  "channelTitle" => "SPACE & UNIVERSE (Official)"
  "videoId" => "RtU_mdL2vBM"
  "liveBroadcastContent" => "live"
  "streamUrl" => "https://www.youtube.com/watch?v=RtU_mdL2vBM"
  "streamEmbedUrl" => "https://www.youtube.com/embed/RtU_mdL2vBM"
]
```
