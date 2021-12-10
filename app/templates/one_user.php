<?php
$emailDB = $arrayUsers[$i]['email'];
$usernameDB = $arrayUsers[$i]['username'];
$phoneDB = $arrayUsers[$i]['phone'];
$addressDB = $arrayUsers[$i]['address'];
$jobDB = $arrayUsers[$i]['job'];
$statusDB = $arrayUsers[$i]['status'];
$avatarDB = $arrayUsers[$i]['avatar'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<div class="col-xl-4">
    <div id="c_1" class="card border shadow-0 mb-g shadow-sm-hover"
        data-filter-tags="<?php echo(mb_strtolower($usernameDB));?>">
        <div class="card-body border-faded border-top-0 border-left-0 border-right-0 rounded-top">
            <div class="d-flex flex-row align-items-center">
                <span class="status status-<?php echo give_status($statusDB);?> mr-3">
                    <span class="rounded-circle profile-image d-block "
                        style="background-image:url('<?php echo $avatarDB;?>');
                        background-size: cover;">
                    </span>
                </span>
                <div class="info-card-text flex-1">
                    <a href="javascript:void(0);" class="fs-xl text-truncate text-truncate-lg text-info" data-toggle="dropdown" aria-expanded="false">
                        <?php echo $usernameDB;?>
                    </a>

                    <?php
                    if ($_SESSION['roleDB'] == array('role'=> 'admin')) {
                        include 'menu_admin.php';
                    } else {
                        if ($_SESSION['user'] == $emailDB) {
                            $_SESSION['emailDB'] = $emailDB;
                            include 'menu.php';}
                    }
                    ?>
                    

                    <span class="text-truncate text-truncate-xl">
                        <?php echo $jobDB;?>
                    </span>
                </div>
                <button class="js-expand-btn btn btn-sm btn-default d-none" data-toggle="collapse" data-target="#c_1 > .card-body + .card-body" aria-expanded="false">
                    <span class="collapsed-hidden">+</span>
                    <span class="collapsed-reveal">-</span>
                </button>
            </div>
        </div>
        <div class="card-body p-0 collapse show">
            <div class="p-3">
                <a href="tel:+<?php echo $phoneDB;?>"
                class="mt-1 d-block fs-sm fw-400 text-dark">
                    <i class="fas fa-mobile-alt text-muted mr-2">
                    </i> <?php echo (phone_format($phoneDB));?></a>
                <a href="mailto:<?php echo $emailDB;?>" class="mt-1 d-block fs-sm fw-400 text-dark">
                    <i class="fas fa-mouse-pointer text-muted mr-2"></i> <?php echo $emailDB;?></a>
                <address class="fs-sm fw-400 mt-4 text-muted">
                    <i class="fas fa-map-pin mr-2"></i><?php echo $addressDB;?></address>
                <div class="d-flex flex-row">
                    <a href="javascript:void(0);" class="mr-2 fs-xxl" style="color:#4680C2">
                        <i class="fab fa-vk"></i>
                    </a>
                    <a href="javascript:void(0);" class="mr-2 fs-xxl" style="color:#38A1F3">
                        <i class="fab fa-telegram"></i>
                    </a>
                    <a href="javascript:void(0);" class="mr-2 fs-xxl" style="color:#E1306C">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>