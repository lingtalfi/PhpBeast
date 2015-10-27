PhpBeast
==============
2015-10-26




This is a php implementation of the Beast component of the [Beauty n Beast pattern](https://github.com/lingtalfi/Dreamer/blob/master/UnitTesting/BeautyNBeast/pattern.beautyNBeast.eng.md).




How to use
--------------


PhpBeast is a [planet](https://github.com/lingtalfi/Observer/blob/master/article/article.planetReference.eng.md).


In its most basic form, here is how we use the phpBeast package.


```php
<?php

use PhpBeast\TestAggregator;
use PhpBeast\TestInterpreter;

require_once "bigbang.php";


function pou($m)
{
    return 6 + (int)$m;
}


$agg = TestAggregator::create();

/**
 * Testing that pou returns 6 when we pass an arbitrary string
 */
$agg->addTest(function(&$msg){
    if(6 === pou('blabla')){
        return true;
    }
    return false;
});


/**
 * Testing that pou returns 8 when we pass 2 
 */
$agg->addTest(function(&$msg){
    if(8 === pou(2)){
        return true;
    }
    return false;
});

/**
 * Testing that pou returns 8 when we pass string '2 fruits' 
 */
$agg->addTest(function(&$msg){
    if(8 === pou('2 fruits')){
        return true;
    }
    return false;
});



TestInterpreter::create()->execute($agg);

```

The example is quite verbose, but it illustrates the relationship between the aggregator and the interpreter perfectly.



Related
-------------

- [phpBeast's brainstorm](https://github.com/lingtalfi/PhpBeast/blob/master/brainstorm/brainstorm.phpBeast.eng.md)




History Log
------------------
    
- 1.0.0 -- 2015-10-27

    - initial commit