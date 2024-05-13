<?php

// Execute Python script with properly formatted arguments
$command1 = "python generate_chart1.py";
exec($command1, $output);
$command2 = "python generate_chart2.py";
exec($command2, $output);


?>