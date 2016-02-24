<?php

/* 
The Functions Used in the 
 */
include "config.php";
session_start();

class Admin{
    public $Conn ;
    function __construct(){
        
        $this->Conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATA);

        if ($this->Conn->connect_error){
            die("Connection failed: " . mysqli_connect_error());
        }
        
        //echo "Connected successfully";
        
    }
    
    function __destruct(){
        $this->Conn->close();
    }
    
    /*Admin login*/
    function admin_login($email, $password){
        $QUE = "SELECT * FROM admin where adnim_email = '$email'";
        $result = $this->Conn->query($QUE);
        $bool = FALSE;
        if ($result->num_rows == 1){
            $data = $result->fetch_assoc();
            $bool = password_verify($password, $data['password']);
        }
        return $bool;
    }
    
    function admin_create($email, $password){
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $QUE = "INSERT INTO admin VALUES ('$email', '$hash')";
        $result = $this->Conn->query($QUE);
        return $result;
    }
    
    function admin_logout(){
        session_destroy();
    }
    
    function patient_insert($FirstName, $LastName, $Address, $City, $Telephone, $NIC, $Disability, $Reason, $Description, $latitude, $Longitude){
        
            $bool = FALSE;
            $QUE = "SELECT * FROM patient WHERE NIC_No = '$NIC' ";
            $result =  $this->Conn->query($QUE);
            if ($result->num_rows == 0){
        
            $QUE = "INSERT INTO patient (First_Name, Last_Name, Address, City, Telephone, NIC_No, Disability, Reason, Latitude, Longitude, Description) VALUES ('$FirstName', '$LastName', '$Address', '$City', '$Telephone', '$NIC', '$Disability', '$Reason', $latitude, $Longitude,'$Description')";
            $result = $this->Conn->query($QUE);
            $bool = TRUE;
            }
        
        return $bool;
    }
    
    function patient_search($Name="", $City="", $Disability="")
    {
        $CondArray = array();
        if ($Name != "") {
            array_push($CondArray, "First_Name LIKE '%$Name%' OR Last_Name LIKE '%$Name%' OR CONCAT(First_Name, ' ', Last_Name) LIKE '%$Name%'");
        }
        if ($City != "") {
            array_push($CondArray, "City LIKE '%$City%'");
        }
        if ($Disability != "") {
            array_push($CondArray, "Disability LIKE '%$Disability%'");
        }
        $String = "SELECT * FROM patient";
        $QUE = "";
        if (count($CondArray) == 0) {
            $QUE = $String;
        } else {
            $QUE = $String . " WHERE " . implode(" AND ", $CondArray);
        }
        //echo $QUE;
        
        $res = $this->Conn->query($QUE);
        
            return $res;

        
    }
    
    function patient_read($PatientID){
        $QUE = "SELECT * FROM patient WHERE PatientID = '$PatientID'";
        //echo $QUE;
        $result = $this->Conn->query($QUE);
        return $result;
        
    }
    
    function patient_edit($PatientID, $FirstName="" , $LastName="", $Address="", $City="", $Telephone="", $NIC="", $Disability="", $Reason="", $Description="", $Latitude="", $Longitude=""){
        $CondArray = array();
        if ($FirstName != ""){array_push($CondArray, " First_Name = '$FirstName'");}
        if ($LastName != ""){array_push($CondArray, "Last_Name =  '$LastName'");}
        if ($Address != ""){array_push($CondArray, "Address = '$Address'");}
        if ($City != ""){array_push($CondArray, "City = '$City'");}
        if ($Telephone != ""){array_push($CondArray, "Telephone = $Telephone");}
        if ($NIC != ""){array_push($CondArray, "NIC_No = '$NIC'");}
        if ($Disability != ""){array_push($CondArray, "Disability = '$Disability'");}
        if ($Reason != ""){array_push($CondArray, "Reason = '$Reason'");}
        if ($Description != ""){array_push($CondArray, "Description = '$Description' ");}
        if ($Latitude != ""){array_push($CondArray, "Latitude = $Latitude");}
        if ($Longitude != ""){array_push($CondArray, "Longitude = $Longitude");}
        
        if (count($CondArray) != 0 ){
            $QUE = "UPDATE Patient set ". implode(" , ", $CondArray) . " WHERE PatientID = $PatientID"; 
            //echo $QUE;
            $res = $this->Conn->query($QUE);
        }
        return $res;
    }
    
    function patient_delete($PatientID){
        $QUE = "DELETE FROM patient WHERE PatientID = $PatientID" ;
        
        $this->Conn->query($QUE);
        
        
        
    }
    
    
    
}

