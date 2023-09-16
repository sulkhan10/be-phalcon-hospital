<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        $users = Patient::find();
        $response = array(
            'status' => array(
                'code' => 200,
                'response' => 'success',
                'message' => 'Example of success get data'
            ),
            'result' => $users->toArray()
        );
        
        return $this->response->setJsonContent($response);
    }

    public function createAction()
    {
        $user = new Patient();
        $user->name = $this->request->getPost('name');
        $user->sex = $this->request->getPost('sex');
        $user->phone = $this->request->getPost('phone');
        $user->address = $this->request->getPost('address');
        $user->nik = $this->request->getPost('nik');
        $user->religion = $this->request->getPost('religion');
     

        if ($user->save()) {
            $response = array(
                'status' => array(
                    'code' => 201,
                    'response' => 'Created',
                    'message' => 'Example of success create data'
                ),
                'result' => $user
            );
            $this->response->setJsonContent($response);
            $this->response->setStatusCode(201, 'Created');
        } else {
            $response = array(
                'status' => array(
                    'code' => 409,
                    'response' => 'Conflict',
                    'message' => 'Example of error conflict create data'
                ),
                'errors' => $user->getMessages()
            );
            $this->response->setJsonContent($response);
            $this->response->setStatusCode(409, 'Conflict');
        }
        return $this->response;
    }

    public function showAction($id)
    {
        $user = Patient::findFirst($id);

        if (!$user) {
            $response = array(
                'status' => array(
                    'code' => 404,
                    'response' => 'Not Found',
                    'message' => 'Example of error data not found'
                )
            );
            $this->response->setJsonContent($response);
            $this->response->setStatusCode(404, 'Not Found');
            return $this->response;
        }

        $response = array(
            'status' => array(
                'code' => 200,
                'response' => 'success',
                'message' => 'Example of success get detail data'
            ),
            'result' => $user
        );
        $this->response->setJsonContent($response);
        return $this->response;
    }

    public function updateAction($id)
    {
        $user = Patient::findFirst($id);

        if ($user) {
            $user->name = $this->request->getPut('name');
            $user->sex = $this->request->getPut('sex');
            $user->phone = $this->request->getPut('phone');
            $user->address = $this->request->getPut('address');
            $user->nik = $this->request->getPut('nik');
            $user->religion = $this->request->getPut('religion');
            if ($user->save()) {
                $response = array(
                    'status' => array(
                        'code' => 200,
                        'response' => 'success',
                        'message' => 'Example of success update data'
                    )
                );
                $this->response->setStatusCode(200, 'OK');
                return $this->response->setJsonContent($response);
            } else {
                $response = array(
                    'status' => array(
                        'code' => 409,
                        'response' => 'Conflict',
                        'message' => 'Example of error conflict update data'
                    ),
                );
                // $this->response->setStatusCode(409, 'Conflict');
               return  $this->response->setJsonContent($response);
            }
        } else {
            $response = array(
                'status' => array(
                    'code' => 404,
                    'response' => 'Not Found',
                    'message' => 'Example of error data not found'
                )
            );
            $this->response->setStatusCode(404, 'Not Found');
            return $this->response->setJsonContent($response);
        }
    }
    public function deleteAction($id)
{
    $user = Patient::findFirst($id);

    if ($user) {
        if ($user->delete()) {
            $response = array(
                'status' => array(
                    'code' => 204,
                    'response' => 'success',
                    'message' => 'Example of success delete data'
                )
            );
            // $this->response->setStatusCode(204, 'No Content');
            return $this->response->setJsonContent($response);
        } else {
            $response = array(
                'status' => array(
                    'code' => 409,
                    'response' => 'Conflict',
                    'message' => 'Example of error conflict delete data'
                ),
                'errors' => $user->getMessages()
            );
            // $this->response->setStatusCode(409, 'Conflict');
            return $this->response->setJsonContent($response);
        }
    } else {
        $response = array(
            'status' => array(
                'code' => 404,
                'response' => 'Not Found',
                'message' => 'Example of error data not found'
            )
        );
        $this->response->setStatusCode(404, 'Not Found');
        return $this->response->setJsonContent($response);
    }
}

}
