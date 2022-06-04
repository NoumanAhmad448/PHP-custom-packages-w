# DataValidator Class
This class includes a **static validator** function to validate the data. The validation rules that you can test for your data are as follow
- hasData
- isString 
- isInteger
- isBoolean 
- isArray 
- containHTML


## DataValidator::validator
@signature validator($data: Mixed,$rule: array): array 
@param array can be simple array or assosiative array. In case of assosiative array the keys will be treated as rule and value will be as custom message that you want to display/return if that perticular rule fails

@examples
DataValidator::validator(false, array['hasData']) => array('isValidation' => true, 'detail' => array())
DataValidator::validator('false', array['hasData']) => array('isValidation' => true, 'detail' => array())
DataValidator::validator('', array['hasData']) => array('isValidation' => false, 'detail' => array('err' => 'err msg'))
DataValidator::validator('', array['hasData' => 'custom err message']) => array('isValidation' => false, 'detail' => array('err' => 'custom err message'))


