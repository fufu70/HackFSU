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
        $rssfeed = "";

        foreach($x->channel->item as $entry) {
            $rssfeed .= "

                <div class='col-lg-12'>
                        <div class='media'>
                            <a class='pull-left' href='#'>
                                <img class='media-object' src='...' alt='...'>
                            </a>
                            <a class='pull-right btn btn-success' href='#'>
                                :)
                            </a>
                            <div class='media-body'>
                                <h4 class='media-heading'>".$entry->title."</h4>
                                ".$entry->description."
                            </div>
                        </div>
                </div>";
        }

        return $rssfeed;
    }
}