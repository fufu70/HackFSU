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

        foreach($x->channel->item as $entry) 
        {
            $link_array = RSSFeed::getEmailAndFacebookFromDescription($entry->description);
            $rssfeed .= "

                <div class='col-lg-12'>
                        <div class='media'>
                            <a class='pull-left' href='#'>
                                <img class='media-object' src='' alt='...'>
                            </a>
                            <a class='pull-right btn btn-success' href='#'>
                                :)
                            </a>
                            <div class='media-body'>
                                <h4 class='media-heading'>".$entry->title."</h4>
                                ".$link_array['description']."
                                </br>
                                <a href='".$link_array['email']."'><i class='fa fa-envelope'></i> E-mail</a>
                                <a href='".$link_array['facebook']."'><i class='fa fa-facebook-square'></i> Share</a>
                                <a href='".$entry->link."'><i class='fa fa-external-link'></i> Original</a>
                            </div>
                        </div>
                </div>";
        }

        return $rssfeed;
    }

    public static function getEmailAndFacebookFromDescription($description)
    {
        // echo $description;
        $desc_split = explode('<div', $description);
        $description_text = $desc_split[0];

        $desc_split = explode('href="', $description);
        $desc_return = explode('"', $desc_split[1]);
        $email_link = $desc_return[0];

        $desc_return = explode('"', $desc_split[4]);
        $facebook_link = $desc_return[0];

        $link_array = array('email'=>$email_link, 'facebook'=>$facebook_link, 'description'=>$description_text);
        return $link_array;
    }
}
