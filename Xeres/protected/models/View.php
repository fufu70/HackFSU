<?php

/**
 * View class.
 * View is the class that does all of the rendering and changing of layouts.
 * Created for simplicities sake.
 */
class View
{
	/**
	 *	View calls the render function of a .php file without a model
	 */
	public function renderView($controller, $viewName)
	{
		$controller->render($viewName);
	}

	/**
	 *  View calls the render function of a .php file with a model.
	 *  The controller stills listens VIA _POSTs.
	 */
	public function renderViewWithModel($controller, $viewName, $model)
	{
		$controller->render($viewName, array('model'=>$model));
	}

	public function renderViewWithModelAndParam($controller, $viewName, $model, $paramName, $param)
	{
		$controller->render($viewName, array('model'=>$model, $paramName=>$param));
	}

	public function renderViewWithModelAndTwoParam($controller, $viewName, $model, $paramNameOne, $paramOne, $paramNameTwo, $paramTwo)
	{
		$controller->render($viewName, array('model'=>$model, $paramNameOne=>$paramOne, $paramNameTwo=>$paramTwo));
	}

	public function renderViewWithModelAndThreeParam($controller, $viewName, $model, $paramNameOne, $paramOne, $paramNameTwo, $paramTwo, $paramNameThree, $paramThree)
	{
		$controller->render($viewName, array('model'=>$model, $paramNameOne=>$paramOne, $paramNameTwo=>$paramTwo,$paramNameThree=>$paramThree));
	}

	public function renderViewWithModelAndFourParam($controller, $viewName, $model, $paramNameOne, $paramOne, $paramNameTwo, $paramTwo, $paramNameThree, $paramThree, $paramNameFour, $paramFour)
	{
		$controller->render($viewName, array('model'=>$model, $paramNameOne=>$paramOne, $paramNameTwo=>$paramTwo,$paramNameThree=>$paramThree,$paramNameFour=>$paramFour));
	}

	/**
	 *	Changes the layout that is used (main is the default)
	 */
	public function setLayout($controller, $layout)
	{
		$controller->layout=$layout;
	}

}
