<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class YoutubeStreamStatus extends Controller
{
    public $key_api;

    public $requestWithChannelId;
    public $requestWithChannelName;
    public $queryAddress;

    public $channel_id;
    public $channel_name;

    public $title;
    public $description;
    public $channelTitle;
    public $getChannelIdAddress;
    public $liveBroadcastContent;
    public $videoId;

    public $streamUrl;
    public $streamUrlParam;
    public $streamEmbedUrl;

    public function __construct()
    {
        $this->key_api = "{youtube_key_api}";
        $this->queryAddress = "https://www.googleapis.com/youtube/v3/search?";
        $this->getChannelIdAddress = "https://www.googleapis.com/youtube/v3/channels?";
        $this->streamUrl = "https://www.youtube.com/watch?";
        $this->streamEmbedUrl = "https://www.youtube.com/embed/";
    }

    public function checkUrl($url)
    {
        
        if(str_contains($url, 'channel'))
        {
            $this->channel_id = $this->getChannelIdFromSlug($url);
            return $this->getStreamStatus($this->channel_id);
        } elseif (str_contains($url, 'user')){
            $this->channel_name = $this->getChannelNameFromSlug($url);
            return $this->getChannelId($this->channel_name);
        } else {
            return response(['status' => 'bad url']);
        }
    }

    public function getChannelId($channel_name)
    {
        $this->requestWithChannelName = array(
            'key' => $this->key_api,
            'forUsername' => $channel_name,
            'part' => 'id');

        $this->requestWithChannelName = http_build_query($this->requestWithChannelName);
        $getChannelId = file_get_contents($this->getChannelIdAddress.$this->requestWithChannelName);
        $getChannelId = json_decode($getChannelId);


        if($getChannelId->items)
        {  
            $this->channel_id = $getChannelId->items[0]->id;
            return $this->getStreamStatus($this->channel_id);
            
        } else {
            return response(['status' => $this->status]);
        }

    }

    public function getStreamStatus($channel_id)
    {
        $this->requestWithChannelId = array(
            'part' => 'snippet',
            'channelId' => $channel_id,
            'type' => 'video',
            'eventType' => 'live',
            'key' => $this->key_api
        );

        $this->requestWithChannelId = http_build_query($this->requestWithChannelId);

        $getStreamStatus = file_get_contents($this->queryAddress.$this->requestWithChannelId);
        $getStreamStatus = json_decode($getStreamStatus);

        if($getStreamStatus->items)
        {
            $this->title = $getStreamStatus->items[0]->snippet->title;
            $this->description = $getStreamStatus->items[0]->snippet->description;
            $this->channelTitle = $getStreamStatus->items[0]->snippet->channelTitle;
            $this->liveBroadcastContent = $getStreamStatus->items[0]->snippet->liveBroadcastContent;
            $this->videoId = $getStreamStatus->items[0]->id->videoId;
            
            $this->streamUrlParam = array(
                'v' => $this->videoId
            );

            $this->streamUrlParam = http_build_query($this->streamUrlParam);

            $output = array(
                'title' => $this->title,
                'description' => $this->description,
                'channelTitle' => $this->channelTitle,
                'videoId' => $this->videoId,
                'liveBroadcastContent' => $this->liveBroadcastContent,
                'streamUrl' => $this->streamUrl.$this->streamUrlParam,
                'streamEmbedUrl' => $this->streamEmbedUrl.$this->videoId
            );

            $objectOutput = json_decode(json_encode($output), FALSE);
            //return $objectOutput->title;

            $jsonOutput = json_encode($output);
            //return $jsonOutput['title'];

            return $output;

        } else {
            return response(['status' => 'offline']);
        }
    }

    public function getChannelNameFromSlug($url)
    {
        $string = explode('user/', $url);
        $channelName = $string[1];
        return $channelName;
    }

    public function getChannelIdFromSlug($url)
    {
        $string = explode('channel/', $url);
        $channelId = $string[1];
        return $channelId;
    }

}
