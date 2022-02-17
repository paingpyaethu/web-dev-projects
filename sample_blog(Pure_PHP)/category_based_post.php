<?php require_once "front_panel/head.php";?>
<title>Home</title>
<?php require_once "front_panel/side_header.php";?>

<div class="container">
   <div class="row">
      <div class="col-12 col-md-8">

         <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white mb-4">
               <li class="breadcrumb-item"><a href="<?php echo $url; ?>/index.php">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">
                  <?php echo category($_GET['category_id'])['title']; ?> Category
               </li>
            </ol>
         </nav>

         <?php foreach (fPostByCategory($_GET['category_id']) as $p){ ?>
            <?php include "single.php"; ?>
         <?php } ?>
      </div>
      <?php include "right-sidebar.php"; ?>

   </div>
</div>


<?php require_once "front_panel/footer.php";?>





