        <footer class="footer mt-auto py-3 border-top">
            <div class="container text-center">
                <span class="text-muted">
                    &copy; 2020 - 
                    All rights reserved
                </span>
            </div>
        </footer>
    </body>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" 
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" 
            crossorigin="anonymous">
            </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" 
            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" 
            crossorigin="anonymous">
            </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" 
            integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" 
            crossorigin="anonymous">
            </script>
    <?php if (trim($_SERVER["REQUEST_URI"], "/") === "data") : ?>
        <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js">
        </script>
        <script type="text/javascript">
            <?php include dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR . "js". DIRECTORY_SEPARATOR . "datatable.js"?>
        </script>
    <?php endif; ?>
    <?php if (trim($_SERVER["REQUEST_URI"], "/") === "map") : ?>
        <script type="text/javascript">
            <?php include dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR . "js". DIRECTORY_SEPARATOR . "jquery-jvectormap-2.0.5.min.js"?>
        </script>
        <script type="text/javascript">
            <?php include dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR . "js". DIRECTORY_SEPARATOR . "jquery-jvectormap-world-mill.js"?>
        </script>
        <script type="text/javascript">
            <?php include dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR . "js". DIRECTORY_SEPARATOR . "map.js"?>
        </script>
    <?php endif; ?>
</html>