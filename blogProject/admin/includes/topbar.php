<nav class="navbar px-4 py-2 border-bottom d-flex justify-content-between align-items-center" style="background-color: #1e293b; border-color: #334155 !important;">

    <!-- Page Title -->
    <h5 class="text-white mb-0 fw-semibold"><?php echo $pageTitle ?? 'Dashboard'; ?></h5>

    <!-- Admin Profile -->
    <div class="d-flex align-items-center gap-2">
        <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
            style="width:36px; height:36px; background-color:#3b82f6; font-size:14px; flex-shrink:0;">
            <?php echo strtoupper(substr($_SESSION['admin']['uName'], 0, 1)); ?>
        </div>
        <div class="d-flex flex-column">
            <small class="text-white fw-semibold" style="line-height:1.2;">
                <?php echo $_SESSION['admin']['uName']; ?>
            </small>
            <small class="text-muted" style="font-size:11px; line-height:1.2;">
                <?php echo $_SESSION['admin']['uEmail']; ?>
            </small>
        </div>
    </div>

</nav>