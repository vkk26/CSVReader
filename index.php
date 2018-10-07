<?php
main::start("example.csv");
class main{
    static public function start($filename) {
        $records = csv::getRecords($filename);
        $table = html::generateTable($records);


        }
}
class html
{
    public static function generateTable($records)
    {

        $count = 0;
        foreach ($records as $record) {
            if ($count == 0) {
                $array = $record->returnArray();
                $fields = array_keys($array);
                $values = array_values($array);

                print_r($fields);
                print_r($values);
            }else{
                $array = $record->returnArray();
                $values = array_values($array);


            }
            $count++;
        }
}
}



class csv{
    static public function getRecords($filename) {
        $file = fopen($filename,"r");

        $fieldNames = Array();
        $count = 0;
        while(! feof($file))
        {
            $record = fgetcsv($file);
            if ($count ==0 ){
                $fieldNames =$record;
            }else{
                $records[] = recordFactory::create($fieldNames,$record);
            }
            $count++;
        }
        fclose($file);
        return $records;

    }
}
class record{

        public function __construct (Array $fieldNames = null, Array $values =Null)
        {
            $record = array_combine($fieldNames, $values);
            foreach ($record as $property => $value) {
                $this->createProperty($property, $value);
            }
        }
        public function returnArray (){
            $array = (array) $this;
            return $array;
        }
        public function createProperty($name='first',$value='vinay'){
    $this->{$name} = $value;
            }
}
class recordFactory
{

    public static function create(Array $fieldnames = null, Array $values = null)
    {
        $record = new record($fieldnames, $values);
        return $record;

    }
}
