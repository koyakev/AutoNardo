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
						<a class="nav-link" href="<?= base_url() ?>">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?= site_url('/rental-history') ?>">Rental history</a>
					</li>

					<?php if ($user): ?>
						<li class="nav-item dropdown dropdown">
							<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								<?= htmlspecialchars($user->full_name) ?>
							</a>

							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="<?= site_url('profile') ?>">Profile</a></li>
								<li><a class="dropdown-item" href="<?= site_url('auth/logout') ?>">Logout</a></li>
							</ul>
						</li>
						
					<?php else: ?>
						<li class="nav-item">
							<a class="nav-link" href="<?= site_url('/login') ?>">Login</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="<?= site_url('/register') ?>">Register</a>
						</li>

					<?php endif; ?>
				</ul>
			</div>
		</div>
	</nav>
</header>