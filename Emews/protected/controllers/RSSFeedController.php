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