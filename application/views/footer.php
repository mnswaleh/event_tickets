<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<footer class="footer fixed-bottom">
    <div class="container-fluid p-2 text-center text-info">
        Churchill Tickets </br>
        <i class="fa fa-copyright"></i> <?php echo date('Y'); ?>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="<?php echo asset_url() . 'js/site.js'; ?>"></script>
<?php
    if (uri_string() == "events"){
        echo '<script src="' . asset_url() . 'js/events.js"></script>';
    }

    if (uri_string() == ""){
        echo '<script src="' . asset_url() . 'js/login.js"></script>';
    }
?>
</body>
</html>