




    <!--GOOGLE CHART API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!--GOOGLE CHART API-->



    <!-- JS API-->
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['Views',      <?php echo $session->count; ?>],
                ['DB Photos',      <?php echo Photo::count_all(); ?>],
                ['System Users',  <?php echo User::count_all(); ?>],
                ['Products',  <?php echo Product::count_all(); ?>]
            ]);

            var options = {
                title: 'Overview',
                backgroundColor: 'transparent',
                is3D: true
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>
    <!-- JS API-->





            <!--HTML SETUP-->
            <div class="row placeholders">
                <div class="col-xs-6 col-sm-3 placeholder">
                    <h1><?php echo $session->count; ?></h1>
                    <h4>SITE VIEWS</h4>
                </div>
                <div class="col-xs-6 col-sm-3 placeholder">
                    <h1><?php echo Photo::count_all(); ?></h1>
                    <h4>ALL DB PHOTOS</h4>
                </div>
                <div class="col-xs-6 col-sm-3 placeholder">
                    <h1><?php echo User::count_all(); ?></h1>
                    <h4>SYSTEM USERS</h4>
                </div>

                <div class="col-xs-6 col-sm-3 placeholder">
                    <h1><?php echo Product::count_all(); ?></h1>
                    <h4>ACTIVE PRODUCTS</h4>
                </div>
            </div>
            <!--HTML SETUP-->






          





