# [minimalstats Documentation](../)

## [Class Reference](../classes/): MSException

`Exception > MSException`

### Introduction

`MSException` extends the standard Exception to also hold arbitrary data.

### Table of contents

* [Properties](#properties)
* [Class functions](#class-functions)
* [Instance methods](#instance-methods)
* [Error Codes](#error-codes)

### Properties

* [`protected` data](#protected-data)

#### `protected` data

Holds arbitrary error data.

### Class functions

* [`public` __construct($message = null, $code = 0, Exception $previous = null, $data = null)](#public-constructmessage--null-code--0-exception-previous--null-data--null)

#### `public` __construct($message = null, $code = 0, Exception $previous = null, $data = null)

Constructor. 

### Instance methods

* [`public` getData()](#public-getdata)

#### `public` getData()

Returns the data property.

### Error codes

Code | Description
---|---
1|Error loading `config.ini` file. See `parse_ini_file()`.
2|Not all required config params were set in `config.ini`.
3|Database connect error. `$previous` contains the mysql exception, which you can access with `getPrevious()`.
