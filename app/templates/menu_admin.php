<a href="javascript:void(0);" class="fs-xl text-truncate text-truncate-lg text-info" data-toggle="dropdown" aria-expanded="false">    
    <i class="fal fas fa-cog fa-fw d-inline-block ml-1 fs-md"></i>
    <i class="fal fa-angle-down d-inline-block ml-1 fs-md"></i>
</a>
<div class="dropdown-menu">
    <a class="dropdown-item" href="app/controllers/edit.php?emailDB=<?php echo $emailDB;?>">
        <i class="fa fa-edit"></i>
    Редактировать</a>
    <a class="dropdown-item" href="app/views/security.php">
        <i class="fa fa-lock"></i>
    Безопасность</a>
    <a class="dropdown-item" href="app/views/status.php">
        <i class="fa fa-sun"></i>
    Установить статус</a>
    <a class="dropdown-item" href="app/views/media.php">
        <i class="fa fa-camera"></i>
        Загрузить аватар
    </a>
    <a href="#" class="dropdown-item" onclick="return confirm('are you sure?');">
        <i class="fa fa-window-close"></i>
        Удалить
    </a>
</div>