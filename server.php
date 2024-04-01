<?php

include("konekt.php");
extract($_POST);
if(isset($_POST["insertOp"]) && isset($_POST["name"])){ 
    try {
        $sql = "INSERT INTO name_tbl (id , name , age , phone) 
        values(NULL, '$name' , '$age' , '$phone')";
        $conn-> exec($sql);
    } catch (Exception $e) {
        echo "". $e->getMessage() ."";
    }
}

if(isset($_POST["readOp"]) ){
    try {
        $sql = "SELECT * FROM name_tbl ORDER BY id DESC LIMIT 100";
       echo '<table id="myTable" class="display" style="width:100%">
       <thead>
           <tr>
               <th>ID</th>
               <th>name</th>
               <th>age</th>
               <th>phone</th>
               <th>Actions</th>
            
           </tr>
       </thead>
       <tbody>';
        foreach($conn->query($sql) as $row){
            ?>
                  <tr>
                      <td><?php echo $row['id']; ?></td>
                      <td><?php echo $row['name']; ?></td>
                      <td><?php echo $row['age']; ?></td>
                      <td><?php echo $row['phone']; ?></td>
                      <td> 
                        <button class="btn btn-primary btn-sm" onclick="editIt(<?php echo $row['id']; ?>)">
                         <i class="fa-solid fa-pen-to-square"></i> 
                        </button>

                        <button class="btn btn-danger btn-sm" onclick="deleteIt(<?php echo $row['id']; ?> , '<?php echo $row['name']; ?>' )">
                        <i class="fa-solid fa-trash"></i>
                        </button>
                      </td>
                  </tr>
            
       <?php
     
        }
        echo ' </tbody>
        <tfoot>
            <tr>
            <th>ID</th>
            <th>name</th>
            <th>age</th>
            <th>phone</th>
            <th>Actions</th>
            </tr>
        </tfoot>
    </table>';
    }
    catch (Exception $e) {
        echo "error:". $e->getMessage() ."";
    }
}

if(isset($_POST["deleteOp"]) && isset($_POST["id"])){
    try {
        if(is_numeric($_POST["id"])){
            $stmt = $conn->prepare("DELETE FROM name_tbl WHERE id=?");
            $stmt -> execute([$id]);
            $stmt = null; 
         }
    }
    catch (Exception $e) {
      echo "error". $e->getMessage() ."";
    }
}
