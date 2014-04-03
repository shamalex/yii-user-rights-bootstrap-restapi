<?php
class ApiController extends Controller
{
    // write the required media type of data, I am using JSON to use it in AngularJS
    private $mediaType = 'json';
 
    
    public function actionAllElements()
    {      // Return all items in JSON format
		    	 
		    switch($_GET['model'])
		    {
		     case 'users':
		            $models = Users::model()->findAll();
		            break;
					
				 case 'tovars':
		            $models = Tovar::model()->findAll();
				    break;
						
		        default:
		            
		            $this->_sendResponse(501, sprintf(
		                'REST is not implemented for this model, Go ahead and first implement it',
		                $_GET['model']) );
		            Yii::app()->end();
		    }
		   
		    if(empty($models)) {
		        
		        $this->_sendResponse(200, 
		                sprintf('Model <b>%s</b> is empty', $_GET['model']) );
		    } else {
		        
		        $rows = array();
		        foreach($models as $model)
		            $rows[] = $model->attributes;
		        // Response in JSON format
		        $this->_sendResponse(200, CJSON::encode($rows));
		    }  
    	
		
    }
    public function actionSingleElement()
    {    // Return a sigle row in JSON format
    	
		    // check for HTTP GET method
		    if(!isset($_GET['id']))
		        $this->_sendResponse(500, 'Error: Parameter <b>id</b> is missing' );
		 
		    switch($_GET['model'])
		    {
		     case 'users':
		            $model = Users::model()->findByPk($_GET['id']);
		            break;
				 case 'tovars':
		            $model = Tovar::model()->findByPk($_GET['id']);
		            break;
		
		        default:
		            $this->_sendResponse(501, sprintf(
		                'REST is not implemented for this model, Go ahead and first implement it',
		                $_GET['model']) );
		            Yii::app()->end();
		    }
		    
		    if(is_null($model))
		        $this->_sendResponse(404, 'id '.$_GET['id'].' not in the data base');
		    else
				// Response in JSON format 
		        $this->_sendResponse(200, CJSON::encode($model));
    }
    public function actionCreateAnElement()
    {
		    	switch($_GET['model'])
		    {
		        // Get an instance of the respective model
		    case 'tovar':
					$model = new Tovar;
					break;
				case 'Users':
				    $model = new User;
					break;				
		        default:
		            $this->_sendResponse(501, 
		                sprintf('REST is not implemented for this model, Go ahead and first implement it',
		                $_GET['model']) );
		                Yii::app()->end();
		    }
		    // Try to assign POST values to attributes
		    foreach($_POST as $var=>$value) {
		        // Does the model have this attribute? If not raise an error
		        if($model->hasAttribute($var))
		            $model->$var = $value;
		        else
		            $this->_sendResponse(500, 
		                sprintf('Parameter <b>%s</b> is not allowed for model <b>%s</b>', $var,
		                $_GET['model']) );
		    }
		    // Try to save the model
		    if($model->save())
		        $this->_sendResponse(200, CJSON::encode($model));
		    else {
		        // Errors occurred
		        $msg = "<h1>Error</h1>";
		        $msg .= sprintf("Couldn't create model <b>%s</b>", $_GET['model']);
		        $msg .= "<ul>";
		        foreach($model->errors as $attribute=>$attr_errors) {
		            $msg .= "<li>Attribute: $attribute</li>";
		            $msg .= "<ul>";
		            foreach($attr_errors as $attr_error)
		                $msg .= "<li>$attr_error</li>";
		            $msg .= "</ul>";
		        }
		        $msg .= "</ul>";
		        $this->_sendResponse(500, $msg );
		    }
    }
    public function actionUpdateAnElement()
    {
			    	 // Parse the PUT parameters. This didn't work: parse_str(file_get_contents('php://input'), $put_vars);
			    $json = file_get_contents('php://input'); //$GLOBALS['HTTP_RAW_POST_DATA'] is not preferred: http://www.php.net/manual/en/ini.core.php#ini.always-populate-raw-post-data
			    $put_vars = CJSON::decode($json,true);  //true means use associative array
			 
			    switch($_GET['model'])
			    {
			        // Find respective model
			        case 'posts':
			            $model = Post::model()->findByPk($_GET['id']);                    
			            break;
			        default:
			            $this->_sendResponse(501, 
			                sprintf( 'REST is not implemented for this model, Go ahead and first implement it',
			                $_GET['model']) );
			            Yii::app()->end();
			    }
			    // Did we find the requested model? If not, raise an error
			    if($model === null)
			        $this->_sendResponse(400, 
			                sprintf("Error: Didn't find any model <b>%s</b> with ID <b>%s</b>.",
			                $_GET['model'], $_GET['id']) );
			 
			    // Try to assign PUT parameters to attributes
			    foreach($put_vars as $var=>$value) {
			        // Does model have this attribute? If not, raise an error
			        if($model->hasAttribute($var))
			            $model->$var = $value;
			        else {
			            $this->_sendResponse(500, 
			                sprintf('Parameter <b>%s</b> is not allowed for model <b>%s</b>',
			                $var, $_GET['model']) );
			        }
			    }
			    // Try to save the model
			    if($model->save())
			        $this->_sendResponse(200, CJSON::encode($model));
			    else
			        // prepare the error $msg
			        // see actionCreate
			        // ...
			        $this->_sendResponse(500, $msg );
					
    }
     
	 protected function beforeSave()
	{
	   
	    // author_id may have been posted via API POST
	    if(is_null($this->author_id) or $this->author_id=='')
	        $this->author_id=Yii::app()->user->id;
	   
	}
	 
    public function actionDeleteAnElement()
    {
		    	switch($_GET['model'])
		    {
		        // Load the respective model
		       
			  	case 'Users':
		            $model = users::model()->findByPk($_GET['id']);
		            break;
				 case 'Tovar':
		            $model = tovar::model()->findByPk($_GET['id']);
		            break;
				 default:
		            $this->_sendResponse(501, 
		                sprintf('REST is not implemented for this model, Go ahead and first implement it',
		                $_GET['model']) );
		            Yii::app()->end();
		    }
		    
		    if($model === null)
		        $this->_sendResponse(400, 
		                sprintf("Error: Didn't find any model <b>%s</b> with ID <b>%s</b>.",
		                $_GET['model'], $_GET['id']) );
		 
		    
		    $num = $model->delete();
		    if($num>0)
		        $this->_sendResponse(200, $num);    
		    else
		        $this->_sendResponse(500, 
		                sprintf("Error: Couldn't delete model <b>%s</b> with ID <b>%s</b>.",
		                $_GET['model'], $_GET['id']) );
		    }
     private function _getStatusCodeMessage($status)
		{
		    
		    $codes = Array(
		        200 => 'OK',
		        400 => 'Bad Request',
		        401 => 'Unauthorized',
		        402 => 'Payment Required',
		        403 => 'Forbidden',
		        404 => 'Not Found',
		        500 => 'Internal Server Error',
		        501 => 'Not Implemented',
		    );
		    return (isset($codes[$status])) ? $codes[$status] : '';
		}
    private function _sendResponse($status = 200, $body = '', $content_type = 'text/html')
{
    
    $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
    header($status_header);
    header('Content-type: ' . $content_type);
 
    
    if($body != '')
    {
        echo $body;
    }else
    {
        // Set empty message to avoid error
        $message = '';
        // some information for non tech guys
        switch($status)
        {
            case 401:
                $message = 'You must be authorized to view this page.';
                break;
            case 404:
                $message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
                break;
            case 500:
                $message = 'The server encountered an error processing your request.';
                break;
            case 501:
                $message = 'The requested method is not implemented.';
                break;
        }
 
        
        $signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];
 
			        // An actual body 
			        $body = '
			<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
			<html>
			<head>
			    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
			    <title>' . $status . ' ' . $this->_getStatusCodeMessage($status) . '</title>
			</head>
			<body>
			    <h1>' . $this->_getStatusCodeMessage($status) . '</h1>
			    <p>' . $message . '</p>
			    <hr />
			    <address>' . $signature . '</address>
			</body>
			</html>';
			 
			        echo $body;
			    }
			    Yii::app()->end();
			}
        private function _checkAuth()
			{
			    // Check if we have the USERNAME and PASSWORD HTTP headers set?
			    if(!(isset($_SERVER['HTTP_X_USERNAME']) and isset($_SERVER['HTTP_X_PASSWORD']))) {
			        // Error: Unauthorized
			        $this->_sendResponse(401);
			    }
			    $username = $_SERVER['HTTP_X_USERNAME'];
			    $password = $_SERVER['HTTP_X_PASSWORD'];
			    // Find the user
			    $user=User::model()->find('LOWER(username)=?',array(strtolower($username)));
			    if($user===null) {
			        // Error: Unauthorized
			        $this->_sendResponse(401, 'Error: User Name is invalid');
			    } else if(!$user->validatePassword($password)) {
			        // Error: Unauthorized
			        $this->_sendResponse(401, 'Error: User Password is invalid');
			    }
			}
				
}
