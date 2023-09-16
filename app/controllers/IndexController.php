<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        $patients = Patient::find();
        $response = array(
            'status' => array(
                'code' => 200,
                'response' => 'success',
                'message' => 'Example of success get data'
            ),
            'result' => $patients->toArray()
        );
        
        return $this->response->setJsonContent($response);
    }

    public function createAction()
    {
        $nik = $this->request->getPost('nik');

        // Check if a patient with the same 'nik' already exists
        $existingPatient = Patient::findFirst([
            'conditions' => 'nik = :nik:',
            'bind' => ['nik' => $nik],
        ]);
    
        if ($existingPatient) {
            $response = [
                'status' => [
                    'code' => 409,
                    'response' => 'Conflict',
                    'message' => 'A patient with the same NIK already exists.',
                ],
            ];
            $this->response->setJsonContent($response);
            $this->response->setStatusCode(409, 'Conflict');
            return $this->response;
        }
        $patient = new Patient();
        $patient->name = $this->request->getPost('name');
        $sex = $this->request->getPost('sex');
    
        // Validate 'sex' against allowed ENUM values
        $allowedSexValues = ["Male", "Female", "Other"];
        if (!in_array($sex, $allowedSexValues)) {
            $response = [
                'status' => [
                    'code' => 400,
                    'response' => 'Bad Request',
                    'message' => 'Invalid value for the "sex" field. Allowed values are: ' . implode(', ', $allowedSexValues) . '.',
                ],
            ];
            $this->response->setJsonContent($response);
            $this->response->setStatusCode(400, 'Bad Request');
            return $this->response;
        }
        $patient->sex = $sex;
        $patient->phone = $this->request->getPost('phone');
        $patient->address = $this->request->getPost('address');
        $patient->nik = $nik; // Assign 'nik' from the request
        $patient->religion = $this->request->getPost('religion');
     

        if ($patient->save()) {
            $response = array(
                'status' => array(
                    'code' => 201,
                    'response' => 'Created',
                    'message' => 'Example of success create data'
                ),
                'result' => $patient
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
                'errors' => $patient->getMessages()
            );
            $this->response->setJsonContent($response);
            $this->response->setStatusCode(409, 'Conflict');
        }
        return $this->response;
    }

    public function showAction($id)
    {
        $patient = Patient::findFirst($id);

        if (!$patient) {
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
            'result' => $patient
        );
        $this->response->setJsonContent($response);
        return $this->response;
    }

    public function updateAction($id)
    {
        $patient = Patient::findFirst($id);

        if ($patient) {
            $patient->name = $this->request->getPut('name');
            $patient->sex = $this->request->getPut('sex');
            $patient->phone = $this->request->getPut('phone');
            $patient->address = $this->request->getPut('address');
            $patient->nik = $this->request->getPut('nik');
            $patient->religion = $this->request->getPut('religion');
            if ($patient->save()) {
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
    $patient = Patient::findFirst($id);

    if ($patient) {
        if ($patient->delete()) {
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
                'errors' => $patient->getMessages()
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
