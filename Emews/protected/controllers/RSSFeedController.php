<?php

class RSSFeedController extends Controller
{
	private $_view;
	private $_model;


	public function actionGetRSSFeed()
	{
		$num = false;
		$this->initializeView();

		$html =  RSSFeed::getRSSFeed('http://rss.cnn.com/rss/cnn_topstories.rss');
		$this->render("mediafeed", array("feed_html"=>$html));
	}	
	
	public function actionReservationagreement()
	{
		$num = false;
		$this->initializeView();
	}

	public function initializeView()
	{
		$this->_view = new View;
		$this->_view->setLayout($this, "main");
	}
}