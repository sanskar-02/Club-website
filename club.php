<?php include 'header.php'; ?>
<?php
// Include the database connection
include_once 'admin/includes/dbconnection.php';

// Fetch clubs from the database
$query = mysqli_query($con, "SELECT * FROM Clubs");
?>

<div class="container-fluid page-header  wow fadeIn" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">
    <div class="text-center">
        <h1 class="display-4 text-white  slideInDown mb-3">Clubs</h1>
    </div>
</div>

<section class="container club-products py-5">
    <div class="row">
        <?php
        while ($row = mysqli_fetch_assoc($query)) {
        ?>
            <a href="club-details.php?id=<?php echo $row['Id']; ?>" class="panel col-lg-4">
                <div class="ring">
                    <div class="card">
                        <!-- Club image -->
                        <img src="admin/images/<?php echo htmlspecialchars($row['Image']); ?>" alt="Club Image" style="width: 100%; height: 100%;">
                    </div>
                    <div class="border">
                        <!-- Club name -->
                        <p class="title"><?php echo htmlspecialchars($row['ClubName']); ?></p>
                        <div class="slide">
                            <!-- Club description -->
                            <h6 class="para"><?php echo htmlspecialchars($row['ClubName']); ?></h6>
                            <div class="line">
                                <?php echo htmlspecialchars($row['ClubDescription']); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        <?php
        }
        ?>
    </div>
</section>

<?php include 'footer.php'; ?>