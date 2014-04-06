<?php

class RSSFeedController extends Controller
{
	private $_view;
	private $_model;


	public function actionGetRSSFeed()
	{
		$this->_model = new ReservationForm;
		$num = false;
		$this->initializeView();

		echo RSSFeed::getRSSFeed('http://rss.cnn.com/rss/cnn_topstories.rss');
	}	
	
	public function actionReservationagreement()
	{
		$this->_model = new ReservationForm;
		$num = false;
		$this->initializeView();
	}

	public function initializeView()
	{
		$this->_view = new View;
	}
}