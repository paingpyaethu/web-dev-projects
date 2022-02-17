<?php require_once "core/auth.php"; ?>
<?php include "template/header.php"; ?>

	<!--Content section-->

	<!--Status Bar-->
	<div class="row">
		<div class="col-12 col-md-6 col-lg-6 col-xl-3">
			<div class="card mb-4 status-card" onclick="go('<?php echo $url;?>/post_list.php')">
				<div class="card-body">
					<div class="row align-items-center">
						<div class="col-3">
							<i class="feather-heart h1 text-primary"></i>
						</div>
						<div class="col-9">
							<p class="mb-1 h4 font-weight-bolder">
								<span class="counter-up"><?php echo countTotal('viewers');?></span>
							</p>
							<p class="mb-0 text-black-50">Total Visitor</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-6 col-xl-3">
			<div class="card mb-4 status-card" onclick="go('<?php echo $url;?>/post_list.php')">
				<div class="card-body">
					<div class="row align-items-center">
						<div class="col-3">
							<i class="feather-list h1 text-primary"></i>
						</div>
						<div class="col-9">
							<p class="mb-1 h4 font-weight-bolder">
								<span class="counter-up"><?php echo countTotal('posts'); ?></span>
							</p>
							<p class="mb-0 text-black-50">Total Post</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-6 col-xl-3">
			<div class="card mb-4 status-card"  onclick="go('<?php echo $url;?>/category_add.php')" >
				<div class="card-body">
					<div class="row align-items-center">
						<div class="col-3">
							<i class="feather-layers h1 text-primary"></i>
						</div>
						<div class="col-9">
							<p class="mb-1 h4 font-weight-bolder">
								<span class="counter-up"><?php echo countTotal('categories')?></span>
							</p>
							<p class="mb-0 text-black-50">Total Category</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-6 col-lg-6 col-xl-3">
			<div class="card mb-4 status-card" onclick="go('<?php echo $url;?>/user_list.php')">
				<div class="card-body">
					<div class="row align-items-center">
						<div class="col-3">
							<i class="feather-users h1 text-primary"></i>
						</div>
						<div class="col-9">
							<p class="mb-1 h4 font-weight-bolder">
								<span class="counter-up"><?php echo countTotal('users')?></span>
							</p>
							<p class="mb-0 text-black-50">Total User</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--Graph Section-->
	<div class="row">
		<div class="col-12 col-xl-7">
			<div class="card overflow-hidden shadow mb-4">
				<div class="">
					<div class="d-flex justify-content-between align-items-center p-3">
						<h4 class="mb-0">Visitors</h4>
						<div class="">
							<img src="<?php echo $url; ?>/assets/img/user/avatar1.jpg" class="ov-img rounded-circle" alt="">
							<img src="<?php echo $url; ?>/assets/img/user/avatar2.jpg" class="ov-img rounded-circle" alt="">
							<img src="<?php echo $url; ?>/assets/img/user/avatar3.jpg" class="ov-img rounded-circle" alt="">
							<img src="<?php echo $url; ?>/assets/img/user/avatar4.jpg" class="ov-img rounded-circle" alt="">
							<img src="<?php echo $url; ?>/assets/img/user/avatar5.jpg" class="ov-img rounded-circle" alt="">
						</div>
					</div>
					<canvas id="order-viewer" height="137"></canvas>
				</div>
			</div>
		</div>

		<!--Pie-Chart Section-->
		<div class="col-12 col-md-6 col-xl-5">
			<div class="card mb-4">
				<div class="card-body">
					<div class="d-flex justify-content-between align-items-center p-3">
						<h4 class="mb-0">Category / Post</h4>
						<div class="">
							<i class="feather-pie-chart h4 text-primary mb-0"></i>
						</div>
					</div>

					<canvas id="orderChart" height="200"></canvas>
				</div>
			</div>
		</div>

		<!--Table-Section-->

		<div class="col-12">
			<div class="card overflow-hidden mb-4">
				<div class="">
					<div class="d-flex justify-content-between align-items-center p-3">
						<h4 class="mb-0">Recent Posts</h4>
						<div class="w-25">
							<?php

							$currentUserId = $_SESSION['user']['id'];
							$postTotal = countTotal("posts");
							$currentUserPostTotal = countTotal("posts", "user_id = $currentUserId");
							$currentUserPostPercentage = ($currentUserPostTotal / $postTotal) * 100;

							$finalPercentage = floor($currentUserPostPercentage);


							?>

							<small>Your Post : <?php echo $currentUserPostTotal;?></small>
							<div class="progress">
								<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo $finalPercentage;?>%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
					</div>
					<div class="" style="overflow-x: scroll">
						<table class="table table-hover table-striped table-bordered mb-0">
							<thead>
							<tr>
								<th>#</th>
								<th>Title</th>
								<th>Description</th>
								<th>Category</th>
                 <?php if ($_SESSION['user']['role'] == 0){ ?>
									 <th>User</th>
                 <?php }?>
								<th class="text-nowrap">Viewer Count</th>
								<th>Control</th>
								<th>Created_At</th>
							</tr>
							</thead>

							<tbody>
              <?php
              foreach (dashboardPosts(5) as $c){
                 ?>
								<tr>
									<td><?php echo $c['id'];?></td>
									<td><?php echo short($c['title']);?></td>
									<td><?php echo short(strip_tags(html_entity_decode($c['description'])));?></td>
									<td class="text-nowrap"><?php echo category($c['category_id'])['title'];?></td>
                   <?php if ($_SESSION['user']['role'] == 0){ ?>
										 <td class="text-nowrap"><?php echo user($c['user_id'])['name'];?></td>
                   <?php }?>
									<td>
                     <?php echo count(viewerCountByPosts($c['id'])); ?>
									</td>
									<td class="text-nowrap">
										<a href="post_detail.php?id=<?php echo $c['id'];?>" class="btn btn-outline-info btn-sm">
											<i class="feather-info"></i>
										</a>
										<a href="post_delete.php?id=<?php echo $c['id'];?>" onclick="return confirm('Are you sure?')"
											 class="btn btn-outline-danger btn-sm">
											<i class="feather-trash-2"></i>
										</a>
										<a href="post_edit.php?id=<?php echo $c['id'];?>" class="btn btn-outline-warning btn-sm">
											<i class="feather-edit-3"></i>
										</a>
									</td>
									<td><?php echo showTime($c['created_at']);?></td>
								</tr>

              <?php } ?>
							</tbody>
						</table>
					</div>

				</div>
			</div>
		</div>
	</div>

<?php include "template/footer.php"; ?>

<script>
    $('.counter-up').counterUp({
        delay: 10,
        time: 1000
    });

    <?php
    $dateArr = [];
    $visitorRate = [];
    $transitionRate = [];

    $today = date("Y-m-d");

    for ($i=0; $i<10; $i++){
       $date = date_create($today);
       date_sub($date, date_interval_create_from_date_string("$i days"));
       $current = date_format($date, "Y-m-d");
       array_push($dateArr, $current);

       $result = countTotal("viewers", "CAST(created_at AS DATE) = '$current'");
       array_push($visitorRate, $result);

       $transitionResult = countTotal("transition", "CAST(created_at AS DATE) = '$current'");
       array_push($transitionRate, $transitionResult);
    }

    ?>

    let dateArr = <?php echo json_encode($dateArr);  ?>;
    let visitorCounter = <?php echo json_encode($visitorRate); ?>;
    let transitionCounter = <?php echo json_encode($transitionRate); ?>;

    var ctx = document.getElementById('order-viewer').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: dateArr,
            datasets: [{
                label: 'Visitor',
                data: visitorCounter,
                backgroundColor: [
                    '#007bff30',
                ],
                borderColor: [
                    '#007bff',
                ],
                borderWidth: 1,
                tension: 0
            },
                {
                    label: 'Transition',
                    data: transitionCounter,
                    backgroundColor: [
                        'rgba(0,255,38,0.19)',
                    ],
                    borderColor: [
                        '#1aff00',
                    ],
                    borderWidth: 1,
                    tension: 0
                }]
        },
        options: {
            scales: {
                yAxes: [{
                    display: false,
                    ticks: {
                        beginAtZero: true
                    }
                }],
                xAxes: [
                    {
                        display: false
                    }
                ]
            },
            legend: {
                display: true,
                position: 'top',
                labels: {
                    fontColor: '#333',
                    usePointStyle:true
                }
            }
        }

    });

    <?php

    $categoryName = [];
    $countPostByCategory = [];

    foreach (categories() as $category){
       array_push($categoryName, $category['title']);
       // SELECT COUNT(id) FROM posts WHERE category_id = 1 or 2 or 3 ....
       array_push($countPostByCategory, countTotal('posts', "category_id={$category['id']}"));
    }

    ?>
		
    let categoryNameArr = <?php
			 // PHP Array to JS Array(object)
       echo json_encode($categoryName);
       ?>;
    let countPostByCategoryArr = <?php echo json_encode($countPostByCategory); ?>;

    let orderPlace = document.getElementById('orderChart').getContext('2d');
    let orderChart = new Chart(orderPlace, {
        type: 'doughnut',
        data: {
            labels: categoryNameArr,
            datasets: [{
                label: '# of Votes',
                data: countPostByCategoryArr,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(180,108,37,0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    display: false,
                    ticks: {
                        beginAtZero: true
                    }
                }],
                xAxes: [
                    {
                        display: false
                    }
                ]
            },
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    fontColor: '#333',
                    usePointStyle:true
                }
            }
        }

    });
</script>
