$(document).ready(function () {
     readRecords(); 
});

function readRecords() {

    let readOp = true; 
    $.ajax({
        type: "post",
        url: "server.php",
        data: {
            readOp : readOp
        },
     
        success: function (data , status) {
            $("#records").html(data);
            $("#myTable").DataTable();
        }
    });

    
}

$("#insertBtn").click(function (e) { 
    e.preventDefault();
    let insertOp = true;
    let name = $("#t1").val(); 
    let age = $("#age").val(); 
    let phone  =  $("#phone").val(); 
    $.ajax({
        type: "post",
        url: "server.php",
        data: {
            name : name , 
            age : age ,
            phone : phone , 
            insertOp : insertOp
        },
        success: function (data , status) {
           Swal.fire({
             title: "Insert action" , 
             text: "The record has been added successfully", 
             icon : "success"
           });
           readRecords();
        }
    });
    
});

function deleteIt (id , name ) {
  
   let deleteOp = true; 
    Swal.fire({
        title: "Are you sure?",
        text: "do you want to delete " + name,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "post",
                url: "server.php",
                data: {
                    deleteOp : deleteOp , 
                    id : id 
                },
                success: function (response) {
                    Swal.fire({
                        title: "Deleted!",
                        text: name + " has been deleted.",
                        icon: "success"
                      });
                      readRecords();
                }
            });
         
        }
      });
}
