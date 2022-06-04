<?php 

include_once("data-validation.cls.php");
include_once("../customFunctions.custom.php");

$validations = DataValidator::validator("this is simple test", array('hasData'));
dd($validations);
$validations = DataValidator::validator("", array('hasData'));
dd($validations);
$validations = DataValidator::validator("0", array('hasData'));
dd($validations);
$validations = DataValidator::validator("test", array('hasData'));
dd($validations);
$validations = DataValidator::validator("<html></html>", array('hasData'));
dd($validations);
$validations = DataValidator::validator("false", array('hasData'));
dd($validations);
$validations = DataValidator::validator("=true", array('hasData'));
dd($validations);
$validations = DataValidator::validator(false, array('hasData'));
dd($validations);
$validations = DataValidator::validator(0, array('hasData'));
dd($validations);
$validations = DataValidator::validator(0.0, array('hasData'));
dd($validations);
$validations = DataValidator::validator("<script></script>", array('hasData'));
dd($validations);
$validations = DataValidator::validator("all test cases passed", array('hasData'));
dd($validations);
