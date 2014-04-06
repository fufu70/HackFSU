<?php

class RSSFeedController extends Controller
{
	private $_view;
	private $_model;


	public function actionGetRSSFeed()
	{
		$num = false;
		$this->initializeView();

		$html =  RSSFeed::getRSSFeed('http://api.nytimes.com/svc/mostpopular/v2/mostemailed/all-sections/1.json?&offset=20&api-key=85e5504f29879150341a6a9cddebbe8a:13:69145140');
		$this->render("mediafeed", array("feed_html"=>$html));
	}	
	
	public function actionGetArticle()
	{
		$num = false;
		$this->initializeView();

		if(isset($_POST['mood_choose']))
		{
			$sql = "SELECT * FROM user_emotion WHERE url = '".$_POST['url']."' AND token = 'hey'";
			$connection=Yii::app()->db;
			$command=$connection->createCommand($sql);
			$info = $command->queryAll();
			if(sizeof($info) == 0)
			{
				$sql = "INSERT INTO `user_emotion` (`token`, `url`, `mood`) VALUES('hey', '".$_POST['url']."', '".$_POST['mood_choose']."')";
				$connection=Yii::app()->db;
				$command=$connection->createCommand($sql);
				$command->execute();
				$this->actionGetRSSFeed();
			}
			else
			{
				$sql = "UPDATE `user_emotion` SET mood = '".$_POST['mood_choose']."' WHERE url = '".$_POST['url']."' AND token = 'hey'";
				$connection=Yii::app()->db;
				$command=$connection->createCommand($sql);
				$command->execute();
				$this->actionGetRSSFeed();
			}
		}
		else
		{
			$html =  $_GET['url_feed'];
			$this->render("articlefeed", array("feed_html"=>$html));
		}
	}

	public function initializeView()
	{
		$this->_view = new View;
		$this->_view->setLayout($this, "main");
	}
}