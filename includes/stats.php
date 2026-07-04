<section class="stats">

<div class="container">

<h2 class="section-title">
Live Network Status
</h2>

<p class="section-subtitle">
Real-time overview of the TRENZYCH VPN network.
</p>

<div class="stats-grid">

<div class="stat-card">
    <div class="stat-icon">🔑</div>
    <div class="stat-number"><?php echo $totalKeys; ?></div>
    <div class="stat-label">VPN Keys</div>
</div>

<div class="stat-card">
    <div class="stat-icon">🖥️</div>
    <div class="stat-number"><?php echo $totalServers; ?></div>
    <div class="stat-label">Servers</div>
</div>

<div class="stat-card">
    <div class="stat-icon">🟢</div>
    <div class="stat-number"><?php echo $onlineServers; ?></div>
    <div class="stat-label">Online</div>
</div>

<div class="stat-card">
    <div class="stat-icon">⚡</div>
    <div class="stat-number"><?php echo $avgPing; ?> ms</div>
    <div class="stat-label">Average Ping</div>
</div>

</div>

</div>

</section>
