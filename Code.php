<?php



                             $conn = mysqli_connect("localhost", "user", "YES", "tirerepaire"); 
                             // Check connection 
                        if ($conn->connect_error) { 
                        die("Connection failed: " . $conn->connect_error); 
                                                }  
                         $sql = "SELECT * FROM manifacture"; 

                        $result = $conn->query($sql); 
                        if ($result->num_rows > 0) { 

                        // output data of each row 
                         while($row = $result->fetch_assoc()) { 

                            echo " <img src='img/".$row['photo']."' alt=''> "; 
                        } 
                        

                         } else { echo "0 results"; } 
                        $conn->close(); 
                          
function ConnectDateBase()
{
    $conn = mysqli_connect("localhost", "user", "YES", "tirerepaire");

    if ($conn->connect_error) {
        
    }
    
}
?>