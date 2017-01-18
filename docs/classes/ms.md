# minimalstats Documentation
## Class Reference: MSException

`Exception > MSException`

### Introduction

`MSException` extends the standard Exception to also hold arbitrary data.

### Table of Contents
* [Properties](#properties)
* [Class functions](#class-functions)
* [Instance methods](#instance-methods)
* [Error Codes](#error-codes)

### Properties

* [data](#protected-data)

#### `protected` data
Holds arbitrary error data.

### Class functions

* [__construct()](#public-constructmessage--null-code--0-exception-previous--null-data--null)

#### `public` __construct($message = null, $code = 0, Exception $previous = null, $data = null)

Constructor. 

### Instance methods

* [getData()](#getdata)

#### getData()
Returns the data property.

### Error codes

Code | Description
---|---
1|Error loading ini file. See `parse_ini_file()`.
2|Not all required config params were set.
3|Database connect error. Previous Exception contains mysql exception.
