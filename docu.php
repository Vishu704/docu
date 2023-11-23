<?php 

require('config.php');
session_start();
if(empty($_SESSION['username']))
{
  header('location:login.php');
}


$sql = "SELECT * FROM docu_form ORDER BY id DESC ";
$result = mysqli_query($conn,$sql);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
 
     <style>
        .row{
            padding:32px;
        }
        div#example_wrapper .row:nth-child(2) {
            padding: 0;
        }
        td.text-truncate {
            max-width: 200px;
        }
     </style>
  </head>
  <body>
    
    <!-- header -->
    <nav class="navbar navbar-expand-lg bg-white">
        <div class="container">
          <a class="navbar-brand" href="/">
            <img src="images/logo.svg" alt="">
          </a>
          
            
            <span class="navbar-text">
              <?php
                if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true)
                {
                  echo"<span class='user-name me-3'>
                  Welcome <span>$_SESSION[username]</span>
                  </span>";
                }
              ?>
                
                <a href="logout.php" class="logout"> 
                  <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_1233_22)">
                    <path d="M8 10H15M15 10L12 13M15 10L12 7" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M15 4V3C15 1.89543 14.1046 1 13 1H3C1.89543 1 1 1.89543 1 3V17C1 18.1046 1.89543 19 3 19H13C14.1046 19 15 18.1046 15 17V16" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </g>
                    <defs>
                    <clipPath id="clip0_1233_22">
                    <rect width="16" height="20" fill="white"/>
                    </clipPath>
                    </defs>
                    </svg>
                </a>

          </span>
       
        </div>
    </nav>

    <!-- main -->
    <div class="container">

      <div class="d-flex justify-content-between align-items-center py-5"> 
      <h3 class="title">Docu list</h3>
      <a href="/docu-list" class="create-button">Back</a>
      </div>

      <div class="table-container" >
        <table id="example" class="table table-striped table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Created date </th>
              <th>Company Name </th>
              <th>Order ID </th>
              <th>Name </th>
              <th>Created By</th>
              <th>Actions </th>
            </tr>
          </thead>
          <tbody>
              <?php
              if($result){
                while($row = mysqli_fetch_assoc($result))
                {
                  $id=$row['id'];
                  $date=$row['date'];
                  
                  $company_name=strtolower($row['company_name']);
                  $str = str_replace(' ', '-', $company_name);
                  $order_id=$row['order_id'];
                  $clientname=$row['clientname'];
                  $user=$row['user_name'];
                  echo '<tr>
                  <td>'.$id.'</td>
                  <td>'.$date.'</td>
                  <td>'.$company_name.'</td>
                  <td>'.$order_id.'</td>
                  <td>'.$clientname.'</td>
                  <td>'.$user.'</td>
                  <td>
                  <a href="/pdf/'.$str.'.php?pdfid='.$id.'" class="tbl-btn download me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="PDF">
                    <img src="../images/pdf.svg">
                  </a>
                  <a href="update.php?updateid='.$id.'" class="tbl-btn edit me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="EDIT">
                    <img src="../images/edit.svg">
                  </a>
                  <a href="javascript:void(0)" class="tbl-btn delete confirmDelete" module="deleteid" moduleid="'.$id.'" data-bs-toggle="tooltip" data-bs-placement="top" title="DELETE">
                    <img src="../images/delete.svg">
                  </a>
                </td>
                </tr>';
                }
            
                }
            ?>
          </tbody>
        </table>
      </div>  
      <div style="text-align: center;"> 
        
      </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
      $(document).ready(function () {
        $('#example').DataTable();
      });
      
      $(".confirmDelete").click(function(){
        var module = $(this).attr('module');
        var moduleid = $(this).attr('moduleid');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
              window.location = "function.php?"+module+"="+moduleid;
            }
          })
      });
      
      // TOOLTIP
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
      var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
      });
    </script>
  </body>
</html>