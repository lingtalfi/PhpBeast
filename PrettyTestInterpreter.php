<?php

namespace PhpBeast;

/*
 * LingTalfi 2015-11-01
 */

use ArrayToTable\StylizedArrayToTableUtil;

class PrettyTestInterpreter extends TestInterpreter 
{
    
    private $resultsMsgs;
    private $tableName;
    private $testIndex;


    public function __construct()
    {
        parent::__construct(); 
        $this->resultsMsgs = [];
        $this->tableName = 'phpBeastPrettyTestInterpreterTable';
    }

    public function execute(TestAggregatorInterface $a)
    {
        $this->testIndex = 1;
        parent::execute($a); 
    }


    protected function onTestAfter($testType, $msg)
    {
//        if(null === $msg){
//            if('s' === $testType){
//                $msg = 'ok';
//            }
//        }
        $this->resultsMsgs[] = [$this->testIndex++, $testType, $msg];
    }

    protected function printResults(array $results)
    {
        parent::printResults($results);


        
        echo $this->getCssStyle();
        echo StylizedArrayToTableUtil::create()
            ->addBody($this->resultsMsgs)
            ->setHeaders(['Id', 'Type', 'Message'])
            // stylizing the table
            ->setTableAttr(['class' => $this->tableName])
            // this callback should return the array of attributes to apply to the tr, or false if we don't want 
            // any attributes to be applied
            ->setTrAttr(function (array $row, $containerElType) {
                $class = "success";
                $type = $row[1];
                switch ($type) {
                    case 'f':
                        $class = 'failure'; 
                        break;
                    case 'e':
                        $class = 'error'; 
                        break;
                    case 'na':
                        $class = 'not_applicable'; 
                        break;
                    case 'sk':
                        $class = 'skip'; 
                        break;
                }
                $ret['class'] = $class;
                return $ret;
            })
            ->render();
        
    }




    //------------------------------------------------------------------------------/
    // 
    //------------------------------------------------------------------------------/
    private function getCssStyle(){
        return <<<EEE
    <style>

        .{$this->tableName}, .{$this->tableName} th, .{$this->tableName} td {
            border: 1px solid #aaa;
            border-collapse: collapse;
            padding: 2px;
            color: black;
            text-align: left;
        }

        .{$this->tableName} .success {
            background-color: green;
        }

        .{$this->tableName} .failure {
            background-color: red;
        }

        .{$this->tableName} .error {
            background-color: black;
            color: yellow;
        }
        
        .{$this->tableName} .not_applicable {
            background-color: orange;
        }
        
        .{$this->tableName} .skip {
            background-color: white;
        }
    </style>
EEE;
    }
}
