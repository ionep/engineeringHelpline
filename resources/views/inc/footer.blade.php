<div id='footer' class="text-center ">
<p><a href='privacypolicy'>Privacy policy</a></p>
Copyright 
<?php 
$startYear = 2018; 
$currentYear = date('Y');
echo $startYear;
if ($startYear != $currentYear) {
    echo '-' . $currentYear;
}
?>. All rights Reserved
</div>