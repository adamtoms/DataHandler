<?php
class DataHandler {

    private $conn;
    public  $st  = null;
    public  $st2 = null;

    public function __construct($sConnString, $sDB_USER, $sDB_PASSWORD) {

        try{

            $this->conn = new PDO($sConnString, $sDB_USER, $sDB_PASSWORD);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::SQLSRV_LOG_SEVERITY_ALL);

        }catch(PDOException $e){
            echo 'Connection failed: <bR>'; //.$e->getMessage();
            exit;
        }
    }


    // closes conn 
    public function __destruct() {
        $this->conn = null; 
        $this->st   = null;
        $this->st2  = null;
    }


    // command to execute sql with read permissions
    public function RunCommand($sSQL, $aParams = null){

        // sql has been provided
        $this->st = $this->conn->prepare( $sSQL );

        // is there params? supplied as 'name' => 'value'
        if(!empty($aParams)){

            foreach ($aParams as $sParamName => $oParamVal) {

                if( is_int($oParamVal)){
                    $this->st->bindValue( $sParamName, $oParamVal, PDO::PARAM_INT );
                }else{
                    $this->st->bindValue( $sParamName, $oParamVal, PDO::PARAM_STR );
                }
            }
        }
        $this->st->execute();
    }

    public function fetch(){
        if($this->st){
            return $this->st->fetch();
        }else if($this->st2){
            return $this->st2->fetch();
        }
    }

    public function RunCommand2($sSQL, $aParams = null){

        // sql has been provided
        $this->st2 = $this->conn->prepare( $sSQL );

        // is there params? supplied as 'name' => 'value'
        if(!empty($aParams)){

            foreach ($aParams as $sParamName => $oParamVal) {

                if( is_int($oParamVal)){
                    $this->st2->bindValue( $sParamName, $oParamVal, PDO::PARAM_INT );
                }else{
                    $this->st2->bindValue( $sParamName, $oParamVal, PDO::PARAM_STR );
                }
            }
        }

        $this->st2->execute();
    }

} ?>
