<?php
/*
 * Password hashing with PBKDF2.
 * Author: havoc AT defuse.ca
 * www: https://defuse.ca/php-pbkdf2.htm
 */

// These constants may be changed without breaking existing hashes.

class RSSFeed
{
    public static function getRssFeed($feed_url)
    {
        $content = file_get_contents($feed_url);
        $x = new SimpleXmlElement($content);
         
        $rssfeed = "<ul>";

        foreach($x->channel->item as $entry) {
            $rssfeed .= "<li><a href='$entry->link' title='$entry->title'>" . $entry->title . "</a></li>";
        }
        $rssfeed .= "</ul>";

        echo $rssfeed;  

        return $rssfeed;
    }
}