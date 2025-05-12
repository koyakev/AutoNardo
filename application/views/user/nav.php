<header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <div class="container">
                <a class="navbar-brand fw-bold text-primary fs-3" href="<?= base_url() ?>">Autonardo</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Rentals</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Order history</a>
                        </li>
                        <?php if ($user): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= site_url('user/logout') ?>">Logout</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= site_url('user/login') ?>">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= site_url('user/register') ?>">Register</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>