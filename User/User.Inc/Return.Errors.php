<?php
if (count($Error) > 0):
?>
<div class="Error bg-secondary text-warning mx-auto border border-danger rounded px-3 pt-3 pb-1">
  <?php
  foreach ($Error as $Errors):
  ?>
  <p>
    <?php
    echo $Errors
    ?>
  </p>
  <?php
  endforeach
  ?>
</div>
<?php
endif

?>
