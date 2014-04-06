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
        $x = json_decode($content, true);
        $rssfeed = "";

        for($i = 0; $i < sizeof($x['results']); $i ++) 
        {
            $stuff = "";
            if($x['results'][$i]['media'] != '')
            {
                if($x['results'][$i]['media'][0]['type'] == 'image')
                {
                    $stuff = $x['results'][$i]['media'][0]['media-metadata'][0]['url'];
                }
            }
            $sql = "SELECT * FROM user_emotion WHERE url = '".$x['results'][$i]['url']."' AND token = 'hey'";
            $connection=Yii::app()->db;
            $command=$connection->createCommand($sql);
            $info = $command->queryAll();

            $color = "#000000";

            if(sizeof($info) != 0)
            {
                if($info[0]['mood'] == 0){ $color = '#419641';}
                else if($info[0]['mood'] == 1){ $color = '#EB9316';} 
                else if($info[0]['mood'] == 2){ $color = '#C12E2A';}
            }

            $rssfeed .= "
                <div class='col-lg-12' style='padding-top:5px; padding-bottom:5px;'>
                        <div class='media'>
                            <a class='pull-left' href='/index.php/RSSFeed/getarticle/?url_feed=".$x['results'][$i]['url']."'>
                                <img class='media-object' src='".$stuff."' style='width:75px; height:75px;'>
                            </a>
                            <div class='media-body'>
                                <a href='/index.php/RSSFeed/getarticle/?url_feed=".$x['results'][$i]['url']."'><h4 class='media-heading' style='color:".$color.";font-size:20px;'>".$x['results'][$i]['title']."</h4></a>
                                </br>
                                ".$x['results'][$i]['abstract']."
                                </br>
                                <div class='fb-share-button' data-href='".$x['results'][$i]['url']."' data-type='icon_link'></div>
                              <a href='".$x['results'][$i]['url']."'><i class='fa fa-external-link'></i> Original</a>
                            </div>
                        </div>
                </div>";
        }

        return $rssfeed;
    }

}
