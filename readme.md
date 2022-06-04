# PHP custom packages
Look for folder name, each folder contains a package and all depended files that are being using. It is suggested to read the **readme.md** because it refers to the documentation of corresponding package. Plus, there is a **data-validation** file that is designed as a test cases. it includes the type of input user may be interested to provide and corresponding output.

### PHP version 
Atleast **PHP 5** is required to use packages

> customFunctions.custom.php file in the main repo is designed to debug the output. It includes **dd** function which shows the output
on browser screen without specifying whether the object is array or simple variable. Its documentation has been described below

# dd function
function dd(
        $ob,
        $exitOnPrint = false,
        $exactIndex = "",
        $maxIndex = 0,
        $showDataTypes = false,
        $bgColor = "#2b2a27",
        $color = "#fff",
        $fontSize = "14px"
    ) 

@param $ob **Mixed** , $exitOnPrint **Boolean**, $exactIndex **String**,    $maxIndex **Integer**, $showDataTypes **Boolean**, 
        $bgColor = **String**, $color = **String**,$fontSize = **String**

- $ob is a object that needs to be printed
- $exitOnPrint will break the executation of the code.
- $exactIndex prints only value that needs to be printed in case you have an huge array 
- $maxIndex prints the array indexed within the range starting from the start index upto $maxIndex
- $showDataTypes works like var_dump
- $bgColor for background color
- $color for foreground color
- $fontSize for fontSize
