<footer class="py-5 <?= (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') ? 'mt-3 h-auto' : '' ?>" 
style="background-color: #eef0f2;">

    <div class="container">
        <div class="row">
            <div class="col text-center">
                <img src="/images/sac.png" class="mb-2" width="24" height="24">
                <small class="d-block text-muted">
                    &copy;2026-<?= date('Y') ?>
                </small>
            </div>
        </div>
    </div>

</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script> 
</body> 
</html>