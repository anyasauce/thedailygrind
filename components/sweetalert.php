<?php
if (isset($_SESSION['message'])): ?>
    <script>
        Swal.fire({
            icon: '<?php echo $_SESSION['type']; ?>',
            title: '<?php echo $_SESSION['message']; ?>',
            showConfirmButton: false,
            timer: 3000
        });
    </script>
    <?php
    unset($_SESSION['message']);
    unset($_SESSION['type']);
endif;
?>